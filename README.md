# astrofy-wp

A WordPress theme port of the excellent [Astrofy](https://github.com/manuelernestog/astrofy) personal portfolio template by Manuel Ernesto Garcia. Keeps the original's TailwindCSS + DaisyUI styling while integrating fully with WordPress content management.

## Features

- Personal portfolio layout with hero section, projects, services, CV/resume, blog, and store
- Styled with [Tailwind CSS](https://tailwindcss.com/) and [DaisyUI](https://daisyui.com/) — 30+ switchable themes
- WordPress Customizer support: configure hero text, CTAs, social links, and DaisyUI theme without touching code
- Blog with tag filtering, badges, and featured images
- Store with custom pricing, old/sale pricing, and checkout URL support
- CV/Resume page with repeatable Education, Experience, Certifications, and Skills sections
- Open Graph and Twitter Card meta tags for social sharing
- Responsive drawer navigation
- RSS feed via native WordPress

## Requirements

- WordPress 5.9 or higher
- PHP 7.4 or higher

## Installation

### For end users

1. Download `astrofy-wp.zip` from the [latest release](https://github.com/lukewrites/astrofy-wp/releases/latest).
2. In your WordPress dashboard, go to **Appearance → Themes → Add New → Upload Theme**.
3. Upload the `.zip` file and click **Activate**.

### Initial setup

After activating the theme, create the following pages in **Pages → Add New** and assign them the matching page template:

| Page title | Template |
|---|---|
| Projects | Projects |
| Services | Services |
| CV | CV |
| Store | (no template needed — uses the Store Items archive at `/store/`) |

Then go to **Appearance → Menus** and add these pages to the sidebar menu, or use the auto-generated fallback menu.

## Configuration

All key settings are in **Appearance → Customize**:

- **Site Identity** — profile image, contact email
- **Hero Section** — greeting, name, title, description, and two configurable CTA buttons
- **Social Links** — GitHub, Twitter/X, LinkedIn, and support/donate URL
- **DaisyUI Theme** — choose from 30+ themes (light, dark, synthwave, retro, cyberpunk, etc.)

## Content management

### Blog posts

Add posts normally. Each post supports:
- **Featured image** — displayed as hero in the post and as a card thumbnail
- **Badge** — a short label shown on the card (add via the "Post Badge" meta box in the editor)
- **Tags** — used for tag archive pages

### Store items

Add store items under **Store Items** in the WordPress admin sidebar. Each item supports:
- Price and old/sale price
- Badge label
- Checkout URL
- Custom link URL and label

### CV sections

On your CV page, use the **CV Sections** meta boxes at the bottom of the editor to add repeatable entries for Education, Experience, Certifications, and Skills.

## Development

### Prerequisites

- [Node.js](https://nodejs.org/) 18+
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) (for local WordPress environment)

### Setup

```bash
git clone https://github.com/lukewrites/astrofy-wp.git
cd astrofy-wp
npm install
```

### Local WordPress environment

This theme includes a [`@wordpress/env`](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-env/) configuration for a zero-config local WordPress instance via Docker.

```bash
# Start local WordPress (visit http://localhost:8888)
npm run env:start

# Stop
npm run env:stop

# Reset to a clean state
npm run env:clean
```

Default credentials: `admin` / `password`

### CSS development

The theme uses Tailwind CSS compiled from `assets/css/tailwind-src.css`.

```bash
# Watch for changes and rebuild
npm run watch:css

# One-time production build
npm run build:css
```

After making template changes, run a CSS build to ensure any new Tailwind classes are included in `assets/css/global.css`.

## Releasing

Releases are automated via GitHub Actions. To publish a new release:

1. Update the `Version` field in `style.css`.
2. Commit and push.
3. Create and push a version tag:

```bash
git tag v1.0.1
git push origin v1.0.1
```

The workflow will build the CSS, package the theme (excluding dev files), and publish a GitHub Release with `astrofy-wp.zip` attached.

## Credits & License

Originally designed and developed as an Astro template by [Manuel Ernesto Garcia](https://manuelernestog.github.io).
Ported to WordPress by [Luke Petschauer](https://github.com/lukewrites).

This project is licensed under the [MIT License](LICENSE).
