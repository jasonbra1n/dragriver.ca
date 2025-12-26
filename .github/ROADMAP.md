# 🗺️ Project Roadmap

This document tracks the high-level goals and milestones for **Drag River Creative**.

---

## 🟢 Phase 1: Foundation & Standardization (Current)
**Goal:** Establish a clean, compliant codebase and deploy the initial landing page.

- [x] **Repo Setup**: Initialize Git, `.gitignore`, and basic documentation.
- [x] **Architecture Audit**: Transition from Legacy Python docs to Static/PHP model.
- [x] **Refactor Frontend**: Separate `index.html` into `public/styles.css` and `public/script.js`.
- [x] **Refactor Nav Menu**: Standardize responsive behavior and styling across pages.
- [x] **Backend Init**: Initialize `src/bootstrap.php` and verify path resolution.
- [ ] **CI/CD**: Setup basic GitHub Actions for linting (HTML/CSS/PHP).

---

## 🟡 Phase 2: Core Pillars (Next Up)
**Goal:** Build out the dedicated pages/sections for the four sub-brands.

### 👕 Shop (Apparel & Prints) - `shop.dragriver.ca`
- [ ] Design Product Listing Page (PLP).
- [ ] Design Product Detail Page (PDP).
- [ ] Implement "Coming Soon" Countdown Timer (Launch: Jan 1, 2026).
- [ ] Integrate Shopping Cart (JS-based initially).
- [ ] Setup Payment Gateway (Stripe).
- [ ] Product Dev: Begin photography for "2027 Deer Calendar" (Year-long project).

### 🌊 Flow (Dashboard) - `flow.dragriver.ca`
- [ ] **Core Weather**: Integrate OpenWeatherMap One Call 3.0 (Temp, Humidity, Wind, UV, Forecast).
- [ ] **Air Quality**: Integrate OpenWeatherMap Air Pollution API (AQI).
- [ ] **Hydrology**: Connect Environment Canada Water Office API for Drag River/Lake levels.
- [ ] **Backend**: Create `src/Services/WeatherService.php` with caching (Redis/File) to manage API rate limits.
- [ ] **Frontend**: Connect `view.php` to fetch JSON data from backend instead of `script.js` simulation.
- [ ] **Visualization**: Update Chart.js to render real 24h historical data.
- [x] Develop "Live Cams" area integrating "Little Kennisis Lake View" and Downtown Haliburton Nest Cam.
- [ ] Launch "River Restoration" research initiative (Dam impact & Spawning beds).

### 🌲 Camp (Retreat) - `camp.dragriver.ca`
- [ ] Build Booking Calendar Interface.
- [ ] Create "Cabin/Location" Gallery.
- [ ] Highlight "Wild Deer Experience" in copy/gallery.
- [ ] Implement Inquiry Form (PHP Mailer).

### 🎨 Create (Studio) - `create.dragriver.ca`
- [ ] Build Portfolio Grid.
- [ ] Integrate Blogger for Blog/News Section & Comments.
- [ ] Implement Workshop Scheduler.

### 🎫 Events - `events.dragriver.ca`
- [ ] Design Events Calendar/Listing.
- [ ] Create Event Detail Page.
- [ ] Integration with "Camp" for on-site event bookings.

---

## 🔴 Phase 3: Advanced Features (Future)
**Goal:** User accounts, automation, and physical-digital bridging.

- [ ] **User Authentication**: Login/Signup for returning customers.
- [ ] **Admin Panel**: CMS for managing products and blog posts.
- [ ] **Analytics**: Self-hosted privacy-focused analytics.

---

## 🧊 Icebox (Ideas)
*Potential features for later consideration.*

- Mobile App (PWA).
- Live stream integration for "Flow" (River cam).