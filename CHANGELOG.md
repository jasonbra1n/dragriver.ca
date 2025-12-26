# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

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
- Moved `public/src/bootstrap.php` to `src/bootstrap.php` (Project Root) to improve security and demonstrate parent directory access.
- Updated `README.md` to reflect the transition from legacy Python architecture to the current PHP/Static hybrid model.
- Standardized project structure and coding conventions in `.gemini/PROMPT.md`.
- Updated main navigation in `index.html` to link directly to `public/flow/` instead of the `#flow` anchor.
- Updated `public/flow/flow.html` to use absolute URLs (`https://dragriver.ca/...`) for CSS, JS, and Navigation links to support subdomain hosting.
- Enhanced `public/flow/index.php` with strict typing, error handling, and data placeholders to prepare for API integration.
- Updated `public/flow/index.php` with dynamic path resolution for `bootstrap.php` to fix 500 errors on cPanel hosting.
- Updated `index.html` navigation and Flow brand card to link directly to the `flow.dragriver.ca` subdomain.
- Fixed styling issue in Contact Form dropdown where options were unreadable (white text on white background).
- Improved mobile UX: Navigation menu now automatically closes when a link is clicked.
- Updated `README.md` to reflect the new `src/` directory structure, added the "Events" pillar, and marked Phase 1 tasks as complete.

### Removed
- Deleted `temp.html` after migrating features to the main codebase.