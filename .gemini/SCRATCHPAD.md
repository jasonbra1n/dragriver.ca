# 📝 Gemini Scratchpad

## 🚀 Current Session: Phase 2 - Core Pillars (Shop & Flow)

**Focus:** Building out the subdomain structure for 'Shop' and enhancing 'Flow'.

## 📍 Project Context
*   **Name:** Drag River Creative
*   **Location:** Haliburton, Ontario
*   **Vision:** Creative ecosystem (Apparel, Flow, Retreat, Studio, Events).
*   **Current State:**
    *   **Phase 1 Complete**: Foundation laid, v0.0.1 released.
    *   **Flow**: Basic router and static view in place at `flow.dragriver.ca`.
    *   **Shop**: Not started.

## 📋 Immediate Action Plan
- [x] **Shop Setup**: Create directory structure for `shop` subdomain (`public/shop/`).
- [x] **Shop Controller**: Create `public/shop/index.php`.
- [x] **Shop View**: Create `public/shop/view.php` (Converted from HTML).
- [ ] **Flow Data**: Connect `public/flow/index.php` to real weather API (OpenWeatherMap).
- [x] **Flow Cams**: Integrated YouTube & Nest embeds into `public/flow/view.php`.

## 🌊 Flow Data Strategy
*   **Atmosphere**: Use **OpenWeatherMap One Call 3.0** (Free tier: 1,000 calls/day).
    *   *Data*: Temp, Humidity, Pressure, UV Index, Wind Speed/Dir, Hourly Forecast, Daily Forecast, Alerts.
*   **Air Quality**: Use **OpenWeatherMap Air Pollution API**.
*   **Hydrology**: Use **Environment Canada Water Office** (Datamart/CSV).
    *   *Target*: Find station ID for Drag River or nearest equivalent (e.g., Burnt River system).
*   **Caching**: Implement file-based caching (TTL: 10 mins) in PHP to prevent hitting API limits on page reloads.

## 🧠 Discussion Points / Questions
1.  **Shop Tech**: Are we using a simple JS cart (Snipcart/Stripe) or a full PHP solution? (Roadmap says JS-based initially).
2.  **Shared Assets**: Ensure `shop` uses the absolute paths to `public/styles.css` like `flow` does.

## 💡 Notes
*   *Gemini*: Phase 1 is wrapped. Moving to specific pillar implementation.
*   *Creative*: **DRIPS** Acronym: (Dr)ag (Ri)ver (Ps)yche. Fits well with "Flow" (water) and "Apparel" (style/drip).
*   *User*: I want to add the public\flow folder to the file structure of the cpanel php hosting into the readme.md in the "## 📂 Project Structure" area. (brainstorming):I want all systems to understand the dual setup where github pages hosts the root and temporary the www, and cpanel will host subdomains with a shared upper level root folder called dragriver.ca\, giving us also a pathway to migrate the home page as well to cpanel and then converting the gitub index.html using pages into what ever if evolves into.
*   **Flow Resources**:
    *   Live Stream Channel: Little Kennisis Lake View (Current ID: `rmEJrsiBkOQ` - may change).
    *   Timelapse Channel: Daily Archives.
    *   Downtown Cam: Nest Feed (Troy Austen Real Estate) - `https://video.nest.com/live/zTx69o5fJz`.
*   **Events Planning**:
    *   **Spring Launch Party**:
        *   **Concept**: Community drum circle & bonfire.
        *   **Timing**: Spring 2026.
    *   **Drag River Revival**:
        *   **Concept**: Tubing down the lazy river.
        *   **Timing**: Summer 2026.
        *   **Route**: From the Dam to the bridge on Fred Jones Rd.
        *   **Logistics**: Community pit stops along route; Shuttle service from destination back to start.
        *   **Entertainment**: Live music & DJ at destination (all day, late finish).
        *   **Rules**: Possible BYOB (Strictly NO Glass).
*   **Retreat / Camp Features**:
    *   **Wildlife Experience**: Friendly wild deer population at main cabin (Photography opportunity).
*   **Shop Planning**:
    *   **2027 Deer Calendar**:
        *   **Concept**: Showcase the friendly deer at the Retreat through the seasons.
        *   **Action**: Year-round photography project starting now for 2027 release.
*   **Conservation / Restoration**:
    *   **Drag River Spawning Project**:
        *   **Issue**: Existing electric dam blocks historical fish spawning paths.
        *   **Goal**: Restore river as a spawning bed; improve habitat and fishing resources.
        *   **Strategy**: Research phase -> Awareness campaign -> Habitat restoration.
*   **Infrastructure**:
    *   **Connectivity**: Current internet insufficient for HD live streaming.
    *   **Solution**: Starlink is the only viable option at this location.
    *   **Funding**: Implement donation mechanism to cover hardware/subscription costs.
