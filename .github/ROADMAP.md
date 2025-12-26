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

### 👕 Shop (Apparel) - `shop.dragriver.ca`
- [ ] Design Product Listing Page (PLP).
- [ ] Design Product Detail Page (PDP).
- [ ] Integrate Shopping Cart (JS-based initially).
- [ ] Setup Payment Gateway (Stripe).

### 🌊 Flow (Dashboard) - `flow.dragriver.ca`
- [ ] Integrate Weather API (OpenWeatherMap or similar).
- [ ] Create Environment Variables Dashboard.
- [ ] Implement Data Visualization (Charts.js or D3).

### 🌲 Camp (Retreat) - `camp.dragriver.ca`
- [ ] Build Booking Calendar Interface.
- [ ] Create "Cabin/Location" Gallery.
- [ ] Implement Inquiry Form (PHP Mailer).

### 🎨 Create (Studio) - `create.dragriver.ca`
- [ ] Build Portfolio Grid.
- [ ] Create Blog/News Section.
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