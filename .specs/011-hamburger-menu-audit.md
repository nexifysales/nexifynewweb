# Spec 011 — Hamburger Menu Audit & Accessibility Fixes

## Objective
Fully audit the hamburger navigation menu for correctness, accessibility compliance (WCAG 2.1 AA), and cross-browser compatibility, then apply all required fixes.

## Scope
- `/var/www/projects/nexifynewweb/includes/header.php` — markup & aria attributes
- `/var/www/projects/nexifynewweb/style.css` — animation, z-index, body scroll lock
- Inline JS in header.php or separate JS file controlling menu toggle

## Audit Checklist

### Visibility
- [ ] Hamburger appears at correct breakpoint (≤1024px per current style.css)
- [ ] Hidden on desktop (≥1025px) via `display:none`

### Tap Target
- [ ] Button ≥44×44px (iOS HIG + Material Design spec)

### Accessibility (WCAG 2.1 AA)
- [ ] `aria-label="Άνοιγμα μενού"` / `"Κλείσιμο μενού"` — toggles on open/close
- [ ] `aria-expanded="false"` → `"true"` on open
- [ ] `aria-controls` pointing to `<nav>` ID
- [ ] Keyboard navigable: Tab through links, Enter/Space to toggle, Esc to close
- [ ] Focus trap when menu open (Tab wraps within menu)
- [ ] Focus returns to toggle button on close

### Animation
- [ ] Open/close ≤300ms transition (no layout jump)
- [ ] Uses `transform: translateX()` (GPU-accelerated)

### Overlay Behavior
- [ ] Closes on outside click
- [ ] Closes on Esc key press
- [ ] Closes on nav link click (route change)

### Body Scroll
- [ ] `overflow:hidden` applied to `<body>` when menu is open
- [ ] Restored on close

### Z-index
- [ ] Menu z-index above all content (currently z-index:9999, confirm no conflicts)
- [ ] Header z-index consistent

### Cross-Browser
- [ ] Safari iOS: `height: 100dvh` (not `100vh` — fixes dynamic toolbar issue)
- [ ] Firefox: transition renders correctly
- [ ] Chrome Android: touch events work

## Deliverable Format
For each failure:
- File path + line number
- Current code snippet
- Fixed code snippet
- Test steps to verify

## Files to Modify
- `/var/www/projects/nexifynewweb/includes/header.php`
- `/var/www/projects/nexifynewweb/style.css`
- JS (inline in header or separate file)
