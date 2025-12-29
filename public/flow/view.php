<?php
// This view is included by index.php, which has already loaded the bootstrap and data.
// The $weatherData object is available here.

// --- Helper Functions & Data Preparation ---

$isDataAvailable = isset($weatherData) && $weatherData !== null;

function getUvIndexDescription(float $uvi): string {
    if ($uvi < 3) return 'Low';
    if ($uvi < 6) return 'Moderate';
    if ($uvi < 8) return 'High';
    if ($uvi < 11) return 'Very High';
    return 'Extreme';
}

function getWeatherIcon(string $iconCode): string {
    $map = [
        '01d' => '☀️', '01n' => '🌙', // clear sky
        '02d' => '⛅', '02n' => '☁️', // few clouds
        '03d' => '☁️', '03n' => '☁️', // scattered clouds
        '04d' => '☁️', '04n' => '☁️', // broken clouds
        '09d' => '🌧️', '09n' => '🌧️', // shower rain
        '10d' => '🌦️', '10n' => '🌧️', // rain
        '11d' => '⛈️', '11n' => '⛈️', // thunderstorm
        '13d' => '❄️', '13n' => '❄️', // snow
        '50d' => '🌫️', '50n' => '🌫️', // mist
    ];
    return $map[$iconCode] ?? '❔';
}

function getAqiInfo(?int $aqi): array {
    $map = [
        1 => ['text' => 'Good', 'class' => 'good', 'desc' => 'Air quality is satisfactory', 'pct' => 20],
        2 => ['text' => 'Fair', 'class' => 'moderate', 'desc' => 'Air quality is acceptable', 'pct' => 40],
        3 => ['text' => 'Moderate', 'class' => 'moderate', 'desc' => 'Sensitive groups should reduce exertion', 'pct' => 60],
        4 => ['text' => 'Poor', 'class' => 'poor', 'desc' => 'Unhealthy for sensitive groups', 'pct' => 80],
        5 => ['text' => 'Very Poor', 'class' => 'poor', 'desc' => 'Health warnings of emergency conditions', 'pct' => 100],
    ];
    return $map[$aqi] ?? ['text' => 'N/A', 'class' => '', 'desc' => 'Data unavailable', 'pct' => 0];
}

// --- Dynamic Page Elements ---

$statusText = $isDataAvailable ? 'Live Data Stream Active' : 'Data Stream Offline';
$statusIcon = $isDataAvailable ? '🟢' : '🔴';

// Current Conditions
$currentTemp = $isDataAvailable ? round($weatherData->current->temp) : 'N/A';
$currentFeelsLike = $isDataAvailable ? round($weatherData->current->feels_like) : 'N/A';
$currentHumidity = $isDataAvailable ? $weatherData->current->humidity : 'N/A';
$currentWind = $isDataAvailable ? round($weatherData->current->wind_speed * 3.6) : 'N/A'; // m/s to km/h
$currentPressure = $isDataAvailable ? $weatherData->current->pressure : 'N/A';
$currentClouds = $isDataAvailable ? $weatherData->current->clouds : 'N/A';
$currentUvi = $isDataAvailable ? round($weatherData->current->uvi, 1) : 'N/A';
$currentUviDesc = $isDataAvailable ? getUvIndexDescription($weatherData->current->uvi) : '';
$currentAqi = $isDataAvailable ? getAqiInfo($weatherData->current->aqi ?? null) : getAqiInfo(null);

// Alerts
$alerts = $isDataAvailable && isset($weatherData->alerts) ? $weatherData->alerts : [];

// Water Level
$waterLevel = $isDataAvailable && isset($weatherData->water->level) ? $weatherData->water->level : null;
$waterTime = $isDataAvailable && isset($weatherData->water->time) ? strtotime($weatherData->water->time) : null;

// Forecast
$dailyForecast = $isDataAvailable && isset($weatherData->daily) ? array_slice($weatherData->daily, 0, 7) : [];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Dashboard - Drag River Creative</title>
    <meta name="description" content="Advanced environmental dashboard with real-time weather data and customizable monitoring tools">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://dragriver.ca/public/styles.css">
</head>
<body>
    <!-- Animated Background -->
    <div class="bg-animation">
        <div class="floating-orb"></div>
        <div class="floating-orb"></div>
        <div class="floating-orb"></div>
        <div class="floating-orb"></div>
    </div>

    <!-- Header -->
    <header>
        <nav class="nav-container">
            <a href="https://dragriver.ca" class="logo">
                <img src="https://dragriver.ca/public/src/logo1.png" alt="Drag River" style="height: 40px; vertical-align: middle;">
            </a>
            <ul class="nav-menu">
                <li><a href="https://dragriver.ca" class="back-button">← Back to Home</a></li>
                <li><a href="#dashboard" class="active">Dashboard</a></li>
                <li><a href="#settings">Settings</a></li>
                <li><a href="#data">Historical Data</a></li>
            </ul>
            <div class="mobile-menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Flow Dashboard</h1>
            <p class="page-subtitle">Advanced environmental monitoring with real-time weather data and customizable insights</p>
            <span class="status-badge"><?= htmlspecialchars($statusIcon . ' ' . $statusText) ?></span>
        </div>

        <!-- Dashboard Grid -->
        <div class="dashboard" id="dashboard">
            <!-- Main Weather Widget -->
            <div class="dashboard-card weather-main fade-in">
                <h2 class="card-title">
                    <span class="card-icon">🌤️</span>
                    Live Weather Monitoring
                </h2>
                <!-- Embedded Weather Widget -->
                <iframe 
                    class="weather-embed"
                    src="https://embed.windy.com/embed2.html?lat=45.04&lon=-78.51&detailLat=45.04&detailLon=-78.51&width=650&height=450&zoom=10&level=surface&overlay=wind&product=ecmwf&menu=&message=true&marker=&calendar=now&pressure=&type=map&location=coordinates&detail=&metricWind=default&metricTemp=default&radarRange=-1"
                    frameborder="0" 
                    loading="lazy"
                    title="Weather Map">
                </iframe>
            </div>

            <!-- Quick Stats -->
            <div class="dashboard-card quick-stats fade-in">
                <h3 class="card-title">
                    <span class="card-icon">📊</span>
                    Current Conditions
                </h3>
                <div class="stat-item">
                    <span class="stat-label">Temperature</span>
                    <span class="stat-value" id="temp"><?= htmlspecialchars((string)$currentTemp) ?>°C</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Humidity</span>
                    <span class="stat-value" id="humidity"><?= htmlspecialchars((string)$currentHumidity) ?>%</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Wind Speed</span>
                    <span class="stat-value" id="wind"><?= htmlspecialchars((string)$currentWind) ?> km/h</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Pressure</span>
                    <span class="stat-value" id="pressure"><?= htmlspecialchars((string)$currentPressure) ?> hPa</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">UV Index</span>
                    <span class="stat-value" id="uv"><?= htmlspecialchars((string)$currentUvi) ?> <span class="uv-desc">(<?= htmlspecialchars($currentUviDesc) ?>)</span></span>
                </div>
            </div>

            <!-- Alerts -->
            <div class="dashboard-card alerts fade-in">
                <h3 class="card-title">
                    <span class="card-icon">⚠️</span>
                    Active Alerts
                </h3>
                <?php if (!empty($alerts)): ?>
                    <?php foreach ($alerts as $alert): ?>
                        <div class="alert-item">
                            <div class="alert-title"><?= htmlspecialchars($alert->event) ?></div>
                            <div class="alert-desc"><?= htmlspecialchars($alert->description) ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert-item no-alerts">
                        <div class="alert-desc">No active weather alerts for this area.</div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Controls -->
            <div class="dashboard-card controls fade-in">
                <h3 class="card-title">
                    <span class="card-icon">⚙️</span>
                    Quick Controls
                </h3>
                <div class="control-group">
                    <label class="control-label">Location</label>
                    <input type="text" class="control-input" value="Haliburton, ON" placeholder="Enter location">
                    <button class="control-button">Update Location</button>
                </div>
                <div class="control-group">
                    <label class="control-label">Units</label>
                    <select class="control-input">
                        <option value="metric">Metric (°C, km/h)</option>
                        <option value="imperial">Imperial (°F, mph)</option>
                    </select>
                </div>
                <div class="control-group">
                    <label class="control-label">Refresh Rate</label>
                    <select class="control-input">
                        <option value="5">5 minutes</option>
                        <option value="10" selected>10 minutes</option>
                        <option value="30">30 minutes</option>
                    </select>
                </div>
            </div>

            <!-- 7-Day Forecast -->
            <div class="dashboard-card forecast fade-in">
                <h3 class="card-title">
                    <span class="card-icon">📅</span>
                    7-Day Forecast
                </h3>
                <div class="forecast-grid">
                    <?php if (!empty($dailyForecast)): ?>
                        <?php foreach ($dailyForecast as $index => $day): ?>
                            <div class="forecast-day">
                                <div class="forecast-date"><?= $index === 0 ? 'Today' : date('D', $day->dt) ?></div>
                                <div class="forecast-icon"><?= getWeatherIcon($day->weather[0]->icon ?? '01d') ?></div>
                                <div class="forecast-temp"><?= round($day->temp->max) ?>° / <?= round($day->temp->min) ?>°</div>
                                <div class="forecast-desc"><?= htmlspecialchars(ucwords($day->weather[0]->description ?? 'N/A')) ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="forecast-day">
                            <p>Forecast data is currently unavailable.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Data Visualization Section -->
        <div class="visualization-section">
            <!-- Temperature Chart -->
            <div class="chart-container fade-in">
                <h3 class="chart-title">24-Hour Temperature Trend</h3>
                <div class="chart-wrapper">
                    <canvas id="temperatureChart" class="chart-canvas"></canvas>
                </div>
            </div>

            <!-- Additional Weather Maps -->
            <div class="maps-grid fade-in">
                <div class="map-card">
                    <h4 class="map-title">Precipitation Radar</h4>
                    <iframe 
                        class="mini-weather-embed"
                        src="https://embed.windy.com/embed2.html?lat=45.04&lon=-78.51&detailLat=45.04&detailLon=-78.51&width=650&height=450&zoom=9&level=surface&overlay=rain&product=ecmwf&menu=&message=false&marker=&calendar=now&pressure=&type=map&location=coordinates&detail=&metricWind=default&metricTemp=default&radarRange=-1"
                        frameborder="0" 
                        loading="lazy"
                        title="Precipitation Radar">
                    </iframe>
                </div>
                <div class="map-card">
                    <h4 class="map-title">Wind Patterns</h4>
                    <iframe 
                        class="mini-weather-embed"
                        src="https://embed.windy.com/embed2.html?lat=45.04&lon=-78.51&detailLat=45.04&detailLon=-78.51&width=650&height=450&zoom=9&level=surface&overlay=wind&product=ecmwf&menu=&message=false&marker=&calendar=now&pressure=&type=map&location=coordinates&detail=&metricWind=default&metricTemp=default&radarRange=-1"
                        frameborder="0" 
                        loading="lazy"
                        title="Wind Patterns">
                    </iframe>
                </div>
                <div class="map-card">
                    <h4 class="map-title">Cloud Cover</h4>
                    <iframe 
                        class="mini-weather-embed"
                        src="https://embed.windy.com/embed2.html?lat=45.04&lon=-78.51&detailLat=45.04&detailLon=-78.51&width=650&height=450&zoom=9&level=surface&overlay=clouds&product=ecmwf&menu=&message=false&marker=&calendar=now&pressure=&type=map&location=coordinates&detail=&metricWind=default&metricTemp=default&radarRange=-1"
                        frameborder="0" 
                        loading="lazy"
                        title="Cloud Cover">
                    </iframe>
                </div>
            </div>
        </div>

        <!-- Live Cams Section -->
        <div class="visualization-section fade-in">
            <h2 class="section-title">Live Feeds</h2>
            <div class="maps-grid">
                <div class="map-card">
                    <h4 class="map-title">Little Kennisis Lake View</h4>
                    <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 10px;">
                        <iframe 
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border:0;" 
                            src="https://www.youtube.com/embed/rmEJrsiBkOQ" 
                            title="Little Kennisis Lake Live Stream" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
                <div class="map-card">
                    <h4 class="map-title">Downtown Haliburton</h4>
                    <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 10px;">
                        <iframe 
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border:0;" 
                            src="https://video.nest.com/embedded/live/zTx69o5fJz?autoplay=0" 
                            title="Downtown Haliburton Nest Cam" 
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- Environmental Monitoring -->
        <div class="environmental-section fade-in">
            <h2 class="section-title">Environmental Monitoring</h2>
            <div class="env-grid">
                <div class="env-card">
                    <div class="env-header">
                        <span class="env-icon">🌱</span>
                        <h4>Air Quality Index</h4>
                        <span class="env-value <?= $currentAqi['class'] ?>"><?= $currentAqi['text'] ?> (<?= $weatherData->current->aqi ?? '?' ?>/5)</span>
                    </div>
                    <div class="env-bar">
                        <div class="env-progress" style="width: <?= $currentAqi['pct'] ?>%"></div>
                    </div>
                    <p class="env-status"><?= $currentAqi['desc'] ?></p>
                </div>
                <!-- ... (Rest of environmental cards remain unchanged) ... -->
                <!-- Truncated for brevity, but full content is preserved in file creation -->
                <div class="env-card">
                    <div class="env-header">
                        <span class="env-icon">💧</span>
                        <h4>Drag Lake Level</h4>
                        <span class="env-value normal"><?= $waterLevel ? number_format($waterLevel, 2) . ' m' : 'N/A' ?></span>
                    </div>
                    <div class="env-details">
                        <div class="detail-item">
                            <span>Source:</span>
                            <span>Parks Canada (Dams)</span>
                        </div>
                        <div class="detail-item">
                            <span>Last Update:</span>
                            <span><?= $waterTime ? date('M j, g:i A', $waterTime) : 'Unknown' ?></span>
                        </div>
                    </div>
                </div>

                <div class="env-card">
                    <div class="env-header">
                        <span class="env-icon">🌡️</span>
                        <h4>Feels Like</h4>
                        <span class="env-value normal"><?= $currentFeelsLike ?>°C</span>
                    </div>
                    <div class="heat-scale">
                        <!-- Simple visual indicator based on temp (0% = -30C, 100% = 40C approx) -->
                        <?php $heatPct = min(100, max(0, (($currentFeelsLike + 30) / 70) * 100)); ?>
                        <div class="heat-marker" style="left: <?= $heatPct ?>%"></div>
                        <div class="scale-labels">
                            <span>Cold</span>
                            <span>Hot</span>
                        </div>
                    </div>
                </div>

                <div class="env-card">
                    <div class="env-header">
                        <span class="env-icon">☁️</span>
                        <h4>Cloud Cover</h4>
                        <span class="env-value normal"><?= $currentClouds ?>%</span>
                    </div>
                    <div class="env-bar">
                        <div class="env-progress" style="width: <?= $currentClouds ?>%; background: linear-gradient(90deg, #a0aec0, #cbd5e0);"></div>
                    </div>
                    <p class="env-status">Current sky coverage</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Scroll to Top Button -->
    <button class="scroll-to-top" id="scrollToTop" aria-label="Scroll to top">↑</button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        // Pass PHP weather data to JavaScript
        window.flowData = <?= json_encode($weatherData ?? []) ?>;
        console.log("Flow Data Loaded:", window.flowData); // Debugging for Chart
    </script>
    <script src="https://dragriver.ca/public/script.js"></script>
</body>
</html>