# Welcome to the Internet Home of Drew Roberts

This [GitHub Repository](https://github.com/drewroberts/website) contains the code behind the website of Drew Roberts - [DrewRoberts.com](https://drewroberts.com "Drew Roberts")

## Connect with Drew Roberts

- [X.com/DrewRoberts](https://X.com/DrewRoberts)
- [t.me/DrewRoberts](https://t.me/DrewRoberts)
- [YouTube.com/DrewRoberts](https://youtube.com/DrewRoberts)
- [LinkedIn.com/in/DrewRoberts](https://linkedin.com/in/DrewRoberts)

## AHA Stack

Astro, HTMX, Alpine along with Tailwind CSS & MDX. Access to my Protocol API for form submissions.

## Personal Brand Site Template

A production-ready personal brand website built with the AHA stack (Astro + HTMX + Alpine.js), styled with Tailwind CSS 4.

## Tech Stack

- **Astro** — Static site generator with server-side rendering for API routes
- **HTMX** — Partial page updates without client-side JavaScript frameworks
- **Alpine.js** — Lightweight reactivity for UI interactions
- **Tailwind CSS 4** — Utility-first CSS with custom theme configuration

## Getting Started

### Prerequisites

- Node.js 18+ 
- npm or pnpm

### Installation

```bash
# Install dependencies
npm install

# Start development server
npm run dev

# Build for production
npm run build

# Preview production build
npm run preview
```

The dev server runs at `http://localhost:4321` by default.

## Project Structure

```
src/
├── components/          # Reusable Astro components
│   ├── Footer.astro     # Site footer with navigation
│   ├── Hero.astro       # Homepage hero section
│   ├── Pillars.astro    # Value propositions
│   ├── FeaturedSections.astro  # Links to main sections
│   ├── CallToAction.astro      # CTA block
│   ├── PrinciplesAccordion.astro  # Alpine.js accordion
│   ├── ResourceFilter.astro    # HTMX filter tabs
│   └── ResourceList.astro      # Resource cards
├── layouts/
│   └── BaseLayout.astro  # Main HTML template with SEO
├── pages/
│   ├── index.astro       # Homepage
│   ├── architecture.astro # Approach/methodology page
│   ├── downloads.astro   # Resources with HTMX filtering
│   ├── privacy.astro     # Privacy policy
│   ├── docs/
│   │   ├── index.astro   # Guides hub
│   │   ├── for-clients.astro
│   │   └── for-collaborators.astro
│   └── api/
│       └── resources.astro  # HTMX endpoint
└── styles/
    └── global.css        # Tailwind config & custom styles
```

## HTMX Endpoints

### `/api/resources`

Returns filtered resource cards as an HTML partial.

**Query Parameters:**
- `category` — Filter resources by category
  - `all` — All resources (default)
  - `documents` — PDF documents (resume, bio)
  - `media` — Media kit (photos, logos, guidelines)
  - `links` — External links (social, booking)

**Example:**
```
GET /api/resources?category=documents
```

Returns HTML fragment that replaces the `#resource-list` container via HTMX swap.

**How it works:**
1. User clicks a filter tab on `/downloads`
2. HTMX intercepts the click and makes GET request to `/api/resources?category=X`
3. Server renders only the `ResourceList` component with filtered data
4. HTMX swaps the response into `#resource-list` container
5. No full page reload, no client-side state management

## Alpine.js Components

### Principles Accordion (`PrinciplesAccordion.astro`)

Expandable content sections on the Approach page:
- State: `openItem` (string | null)
- Single-open behavior (opening one closes others)
- Animated expand/collapse with `x-collapse` plugin
- ARIA attributes for accessibility

## Design System (Tailwind CSS 4)

The site uses a custom Tailwind theme defined in `src/styles/global.css` with the `@theme` directive:

### Custom Colors

```css
@theme {
  --color-bg-deep: #0a0b0d;
  --color-bg-primary: #121418;
  --color-bg-elevated: #1a1d23;
  --color-bg-surface: #22262e;
  --color-steel: #3d4654;
  --color-accent: #d97706;
  --color-accent-bright: #f59e0b;
  /* ... see global.css for full list */
}
```

### Usage with Tailwind

Colors are available as utility classes:
- `bg-bg-deep`, `bg-bg-elevated`, `bg-bg-surface`
- `text-text-primary`, `text-text-secondary`, `text-text-muted`
- `border-steel`, `border-accent`

### Custom Components

Reusable component classes defined in `@layer components`:
- `.btn`, `.btn-primary`, `.btn-secondary` — Button styles
- `.container`, `.container-narrow` — Layout containers
- `.section` — Section padding
- `.card` — Card component
- `.tag`, `.label` — Text utilities

### Typography

Custom fonts via CSS variables:
- `font-display` — Courier Prime (monospace headings)
- `font-body` — System font stack
- `font-mono` — Code/labels font

## Editing Content

### Homepage (`src/pages/index.astro`)
- Edit `Hero.astro` props for name, tagline, description
- Modify `Pillars.astro` for value propositions
- Update `FeaturedSections.astro` for section links

### Placeholder Name
- The default name is "John Doe" - search and replace throughout:
  - `src/components/Hero.astro` (name prop default)
  - `src/components/Footer.astro` (logo text)
  - `src/pages/*.astro` (page titles)

### Resources (`src/pages/downloads.astro` + `src/pages/api/resources.astro`)
- Both files contain the `allResources` array
- Keep them in sync when adding/removing resources
- Categories: `documents`, `media`, `links`

### Guides (`src/pages/docs/`)
- Edit content directly in Astro files
- Use Tailwind classes for styling

### Global Layout
- Footer nav links: `src/components/Footer.astro`
- SEO defaults: `src/layouts/BaseLayout.astro`

## SEO

Each page includes:
- Custom `<title>` and `<meta name="description">`
- Open Graph tags (og:title, og:description, og:image)
- Twitter Card tags
- Canonical URL
- Sitemap at `/sitemap.xml`
- Robots.txt at root

To customize:
1. Update `site` in `astro.config.mjs` for canonical URLs
2. Edit page-level props in each `.astro` file
3. Replace placeholder social/OG images in `public/`

## Production Build

```bash
npm run build
```

Output is in `dist/` folder. The site uses server-side rendering (SSR) for the API endpoint, so deploy to a platform that supports Node.js (Vercel, Netlify Functions, Cloudflare Workers, etc.).

For static export (no HTMX filtering), change `astro.config.mjs`:
```js
export default defineConfig({
  output: 'static', // instead of 'server'
});
```

## Browser Support

- Modern browsers (Chrome, Firefox, Safari, Edge)
- Progressive enhancement for older browsers
- Mobile-first responsive design
- AA contrast accessibility compliance

## License

Personal use. Modify and deploy as your own brand site.