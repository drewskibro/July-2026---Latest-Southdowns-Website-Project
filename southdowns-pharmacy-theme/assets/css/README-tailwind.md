# Tailwind CSS — build / rebuild

`assets/css/tailwind.css` is a **pre-compiled, purged, minified** Tailwind
stylesheet, enqueued in `functions.php`. It replaces the old Tailwind Play CDN
(`https://cdn.tailwindcss.com`), which shipped ~380KB of JavaScript that
compiled CSS in the browser on every page load — the main cause of poor
PageSpeed scores.

Because it is purged, **only the utility classes that appear in the theme's
`.php` files are included.** If you add markup that uses a *new* Tailwind class
(or edit ACF content to include one), you must rebuild this file, otherwise that
class will have no styles.

## Rebuild

Requires Node.js. From the theme root:

```sh
npx tailwindcss@3.4.17 \
  -i ./assets/css/tailwind-input.css \
  -o ./assets/css/tailwind.css \
  --content './**/*.php' \
  --minify
```

`tailwind-input.css` is just:

```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

The Jost font family (`font-jost`) is registered via `--content` scanning plus
the config; if you script the build, use this config:

```js
// tailwind.config.js
module.exports = {
  content: ['./**/*.php'],
  theme: { extend: { fontFamily: { jost: ['Jost', 'sans-serif'] } } },
};
```

## If something looks unstyled after deploying

A class used only in the database (e.g. typed into an ACF field) won't be in the
scanned `.php` files. Either add that class somewhere in a template, or add it to
a `safelist: []` array in the config and rebuild.
