# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [v0.0.2] - 2025-12-26

### Added
- Implemented "hamburger-to-X" animation for the mobile menu in `public/styles.css` and `public/script.js`.
- Added `public/shop/` structure with a countdown timer for the Apparel launch.
- Integrated "Live Cams" section into `public/flow/flow.html` with YouTube and Nest embeds.

### Changed
- Updated `STYLE_GUIDE.md` to document the new navigation animation.
- Restored countdown timer in `public/shop/view.php` with corrected target date (Jan 1, 2026) to fix premature "We Are Live" state.
- Updated `index.html` navigation and Apparel brand card to link directly to `https://shop.dragriver.ca/`.
- Expanded Shop description in `index.html`, `README.md`, and `public/shop/view.php` to include Prints and Calendars.
- Updated Brand Icons in `index.html` from letters to emojis for better visual representation.
- Created `public/events/` subdomain structure with `index.php`, `view.php`, and `revival.php` for the "Drag River Revival" event.
- Updated event dates to 2026 and added "Spring Launch Party" (Drum Circle) to `public/events/view.php`.
- Converted `public/flow/flow.html` to `public/flow/view.php` and fixed Windy API connection issues by updating embed URLs.
- Updated `public/flow/view.php` to focus weather maps and data on Haliburton, ON (Drag Lake area) instead of Toronto.
- Added `docs/FLOW_TECH_STACK.md` to document the technologies, APIs, and architecture used in the Flow dashboard.
- Updated `index.html` navigation and Events brand card to link directly to `https://events.dragriver.ca/`.
- Updated `ROADMAP.md` and `SCRATCHPAD.md` with detailed API integration strategy (OpenWeatherMap, Environment Canada) for the Flow dashboard.
- Reviewed documentation and corrected `README.md` to consistently refer to the "Shop" pillar (previously "Apparel").
- Added "Support & Infrastructure" section to `ROADMAP.md` focusing on Donations and Starlink for live streaming.

## [v0.0.1] - 2025-12-25

### Added
- Created `public/src/bootstrap.php` for backend initialization.
- Created `public/styles.css` and `public/script.js` to separate concerns from `index.html`.
- Added `CHANGELOG.md` to track project history.
- Integrated "Sticky CTA", "Stats Counter", and "FAQ Accordion" components into `index.html`.
- Moved `flow.html` to `public/flow/` and updated asset paths to prepare for subdomain architecture.
- Created `public/flow/index.php` as the entry point for the Flow dashboard.
- Defined subdomain architecture: `shop`, `camp`, `create`, `flow`, and `events`.
- Added "Events" pillar to `index.html` navigation, brands grid, and contact form.

### Changed
- Refactored `index.html` to link to external assets in `public/`.
- Standardized Navigation Menu responsiveness and structure across `index.html` and `flow.html`.
- Updated `README.md` to reflect the transition from legacy Python architecture to the current PHP/Static hybrid model.
- Standardized project structure and coding conventions in `.gemini/PROMPT.md`.
- Updated main navigation in `index.html` to link directly to `public/flow/` instead of the `#flow` anchor.
- Updated `public/flow/flow.html` to use absolute URLs (`https://dragriver.ca/...`) for CSS, JS, and Navigation links to support subdomain hosting.
- Enhanced `public/flow/index.php` with strict typing, error handling, and data placeholders to prepare for API integration.
- Updated `public/flow/index.php` with dynamic path resolution for `bootstrap.php` to fix 500 errors on cPanel hosting.
- Updated `index.html` navigation and Flow brand card to link directly to the `flow.dragriver.ca` subdomain.
- Fixed styling issue in Contact Form dropdown where options were unreadable (white text on white background).
- Improved mobile UX: Navigation menu now automatically closes when a link is clicked.
- Updated `README.md` to reflect the subdomain architecture, `public/src/` structure, added the "Events" pillar, and marked Phase 1 tasks as complete.

### Removed
- Deleted `temp.html` after migrating features to the main codebase.