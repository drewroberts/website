# The AHA Stack Constitution

This document defines the governing framework for building high-performance, professional websites using the **AHA Stack** (Astro, HTMX, Alpine.js). Adherence to these standards ensures project scalability, maintainability, and industry-leading performance.

---

## Article I: Architectural Philosophy

1. **Server-First Mental Model:** All content shall be pre-rendered at build-time whenever possible to ensure maximum SEO and zero-latency page loads.
2. **The Interactivity Rule:**
* Use **Astro** for routing, templating, and static structure.
* Use **Alpine.js** for local UI state (modals, toggles, dropdowns).
* Use **HTMX** for dynamic fragment swapping and communication with external Laravel APIs.


3. **Island Architecture:** JavaScript shall only be shipped to the client for specific "Islands" of interactivity, keeping the baseline payload near zero.

---

## Article II: Repository Structure

To maintain professional standards and predictability, the repository shall follow this hierarchy:

```text
├── src/
│   ├── components/
│   │   ├── ui/             # Reusable UI atoms (Buttons, Inputs)
│   │   └── mdx/            # Components specifically for the MDX Map
│   ├── content/
│   │   ├── blog/           # Markdown/MDX content files
│   │   └── config.ts       # Type-safe schemas (The "Models")
│   ├── layouts/            # Base templates (The "Blade" equivalent)
│   ├── pages/              # File-based routing
│   │   └── partials/       # HTMX-only endpoints (returning HTML fragments)
│   └── styles/             # Global CSS and Tailwind directives

```

---

## Article III: Visual Excellence & Optimization

1. **Next-Gen Formats:** No raw JPEGs or PNGs shall be served. All images must be processed into **AVIF** (primary) and **WebP** (fallback).
2. **The Pipeline:** All images must pass through the Astro Image Service to ensure automated compression and resizing.
3. **Layout Stability:** All images must define an explicit aspect ratio or dimensions to prevent Cumulative Layout Shift (CLS).

---

## Article IV: Content & The MDX Map

1. **Component-Enhanced Content:** Documentation and articles shall utilize `.mdx` files to allow for embedded interactivity within static text.
2. **The Global Map:** Every MDX render shall utilize a Custom Components Map. This ensures standard Markdown syntax produces branded, optimized UI components.
3. **Mapping Requirements:**
* `<a>` tags shall map to a `SmartLink` component (automated external link detection).
* `<img>` tags shall map to an optimized `Picture` component.
* `<blockquote>` tags shall map to a styled `Callout` component.



---

## Article V: Automated Deployment (CI/CD)

1. **The Official Workflow:** Deployment to GitHub Pages must be handled via the official `withastro/action` workflow.
2. **Deployment Source:** Repository settings must be set to "GitHub Actions" as the deployment source.
3. **The Production Chain:**
* **Build:** Site must build successfully in a clean runner environment.
* **Index:** Pagefind indexing must execute post-build to generate static search assets.
* **Deploy:** Artifacts are pushed to GitHub's CDN only after all validation steps pass.



---

## Article VI: Tailwind & Design Systems

1. **Typography Plugin:** The `@tailwindcss/typography` plugin is mandatory for all content-heavy areas.
2. **The Prose Class:** All content rendered via the MDX map must be wrapped in a `prose` container to maintain vertical rhythm and typographic hierarchy.
3. **Class Integrity:** All reusable UI components must utilize a standard `cn()` utility (combining `clsx` and `tailwind-merge`) to allow for safe, conflict-free class overrides.

---

## Article VII: API & Integration

1. **Decoupled Logic:** The frontend shall remain backend-agnostic. Connection to Laravel APIs must occur via client-side `fetch` or HTMX.
2. **Security Standards:** No private API keys or sensitive environment variables shall be exposed in client-side scripts. Public endpoints must be protected via CORS and Rate Limiting on the Laravel side.

---

## Article VIII: Code Quality & Standards

1. **Automated Formatting:** All code must be formatted via Prettier.
2. **Sorting:** Tailwind classes must be automatically sorted via the `prettier-plugin-tailwindcss` to ensure consistency and reduce merge conflicts.
3. **Type Safety:** All components and scripts must utilize TypeScript (`.ts`, `.tsx`) where applicable, adhering to the installed TypeScript configuration.

---
