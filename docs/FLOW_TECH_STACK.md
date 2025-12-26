# 🌊 Flow Dashboard - Technology Stack

This document outlines the technical architecture, libraries, and external services used to power the **Flow Dashboard** (`flow.dragriver.ca`).

## 🏗️ Architecture

The Flow dashboard follows a lightweight **Model-View-Controller (MVC)** pattern (currently Controller-View) implemented in PHP.

*   **Controller**: `public/flow/index.php`
    *   Handles request initialization.
    *   Loads the bootstrap environment (`src/bootstrap.php`).
    *   Prepares data (currently placeholders, future API integration point).
    *   Renders the view.
*   **View**: `public/flow/view.php`
    *   Contains the HTML structure.
    *   Renders dynamic data passed from the controller.
    *   Embeds external widgets (Windy, YouTube).

## 🎨 Frontend

*   **HTML5**: Semantic structure using `<main>`, `<section>`, and Grid layouts.
*   **CSS3**:
    *   **Glassmorphism**: Heavy use of `backdrop-filter: blur()`, `rgba()` backgrounds, and gradients to achieve the "water/flow" aesthetic.
    *   **Animations**: CSS Keyframes for floating orbs (`@keyframes float`) and fade-in effects.
    *   **Responsive Design**: CSS Grid and Flexbox with media queries for mobile/tablet adaptation.
*   **JavaScript (ES6+)**:
    *   **DOM Manipulation**: Vanilla JS for UI interactions (mobile menu, tabs).
    *   **Simulation**: `public/script.js` currently simulates live data updates (temperature, humidity) for demonstration purposes.

## 🔌 External Integrations & APIs

### 1. Weather Visualization (Windy.com)
We use the **Windy Map API** (via Iframe Embeds) to visualize real-time weather patterns.
*   **Endpoint**: `https://embed.windy.com/embed2.html`
*   **Layers Used**:
    *   `wind` (Wind speed & direction)
    *   `rain` (Precipitation radar)
    *   `clouds` (Cloud cover)
*   **Location**: Hardcoded to Haliburton, ON (`lat=45.04`, `lon=-78.51`).

### 2. Live Camera Feeds
*   **YouTube Embed API**: Used for the "Little Kennisis Lake View" stream.
    *   *Note*: Stream IDs may change and require manual updates or future API automation.
*   **Nest Cam Embed**: Used for the "Downtown Haliburton" feed via `video.nest.com`.

### 3. Data Visualization
*   **Chart.js**: Used for rendering the "24-Hour Temperature Trend" graph.
    *   Loaded via CDN: `https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js`

## 🔮 Future Roadmap (Backend)

*   **OpenWeatherMap API**: To replace the simulated data in `index.php` with real-time JSON data for specific metrics (Temp, Humidity, UV Index).
*   **Database**: To store historical environmental data for long-term trend analysis.