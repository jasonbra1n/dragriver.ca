<?php
declare(strict_types=1);

namespace DragRiver\Services;

/**
 * WeatherService
 *
 * Fetches and caches weather data from the OpenWeatherMap (OWM) API.
 * Implements a file-based cache to minimize API calls and improve performance.
 */
class WeatherService
{
    private const CACHE_FILE = __DIR__ . '/../cache/weather_data.json';
    private const CACHE_TTL = 600; // Cache Time-To-Live in seconds (10 minutes)

    private array $config;

    /**
     * Constructor.
     *
     * @param array $config The application configuration array.
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Retrieves weather data, utilizing a cache to avoid excessive API calls.
     *
     * @return object|null The decoded weather data object, or null on failure.
     */
    public function getWeatherData(): ?object
    {
        // 1. Check for a valid cache file
        if (file_exists(self::CACHE_FILE) && (time() - filemtime(self::CACHE_FILE) < self::CACHE_TTL)) {
            $cachedData = file_get_contents(self::CACHE_FILE);
            if ($cachedData) {
                return json_decode($cachedData);
            }
        }

        // 2. If cache is invalid or missing, fetch from API
        return $this->fetchFromApi();
    }

    /**
     * Fetches fresh data from the OWM API and updates the cache.
     *
     * @return object|null The decoded weather data object, or null on failure.
     */
    private function fetchFromApi(): ?object
    {
        $baseParams = [
            'lat'   => $this->config['OWM_LAT'],
            'lon'   => $this->config['OWM_LON'],
            'units' => $this->config['OWM_UNITS'],
            'lang'  => $this->config['OWM_LANG'],
            'appid' => $this->config['OWM_API_KEY']
        ];
        $queryString = http_build_query($baseParams);

        // 1. Fetch Current Weather (Standard API)
        $currentUrl = "https://api.openweathermap.org/data/2.5/weather?{$queryString}";
        $currentJson = $this->fetchUrl($currentUrl);
        
        if ($currentJson === false) {
            error_log('WeatherService: Failed to fetch Current Weather (2.5).');
            return null;
        }
        $currentRaw = json_decode($currentJson);

        // 2. Fetch 5-Day Forecast (Standard API)
        $forecastUrl = "https://api.openweathermap.org/data/2.5/forecast?{$queryString}";
        $forecastJson = $this->fetchUrl($forecastUrl);
        $forecastRaw = $forecastJson ? json_decode($forecastJson) : null;

        // 3. Fetch Air Pollution (Standard API)
        $airUrl = "https://api.openweathermap.org/data/2.5/air_pollution?{$queryString}";
        $airJson = $this->fetchUrl($airUrl);
        $airRaw = $airJson ? json_decode($airJson) : null;

        // 4. Fetch Water Level (Parks Canada - Drag Lake Dams)
        // URL provided: https://www.pc.gc.ca/apps/waterlevels/donnees-data?Id=41&lang=en&siteId=100419
        $hydroUrl = "https://www.pc.gc.ca/apps/waterlevels/donnees-data?Id=41&lang=en&siteId=100419";
        $hydroHtml = $this->fetchUrl($hydroUrl);
        
        $waterLevel = null;
        $waterTime = null;

        if ($hydroHtml !== false && !empty($hydroHtml)) {
            // Parse HTML to find the data table
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true); // Suppress HTML parsing warnings
            $dom->loadHTML($hydroHtml);
            libxml_clear_errors();
            
            $xpath = new \DOMXPath($dom);
            // Find all rows in the table body
            $rows = $xpath->query("//tbody/tr");
            
            if ($rows->length > 0) {
                // Get the last row (most recent data)
                $lastRow = $rows->item($rows->length - 1);
                $cols = $xpath->query("td", $lastRow);
                
                // Expecting: Col 0 = Date, Col 1 = Level
                if ($cols->length >= 2) {
                    $dateStr = trim($cols->item(0)->textContent);
                    $levelStr = trim($cols->item(1)->textContent);
                    
                    // Clean up date string if necessary
                    $waterTime = $dateStr; 
                    $waterLevel = (float)$levelStr;
                }
            }
        }

        // 5. Construct Unified Data Object
        $data = (object) [
            'current' => (object) [
                'temp'       => $currentRaw->main->temp,
                'feels_like' => $currentRaw->main->feels_like,
                'humidity'   => $currentRaw->main->humidity,
                'wind_speed' => $currentRaw->wind->speed,
                'pressure'   => $currentRaw->main->pressure,
                'clouds'     => $currentRaw->clouds->all,
                'aqi'        => $airRaw->list[0]->main->aqi ?? null, // 1 = Good, 5 = Very Poor
                'uvi'        => 0, // Not available in Standard Free Tier
            ],
            'daily' => [],
            'hourly' => [], // Added for Chart.js (3-hour intervals)
            'alerts' => [], // Not available in Standard Free Tier
            'water' => (object) [
                'level' => $waterLevel,
                'time' => $waterTime
            ]
        ];

        // Process Forecast
        if ($forecastRaw) {
            // 1. Extract next 24h (approx 8 x 3-hour intervals) for the chart
            $hourlySlice = array_slice($forecastRaw->list, 0, 8);
            foreach ($hourlySlice as $item) {
                $data->hourly[] = (object) [
                    'dt' => $item->dt,
                    'temp' => $item->main->temp,
                    'icon' => $item->weather[0]->icon
                ];
            }

            // 2. Create "Daily" summaries
            $dailyMap = [];
            foreach ($forecastRaw->list as $item) {
                $date = date('Y-m-d', $item->dt);
                if (!isset($dailyMap[$date])) {
                    $dailyMap[$date] = [
                        'dt' => $item->dt,
                        'min' => $item->main->temp_min,
                        'max' => $item->main->temp_max,
                        'icon' => $item->weather[0]->icon,
                        'desc' => $item->weather[0]->description
                    ];
                } else {
                    $dailyMap[$date]['min'] = min($dailyMap[$date]['min'], $item->main->temp_min);
                    $dailyMap[$date]['max'] = max($dailyMap[$date]['max'], $item->main->temp_max);
                }
            }
            
            // Convert map to array and take first 7
            foreach ($dailyMap as $day) {
                $data->daily[] = (object) [
                    'dt' => $day['dt'],
                    'temp' => (object) ['min' => $day['min'], 'max' => $day['max']],
                    'weather' => [(object) ['icon' => $day['icon'], 'description' => $day['desc']]]
                ];
            }
            $data->daily = array_slice($data->daily, 0, 7);
        }

        // Ensure cache directory exists
        $cacheDir = dirname(self::CACHE_FILE);
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0755, true);
        }

        // Save the fresh data to the cache file
        file_put_contents(self::CACHE_FILE, json_encode($data));

        return $data;
    }

    /**
     * Helper to fetch a URL with a User-Agent header.
     * Crucial for Government of Canada sites which block requests without one.
     *
     * @param string $url
     * @return string|false
     */
    private function fetchUrl(string $url)
    {
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "User-Agent: DragRiverBot/1.0 (flow.dragriver.ca)\r\n"
            ]
        ];
        
        $context = stream_context_create($opts);
        
        // Use @ to suppress warnings, we handle false return
        return @file_get_contents($url, false, $context);
    }
}