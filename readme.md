# Drag River Creative

**URL**: https://dragriver.ca
**Repository**: https://github.com/Drag-River/dragriver.ca

---

## 🌊 About the Project
Drag River Creative is a unified creative ecosystem based in Haliburton, Ontario. It encompasses five distinct pillars:


| Sub‑Brand | Purpose |
|-----------|---------|
| **Shop** | E‑commerce for apparel, prints, and calendars. |
| **Flow (Web App)** | Environment‑variables + weather dashboard. |
| **Retreat** | Booking & information portal for private meeting/camp space. |
| **Studio** | Portfolio, blog, and workshop scheduling. |
| **Events** | Community gatherings, workshops, and pop-up experiences. |

The website hosts all five pillars under a single domain with clear navigation, consistent branding, and a modular architecture that allows each sub‑brand to evolve independently.

---

## 🛠 Tech Stack

*   **Frontend**: Vanilla HTML5, CSS3, JavaScript (ES6+)
*   **Backend**: PHP (Planned/In-Progress)
*   **Conventions**: Strict separation of concerns (CSS/JS/PHP in `public/`).

## 📂 Project Structure

```text
/
├── .gemini/           # AI Context & Documentation
├── .github/           # GitHub workflows & templates
├── docs/              # Technical Documentation
├── public/            # Web root (Assets, CSS, JS)
│   ├── styles.css
│   ├── script.js
│   ├── events/            # Events (Subdomain)
│   ├── flow/              # Flow Dashboard (Subdomain)
│   ├── shop/              # Shop (Subdomain)
│   └── src/               # Backend logic (Bootstrap, Config)
│       └── bootstrap.php
├── index.html         # Entry point
└── README.md
```

## 🚀 Getting Started

1.  **Clone the repository**
    ```bash
    git clone https://github.com/Drag-River/dragriver.ca.git
    ```
2.  **Serve the project**
    Since this is currently a static/PHP hybrid, you can use the built-in PHP server:
    ```bash
    php -S localhost:8000
    ```
    Or simply open `index.html` in your browser for the static view.

## 🗺 Roadmap

We are currently in the process of standardizing the codebase.

*   [x] **Refactor**: Move inline CSS/JS from `index.html` to `public/`.
*   [x] **Backend**: Initialize `src/bootstrap.php` for PHP logic.
*   [ ] **Content**: Expand sub-brand sections.

Refer to `.github/ROADMAP.md` for the detailed task list.

## 🤝 Contributing

Please read `.github/CONTRIBUTING.md` for details on our code of conduct and the process for submitting pull requests.

## 📄 License

MIT © Drag River Creative