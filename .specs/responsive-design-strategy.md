# NexiFy — Responsive Web Design Strategy
## Senior UI/UX & Cross-Platform Architecture Report
**Version:** 1.0 | **Date:** 2026-05-02 | **Project:** nexify.gr

---

## Executive Summary

This document defines the complete responsive web architecture for Nexify.gr. The strategy is mobile-first, performance-driven, and cross-platform compatible, ensuring a premium UX from 320px mobile screens to 2560px+ 4K desktops.

---

## 1. Breakpoint System

### Defined Breakpoints (CSS Custom Properties)

```css
:root {
  --bp-xs:  320px;   /* Small Mobile — base */
  --bp-sm:  481px;   /* Large Mobile */
  --bp-md:  768px;   /* Tablet Portrait */
  --bp-lg:  835px;   /* Tablet Landscape */
  --bp-xl:  1025px;  /* Laptop */
  --bp-2xl: 1441px;  /* Desktop */
  --bp-3xl: 2560px;  /* 4K / Ultra-wide */
}
```

### Media Query Reference

| Device Type       | Width Range       | Media Query                                                |
|-------------------|-------------------|------------------------------------------------------------|
| Small Mobile      | 320px – 480px     | `@media (max-width: 480px)`                               |
| Large Mobile      | 481px – 767px     | `@media (min-width: 481px) and (max-width: 767px)`        |
| Tablet Portrait   | 768px – 834px     | `@media (min-width: 768px) and (max-width: 834px)`        |
| Tablet Landscape  | 835px – 1024px    | `@media (min-width: 835px) and (max-width: 1024px)`       |
| Laptop            | 1025px – 1440px   | `@media (min-width: 1025px) and (max-width: 1440px)`      |
| Desktop           | 1441px – 2560px+  | `@media (min-width: 1441px)`                              |
| 4K                | 2560px+           | `@media (min-width: 2560px)`                              |

---

## 2. Device-Specific UX Analysis

### Windows (Chrome, Edge, Firefox)
- **Scrollbar handling:** Windows shows native scrollbars (17px). Use `scrollbar-gutter: stable` to prevent layout shifts.
- **Font rendering:** ClearType active; slight rendering differences from macOS. Use `font-smooth: always` and `-webkit-font-smoothing: antialiased`.
- **Custom scrollbars:** Implement `::-webkit-scrollbar` for Chrome/Edge. Firefox uses `scrollbar-color` / `scrollbar-width`.
- **Edge-specific:** Edge supports all modern CSS. Chromium-based since 2020 — treat as Chrome.
- **Firefox:** No `backdrop-filter` performance issues. Test `@supports (backdrop-filter: blur(1px))`.

### macOS (Safari, Chrome)
- **Safari specifics:**
  - `position: sticky` inside `overflow: hidden` containers breaks — avoid nesting.
  - `-webkit-overflow-scrolling: touch` deprecated; use `overflow-y: scroll`.
  - `backdrop-filter` has `-webkit-` prefix requirement.
  - Form elements (date, select) need appearance reset.
  - Viewport height bug on iOS/macOS Safari: use `100dvh` for full-height sections (dynamic viewport).
- **Retina displays:** All macOS Macs use HiDPI. Serve @2x images, use SVG for icons, and `image-set()` for backgrounds.

### Linux (Chrome, Firefox)
- **Font rendering:** Less antialiasing than macOS. Use pixel-perfect sizes (`16px` minimum body text).
- **GTK styling:** Form elements inherit GTK theme on Firefox. Always reset with `appearance: none`.
- **Wayland/X11:** No display issues for web rendering.

### Android (Chrome Mobile, Samsung Internet)
- **Viewport:** Set `<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">`.
- **Touch targets:** Minimum 44×44px (Google recommends 48×48px for Android).
- **Tap highlight:** `WebkitTapHighlightColor: transparent` for custom tap states.
- **Safe area (notch, punch-hole):** Use `env(safe-area-inset-*)` for padding on notched devices.
- **Samsung Internet:** Based on Chromium. Test `backdrop-filter`, CSS Grid, and Flexbox — all supported.
- **Address bar height:** Variable. Use `100dvh` instead of `100vh`. Dynamic viewport units available in all modern Android browsers.
- **Overscroll:** `overscroll-behavior: none` for modals/drawers.

### Apple Ecosystem (Safari iPhone, Safari iPad, Chrome iOS)
- **iOS Safari quirks:**
  - 100vh includes browser chrome on older iOS. Use `100dvh` (iOS 16+) or JS-based fix for older.
  - `position: fixed` elements can jump during scroll — use `position: sticky` where possible.
  - Input zoom: Use `font-size: 16px` minimum on `<input>` to prevent auto-zoom.
  - Dynamic Island (iPhone 14 Pro+): Use `env(safe-area-inset-top)` — typically 47px.
  - Home indicator: `env(safe-area-inset-bottom)` — typically 34px.
- **Safari iPad:**
  - Pointer media query: `@media (pointer: coarse)` for touch-first layouts.
  - Stage Manager support (iPadOS 16+): Test multi-window scenarios.
  - Landscape keyboard: Use `@media (max-height: 500px)` to adjust fixed elements.
- **Chrome iOS:**
  - Uses WebKit engine (not Blink) on iOS per App Store policy.
  - Effectively identical to Safari for rendering.
  - WKWebView based — follow all Safari iOS rules.

---

## 3. UI/UX Requirements

### Navigation Adaptation
- **Desktop (1025px+):** Horizontal nav bar with hover states, mega-menu capability, full CTA button.
- **Tablet (768px–1024px):** Horizontal if space allows, hamburger when needed. 7+ nav items = hamburger.
- **Mobile (<768px):** Full-screen hamburger overlay with slide animation. Bottom sticky CTA bar for conversion.

### Touch Target Sizes
| Platform | Minimum Size | Recommended |
|----------|-------------|-------------|
| iOS (Apple HIG) | 44×44px | 48×48px |
| Android (Material) | 48×48px | 56×56px |
| Web WCAG 2.1 | 44×44px | 48×48px |
| Desktop (pointer) | 24×24px | 32×32px |

### Typography Scaling
```css
/* Fluid typography using clamp() */
--text-xs:   clamp(0.75rem,  1.5vw, 0.875rem);
--text-sm:   clamp(0.875rem, 1.8vw, 1rem);
--text-base: clamp(1rem,     2vw,   1.125rem);
--text-lg:   clamp(1.125rem, 2.5vw, 1.25rem);
--text-xl:   clamp(1.25rem,  3vw,   1.5rem);
--text-2xl:  clamp(1.5rem,   3.5vw, 2rem);
--text-3xl:  clamp(2rem,     5vw,   3rem);
--text-4xl:  clamp(2.5rem,   6vw,   4rem);
```

### Retina / High DPI Optimization
```html
<!-- Responsive images with srcset -->
<img
  src="logo-nexify.png"
  srcset="logo-nexify.png 1x, logo-nexify@2x.png 2x"
  sizes="(max-width: 600px) 100vw, 50vw"
  loading="lazy"
  decoding="async"
  alt="NexiFy Logo"
>
```
```css
/* HiDPI media query */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  .logo { background-image: url('logo@2x.png'); }
}
```

### Orientation Support
- **Portrait → Landscape transition:** Avoid fixed pixel heights. Use `min-height`, `dvh` units.
- **Landscape mobile:** Reduce hero section padding. Use `@media (orientation: landscape) and (max-height: 500px)`.
- **iPad Landscape:** 2-column layouts activate at 835px.

### Safe Areas (Notches, Dynamic Island, Home Bar)
```css
/* Apply to any fixed bottom elements */
.sticky-cta, .cookie-banner {
  padding-bottom: max(16px, env(safe-area-inset-bottom));
}

/* Apply to fixed top elements (Dynamic Island) */
.site-header {
  padding-top: env(safe-area-inset-top);
}

/* Body padding for edge-to-edge */
body {
  padding-left: env(safe-area-inset-left);
  padding-right: env(safe-area-inset-right);
}
```

### Accessibility (WCAG 2.1 AA)
- Color contrast ratio: minimum 4.5:1 for normal text, 3:1 for large text
- Focus styles: visible focus ring (2px solid outline) on all interactive elements
- Skip navigation link at top of page
- ARIA labels on icon-only buttons
- `prefers-reduced-motion` support
- `prefers-color-scheme` dark mode readiness
- Semantic HTML5 elements (`<header>`, `<nav>`, `<main>`, `<footer>`, `<section>`, `<article>`)

---

## 4. Layout Recommendations

### Mobile Layout (< 768px)
```
┌─────────────────────┐
│ [Logo]    [☰ Menu]  │  ← Sticky header (56px)
├─────────────────────┤
│                     │
│   Single Column     │
│   Hero Content      │
│                     │
├─────────────────────┤
│   Feature Cards     │
│   (1 per row)       │
├─────────────────────┤
│   Form              │
│   (full width)      │
├─────────────────────┤
│   Footer            │
│   (stacked)         │
├─────────────────────┤
│ [Home][Energy][FAQ] │  ← Bottom Nav (optional)
│ [Partners][Contact] │
├─────────────────────┤
│ [    PRIMARY CTA  ] │  ← Sticky CTA bar
└─────────────────────┘
```

### Tablet Layout (768px – 1024px)
```
┌─────────────────────────────────┐
│ [Logo]           [Nav... ][CTA] │  ← Sticky header (64px)
├─────────────────────────────────┤
│                                 │
│   Hero: Text left, Visual right │
│   (2-column at 835px+)          │
│                                 │
├─────────────────────────────────┤
│  [Card 1]  │  [Card 2]          │
│  [Card 3]  │  [Card 4]          │
├─────────────────────────────────┤
│   Footer: 2-column grid         │
└─────────────────────────────────┘
```

### Desktop Layout (1025px+)
```
┌─────────────────────────────────────────────────────┐
│ [Logo] [Home][Energy][Eco][Office][Partners][FAQ][CTA] │
├─────────────────────────────────────────────────────┤
│                                                     │
│  Hero (full-width)                                  │
│  ┌────────────────────┐  ┌─────────────────────┐   │
│  │  H1 + Lead + CTAs  │  │  Feature Visual Card │   │
│  └────────────────────┘  └─────────────────────┘   │
│                                                     │
├─────────────────────────────────────────────────────┤
│  [Card 1]  │  [Card 2]  │  [Card 3]  │  [Card 4]   │
├─────────────────────────────────────────────────────┤
│                  Footer 4-column                    │
└─────────────────────────────────────────────────────┘
```

---

## 5. Technical Requirements

### Mobile-First Approach
Write base styles for mobile, enhance for larger screens:
```css
/* Base: Mobile */
.grid-cards { display: grid; grid-template-columns: 1fr; gap: 16px; }

/* Tablet: 2 columns */
@media (min-width: 768px) {
  .grid-cards { grid-template-columns: repeat(2, 1fr); gap: 24px; }
}

/* Desktop: 3-4 columns */
@media (min-width: 1025px) {
  .grid-cards { grid-template-columns: repeat(3, 1fr); gap: 32px; }
}
@media (min-width: 1441px) {
  .grid-cards { grid-template-columns: repeat(4, 1fr); }
}
```

### CSS Grid + Flexbox Strategy
- **Flexbox:** Navigation, button groups, card headers, inline alignments
- **CSS Grid:** Page layouts, card grids, footer columns, feature matrices

### Fluid Typography (clamp-based)
Already implemented in style.css — enhance with CSS custom properties.

### Relative Units
| Property | Unit | Example |
|----------|------|---------|
| Font sizes | `rem` | `font-size: 1rem` |
| Spacing | `rem`, `em` | `padding: 1.5rem` |
| Widths | `%`, `vw` | `width: 92%` |
| Heights | `dvh`, `%` | `min-height: 100dvh` |
| Images | `%` with aspect-ratio | `width: 100%; aspect-ratio: 16/9` |

### Responsive Images
```html
<!-- Hero image with srcset -->
<picture>
  <source media="(max-width: 480px)" srcset="hero-mobile.webp" type="image/webp">
  <source media="(max-width: 1024px)" srcset="hero-tablet.webp" type="image/webp">
  <source srcset="hero-desktop.webp" type="image/webp">
  <img src="hero-desktop.jpg" alt="NexiFy Hero" loading="eager" fetchpriority="high">
</picture>
```

### Performance Optimization
1. **Critical CSS inlining** — inline above-the-fold styles in `<head>`
2. **Lazy loading** — `loading="lazy"` on all non-hero images
3. **Font subsetting** — only load Greek + Latin characters from Google Fonts
4. **Resource hints** — `<link rel="preconnect">`, `<link rel="dns-prefetch">`
5. **CSS containment** — `contain: layout paint` on card components
6. **will-change** — only on actively animated elements (remove after animation)

### Browser Compatibility Matrix

| Feature | Chrome | Firefox | Safari | Edge | Samsung | iOS Safari |
|---------|--------|---------|--------|------|---------|------------|
| CSS Grid | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| Flexbox | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| clamp() | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| backdrop-filter | ✅ | ✅ | ✅(-webkit) | ✅ | ✅ | ✅(-webkit) |
| CSS Variables | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| dvh/svh/lvh | ✅ | ✅ | ✅ | ✅ | ✅ | ✅(iOS16+) |
| Container Queries | ✅ | ✅ | ✅ | ✅ | ✅ | ✅(iOS16+) |
| scroll-behavior | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| aspect-ratio | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| env() safe-area | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |

---

## 6. Analytics Strategy

### Device Category Tracking (Google Analytics 4)
```javascript
// Custom dimension: device_type
const deviceType = (() => {
  const w = window.innerWidth;
  if (w < 481) return 'mobile-small';
  if (w < 768) return 'mobile-large';
  if (w < 835) return 'tablet-portrait';
  if (w < 1025) return 'tablet-landscape';
  if (w < 1441) return 'laptop';
  return 'desktop';
})();

gtag('set', { device_type: deviceType });
```

### Browser Analysis
- Track browser via `navigator.userAgent` or GA4 built-in dimensions
- Monitor for Safari-specific issues with Error Tracking

### OS Segmentation
- GA4: Tech > Operating System
- Create custom audience segments by OS for conversion analysis

### Screen Resolution Analysis
- GA4: Tech > Screen Resolution
- Identify popular resolutions to prioritize testing

### Key Metrics by Device
| Metric | Tool | Goal |
|--------|------|------|
| Bounce rate by device | GA4 | Mobile < 60%, Desktop < 50% |
| Conversion rate by platform | GA4 Goals | Mobile ≥ 2%, Desktop ≥ 4% |
| Core Web Vitals | CrUX / PageSpeed | LCP < 2.5s, FID < 100ms, CLS < 0.1 |
| Scroll depth by device | GA4 / Hotjar | > 70% reach CTA |

### Heatmaps & Scroll Behavior
- **Tool:** Hotjar or Microsoft Clarity (free)
- **Mobile vs Desktop sessions** compared
- **Click/tap heatmaps** per device category
- **Scroll maps** to find drop-off points

---

## 7. Performance Checklist

### Loading Performance
- [ ] `loading="lazy"` on all non-LCP images
- [ ] `fetchpriority="high"` on LCP image (hero)
- [ ] Fonts with `display=swap` or `display=optional`
- [ ] Preconnect to fonts.googleapis.com
- [ ] Minify CSS in production
- [ ] Use WebP/AVIF image formats
- [ ] Enable gzip/brotli compression on server
- [ ] Set proper cache headers (Cache-Control)
- [ ] Remove unused CSS
- [ ] Defer non-critical JS

### Core Web Vitals Targets
| Metric | Target | Current Concern |
|--------|--------|-----------------|
| LCP (Largest Contentful Paint) | < 2.5s | Hero section images |
| FID / INP (Interaction to Next Paint) | < 200ms | JS bundle size |
| CLS (Cumulative Layout Shift) | < 0.1 | Font loading, images without dimensions |
| TTFB (Time to First Byte) | < 600ms | Server response |

---

## 8. SEO Mobile Checklist

- [ ] Viewport meta tag: `<meta name="viewport" content="width=device-width, initial-scale=1">`
- [ ] Canonical URLs per page
- [ ] Structured data (JSON-LD) for LocalBusiness, WebSite
- [ ] Open Graph + Twitter Card tags
- [ ] Hreflang for multilingual (el/en)
- [ ] Mobile-friendly test passing (Google)
- [ ] Page speed > 90 on mobile (Lighthouse)
- [ ] No interstitials blocking content
- [ ] Tap targets ≥ 44px, properly spaced
- [ ] Font-size ≥ 16px on mobile inputs (prevents iOS zoom)
- [ ] Sitemap.xml submitted to Google Search Console
- [ ] robots.txt allowing Googlebot

---

## 9. Testing Tools Recommendations

### Browser Testing
| Tool | Purpose | Cost |
|------|---------|------|
| Chrome DevTools | Breakpoint testing, performance, accessibility audit | Free |
| Firefox DevTools | CSS Grid inspector, font rendering | Free |
| Safari Web Inspector | iOS/macOS specific bugs | Free (macOS) |
| BrowserStack | Real device testing across 3000+ devices | Paid |
| Responsively App | Multi-device preview side-by-side | Free (open source) |

### Performance Testing
| Tool | Purpose |
|------|---------|
| Lighthouse (in Chrome) | CWV, accessibility, SEO audit |
| Google PageSpeed Insights | Real-world CrUX data |
| WebPageTest | Waterfall, filmstrip, multi-location |
| GTmetrix | Detailed performance reports |

### Accessibility Testing
| Tool | Purpose |
|------|---------|
| axe DevTools | WCAG 2.1 automated checks |
| WAVE | Visual accessibility evaluation |
| Colour Contrast Analyser | Manual contrast checking |
| VoiceOver (macOS/iOS) | Screen reader testing |
| NVDA (Windows) | Screen reader testing |

### Cross-browser Automation
| Tool | Purpose |
|------|---------|
| Playwright | Cross-browser E2E testing (Chrome, Firefox, Safari, Mobile) |
| Percy | Visual regression testing |
| Storybook | Component-level visual testing |

---

## 10. Implementation Files

| File | Purpose |
|------|---------|
| `style.css` | Core design system (brand, typography, components) |
| `css/responsive.css` | Advanced responsive enhancements, container queries |
| `css/mobile-nav.css` | Mobile navigation and bottom bar |
| `css/accessibility.css` | Focus styles, reduced motion, high contrast |
| `responsive-preview.php` | Live breakpoint demonstration page |
| `js/responsive-utils.js` | Device detection, analytics helpers |

---

## 11. Cross-Platform Compatibility Matrix

| Feature | iOS Safari | Android Chrome | macOS Safari | Windows Chrome | Windows Edge | Windows Firefox | Linux Chrome |
|---------|------------|----------------|--------------|----------------|--------------|-----------------|--------------|
| Sticky Header | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| Mobile Hamburger | ✅ | ✅ | N/A | N/A | N/A | N/A | N/A |
| CSS Grid 3-col | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| backdrop-filter | ✅(-webkit) | ✅ | ✅(-webkit) | ✅ | ✅ | ✅ | ✅ |
| Safe Area insets | ✅ | ✅ | ✅ | N/A | N/A | N/A | N/A |
| 100dvh | ✅(iOS16+) | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| Hover states | ❌ (touch) | ❌ (touch) | ✅ | ✅ | ✅ | ✅ | ✅ |
| Scroll behavior | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| Container Queries | ✅(iOS16+) | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| Fluid Typography | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |

---

*Generated by HeroAgent for Nexify.gr — NEXIFYWEB-0009*
