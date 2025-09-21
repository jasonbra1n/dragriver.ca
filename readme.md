**Project:** `dragriver.ca`
**Repo URL:** *[(https://github.com/jasonbra1n/dragriver.ca/)*]

---

## Table of Contents
1. [About the Project](#about-the-project)
2. [Architecture Overview](#architecture-overview)
3. [Tech Stack](#tech-stack)
4. [Folder Structure](#folder-structure)
5. [Core Features](#core-features)
6. [Development Workflow](#development-workflow)
7. [Setup & Local Development](#setup--local-development)
8. [Testing](#testing)
9. [Deployment](#deployment)
10. [Roadmap / Milestones](#roadmap---milestones)
11. [Contributing](#contributing)
12. [License](#license)

---

## 1. About the Project  
Drag River Creative is a unified brand that encompasses:

| Sub‑Brand | Purpose |
|-----------|---------|
| **Apparel** | E‑commerce store for apparel & accessories. |
| **Flow (Web App)** | Environment‑variables + weather dashboard. |
| **Retreat** | Booking & information portal for private meeting/camp space. |
| **Studio** | Portfolio, blog, and workshop scheduling. |

The website will host all four lines under a single domain with clear navigation, consistent branding, and a modular architecture that allows each sub‑brand to evolve independently.

---

## 2. Architecture Overview  
```
frontend/          ← React SPA (Next.js)
├─ pages/
│   ├─ index.tsx                // Home
│   ├─ apparel/                 // Apparel store
│   │   └─ [slug].tsx
│   ├─ flow/                    // Weather / env‑vars dashboard
│   ├─ retreat/                 // Retreat booking page
│   └─ studio/                  // Studio portfolio & blog
├─ components/
├─ styles/
└─ public/

backend/           ← FastAPI (Python) API for data, auth, payments, bookings
├─ app/
├─ models/
├─ schemas/
├─ services/
└─ main.py

docker-compose.yml   ← Compose file to run front‑end + back‑end locally
```

> **Why this stack?**  
> *Next.js* gives SSR + static generation for SEO, while the API layer in FastAPI provides a fast, typed backend that can easily integrate with Stripe, Calendly, or any external services.

---

## 3. Tech Stack  

| Layer | Library / Tool | Why |
|-------|----------------|-----|
| **Front‑end** | Next.js (React) + TypeScript | SSR for SEO, file‑based routing, built‑in API routes. |
| **Styling** | Tailwind CSS + `clsx` | Rapid utility‑first styling; consistent design system. |
| **State** | React Query / SWR | Data fetching with caching & revalidation. |
| **Auth** | Auth0 or NextAuth.js | Secure login for admin/back‑office, optional customer auth. |
| **Payments** | Stripe API (checkout) | E‑commerce & subscription handling. |
| **Back‑end** | FastAPI + Pydantic | Fast, async, auto‑generated docs. |
| **Database** | PostgreSQL (Dockerized) | Relational data for products, bookings, user accounts. |
| **ORM** | SQLAlchemy / Tortoise-ORM | Type‑safe DB access. |
| **Testing** | Jest + React Testing Library; Pytest | Unit & integration tests. |
| **CI/CD** | GitHub Actions → Docker Hub → Render / Vercel | Automated builds, linting, testing, and deployment. |
| **Analytics** | Plausible or Google Analytics | Visitor insights without heavy scripts. |

---

## 4. Folder Structure (Key Parts)  

```
/frontend
 ├─ components/
 │   ├─ layout/
 │   ├─ nav/
 │   └─ sub-brand/
 ├─ pages/
 │   ├─ _app.tsx
 │   ├─ index.tsx
 │   ├─ apparel/
 │   ├─ flow/
 │   ├─ retreat/
 │   └─ studio/
 ├─ styles/
 ├─ public/
 └─ utils/

 /backend
 ├─ app/
 │   ├─ main.py
 │   ├─ routers/
 │   │   ├─ apparel.py
 │   │   ├─ flow.py
 │   │   ├─ retreat.py
 │   │   └─ studio.py
 │   ├─ services/
 │   └─ models/
 ├─ tests/
 └─ Dockerfile

 docker-compose.yml
 README.md
```

---

## 5. Core Features  

| Feature | Description | Priority |
|---------|-------------|----------|
| **Global Navigation** | Header with links to Apparel, Flow, Retreat, Studio + logo | ★★ |
| **Responsive Layout** | Mobile‑first design with Tailwind breakpoints | ★★ |
| **Apparel Store** | Product catalog, cart, checkout via Stripe, admin panel (CRUD) | ★★★ |
| **Flow Dashboard** | Live weather API integration, environment variable editor, data export | ★★ |
| **Retreat Booking** | Calendar view, booking form, confirmation email | ★★ |
| **Studio Portfolio** | Blog posts, gallery, workshop schedule, contact form | ★★ |
| **SEO Optimisation** | Meta tags, sitemap.xml, robots.txt | ★★ |
| **Analytics & Tracking** | Plausible integration (privacy‑first) | ★ |
| **Accessibility** | WCAG 2.1 AA compliance | ★ |
| **Testing** | Unit tests for components and API endpoints | ★ |

---

## 6. Development Workflow  

1. **Feature Branch** – `feature/<short-name>`  
2. **Pull Request** – review, CI checks, automated tests  
3. **Merge to `develop`** – run integration tests  
4. **Deploy to Staging** (Render / Vercel)  
5. **Release Tag** – `vX.Y.Z`, merge into `main` → production deploy  

---

## 7. Setup & Local Development

```bash
# Clone repo
git clone https://github.com/your-org/drag-river-creative.git
cd drag-river-creative

# Install Docker (if not already)
docker compose up --build   # Starts DB, backend, frontend in dev mode

# Frontend dev server
cd frontend
npm install
npm run dev     # http://localhost:3000

# Backend dev server
cd ../backend
pip install -r requirements.txt
uvicorn app.main:app --reload  # http://127.0.0.1:8000
```

> **Environment Variables** – copy `.env.example` to `.env` and fill in API keys, DB credentials, Stripe secrets.

---

## 8. Testing

```bash
# Frontend
cd frontend
npm run test    # Jest + RTL

# Backend
cd ../backend
pytest          # Pytest
```

CI pipeline runs these tests automatically on every PR.

---

## 9. Deployment

| Platform | How |
|----------|-----|
| **Frontend** | Vercel – deploy `frontend/` with Next.js build settings. |
| **Backend** | Render or Fly.io – Docker container from `backend/Dockerfile`. |
| **Database** | Render Postgres (or self‑hosted). |
| **Domain** | dragriver.ca → Point to Vercel & Render services. |

*Automated deploy hooks in GitHub Actions trigger rebuilds on pushes to `main`.*

---

## 10. Roadmap / Milestones  

| Sprint | Goals |
|--------|-------|
| **Sprint 1** | Set up repo, CI/CD, Docker environment, basic Next.js scaffold. |
| **Sprint 2** | Global layout + navigation; Tailwind config; SEO basics. |
| **Sprint 3** | Apparel store (frontend) + FastAPI CRUD endpoints. |
| **Sprint 4** | Flow dashboard – weather API integration & env‑var editor. |
| **Sprint 5** | Retreat booking page + calendar integration. |
| **Sprint 6** | Studio portfolio, blog, workshop scheduler. |
| **Sprint 7** | Payment flows (Stripe), admin panel, user auth. |
| **Sprint 8** | Testing polish, accessibility audit, performance optimization. |
| **Sprint 9** | Analytics, monitoring, final QA, launch to production. |

---

## 11. Contributing

1. Fork the repo.  
2. Create a feature branch (`feature/<name>`).  
3. Commit with clear messages (`feat: add product list component`).  
4. Open a PR against `develop`.  

Pull requests must pass CI and include unit tests where applicable.

---

## 12. License

MIT © Drag River Creative – see [LICENSE](./LICENSE).

--- 

Happy building! 🚀
