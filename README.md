# astrofy-wp

A WordPress theme for personal portfolio sites. Looks great out of the box.

## Install

1. Download `astrofy-wp.zip` from the [latest release](https://github.com/lukewrites/astrofy-wp/releases/latest) (or build it yourself — see below).
2. In WordPress, go to **Appearance > Themes > Add New > Upload Theme**.
3. Upload the zip and click **Activate**.

## Set up your site

1. Go to **Appearance > Customize** to set your name, profile photo, social links, and color theme.
2. Create pages for any sections you want (Projects, Services, CV, etc.) and pick the matching page template for each one.
3. Go to **Appearance > Menus**, create a menu, add your pages to it, and assign it to the **Sidebar Menu** location. Only the pages you add here will show up in the sidebar.

## Blog posts

Just write normal WordPress posts. You can set a featured image and add tags.

## Store items

Add store items under **Store Items** in the admin sidebar. Each one can have a price, image, and checkout link.

## Development

You need [Node.js](https://nodejs.org/) 18+ and [Docker Desktop](https://www.docker.com/products/docker-desktop/).

```bash
npm install
npx @wordpress/env start    # local WordPress at http://localhost:8888
npm run watch:css            # rebuild CSS on changes (run in a second terminal)
```

Login: `admin` / `password`

## Build a release zip

```bash
npm run build:css
```

Then zip the theme folder (excluding `node_modules`, `.git`, etc.) and upload it to your site.
