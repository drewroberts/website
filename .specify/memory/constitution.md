<!--
SYNC IMPACT REPORT
Version Change: 0.0.0 -> 1.0.0 (Initial Creation)
Modified Principles:
- Added I. Architectural Philosophy
- Added II. Repository Structure
- Added III. Visual Excellence & Optimization
- Added IV. Content Strategy & The MDX Map
- Added V. Automated Deployment (CI/CD)
- Added VI. Tailwind & Design Systems
- Added VII. API & Integration
- Added VIII. Code Quality & Standards
Added Sections:
- Governance
Templates Requiring Updates:
- None (Templates use placeholders or generic checks)
Follow-up TODOs:
- None
-->

# Drew Roberts Personal Website Constitution

## Core Principles

### I. Architectural Philosophy
**Server-First Mental Model:** All content shall be pre-rendered at build-time whenever possible to ensure maximum SEO and zero-latency page loads.

**The Interactivity Rule:**
* Use **Astro** for routing, templating, and static structure.
* Use **Alpine.js** for local UI state (modals, toggles, dropdowns).
* Use **HTMX** for dynamic fragment swapping and communication with external Laravel APIs.

**Island Architecture:** JavaScript shall only be shipped to the client for specific "Islands" of interactivity, keeping the baseline payload near zero.

### II. Repository Structure
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

### III. Visual Excellence & Optimization
**Next-Gen Formats:** No raw JPEGs or PNGs shall be served. All images must be processed into **AVIF** (primary) and **WebP** (fallback).

**The Pipeline:** All images must pass through the Astro Image Service to ensure automated compression and resizing.

**Layout Stability:** All images must define an explicit aspect ratio or dimensions to prevent Cumulative Layout Shift (CLS).

### IV. Content Strategy & The MDX Map
**Component-Enhanced Content:** Documentation and articles shall utilize `.mdx` files to allow for embedded interactivity within static text.

**Scope:** Content shall cover Programming, AI, EVM Smart Contracts, and "Thoughts" (non-tech).

**The Global Map:** Every MDX render shall utilize a Custom Components Map. This ensures standard Markdown syntax produces branded, optimized UI components.

**Mapping Requirements:**
* `<a>` tags shall map to a `SmartLink` component (automated external link detection).
* `<img>` tags shall map to an optimized `Picture` component.
* `<blockquote>` tags shall map to a styled `Callout` component.

### V. Automated Deployment (CI/CD)
**The Official Workflow:** Deployment to GitHub Pages must be handled via the official `withastro/action` workflow.

**Deployment Source:** Repository settings must be set to "GitHub Actions" as the deployment source.

**The Production Chain:**
* **Build:** Site must build successfully in a clean runner environment.
* **Index:** Pagefind indexing must execute post-build to generate static search assets.
* **Deploy:** Artifacts are pushed to GitHub's CDN only after all validation steps pass.

### VI. Tailwind & Design Systems
**Typography Plugin:** The `@tailwindcss/typography` plugin is mandatory for all content-heavy areas.

**The Prose Class:** All content rendered via the MDX map must be wrapped in a `prose` container to maintain vertical rhythm and typographic hierarchy.

**Class Integrity:** All reusable UI components must utilize a standard `cn()` utility (combining `clsx` and `tailwind-merge`) to allow for safe, conflict-free class overrides.

### VII. API & Integration
**Decoupled Logic:** The frontend shall remain backend-agnostic. Connection to Laravel APIs must occur via client-side `fetch` or HTMX.

**Security Standards:** No private API keys or sensitive environment variables shall be exposed in client-side scripts. Public endpoints must be protected via CORS and Rate Limiting on the Laravel side.

### VIII. Code Quality & Standards
**Automated Formatting:** All code must be formatted via Prettier.

**Sorting:** Tailwind classes must be automatically sorted via the `prettier-plugin-tailwindcss` to ensure consistency and reduce merge conflicts.

**Type Safety:** All components and scripts must utilize TypeScript (`.ts`, `.tsx`) where applicable, adhering to the installed TypeScript configuration.

## Governance

This constitution defines the governing framework for building high-performance, professional websites using the **AHA Stack** (Astro, HTMX, Alpine.js). Adherence to these standards ensures project scalability, maintainability, and industry-leading performance.

**Amendments:** Changes to this constitution require a version bump following semantic versioning (MAJOR for breaking changes, MINOR for new principles, PATCH for clarifications).

**Compliance:** All Pull Requests must be verified against these principles.

**Version**: 1.0.0 | **Ratified**: 2025-12-20 | **Last Amended**: 2025-12-20
