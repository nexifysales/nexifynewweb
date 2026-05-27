# Spec 012 — Responsive QA: Cross-Device / Cross-Browser Testing & Fixes

## Objective
Systematically test all pages across the full device/browser matrix using Playwright at the specified viewports, identify all breakpoint failures, and apply fixes.

## Test Matrix

### Desktop Viewports
| Viewport | Simulates |
|----------|-----------|
| 1920×1080 | Windows 11 FHD, Linux |
| 1440×900 | MacBook Pro 14" |
| 1366×768 | Common Windows laptop |
| 1280×800 | Small laptop |

### Tablet Viewports
| Viewport | Simulates |
|----------|-----------|
| 1180×820 | iPad landscape |
| 820×1180 | iPad portrait |
| 1024×768 | iPad landscape (older) |
| 768×1024 | iPad portrait (older) |

### Mobile Viewports
| Viewport | Simulates |
|----------|-----------|
| 412×915 | Pixel 7 (Android) |
| 390×844 | iPhone 15 |
| 375×812 | iPhone X/11 |
| 375×667 | iPhone SE |
| 360×800 | Samsung Galaxy |
| 320×568 | iPhone SE 1st gen |

## Required Breakpoints to Verify
- ≤375px — small mobile
- 376–767px — mobile
- 768–1023px — tablet
- 1024–1439px — small desktop
- ≥1440px — large desktop

## Validation Criteria

### Must Pass (Zero Tolerance)
- [ ] NO horizontal scrollbar on any viewport (`document.body.scrollWidth <= window.innerWidth`)
- [ ] Body text ≥14px, CTA button text ≥16px
- [ ] Tap targets ≥44×44px on all touch viewports
- [ ] Images not distorted (`object-fit: cover/contain`)
- [ ] Sticky header does not overlap content (check `padding-top` on first section)
- [ ] Forms usable on mobile: `font-size:16px` on inputs (prevents iOS zoom)
- [ ] No console errors on any page/viewport

### Should Pass
- [ ] Typography scales fluidly between breakpoints
- [ ] Cards/grids collapse gracefully
- [ ] Footer wraps correctly on mobile
- [ ] CTA buttons stack vertically on small mobile (not side-by-side overflow)
- [ ] Hero section readable on 320px width

## Pages to Test
- / (index.php)
- /energy.php
- /ecosystem.php
- /virtual-office.php
- /contact.php
- /careers.php
- /faq.php

## Deliverable Format
For each failure:
- Viewport (width×height)
- Page URL
- Affected element (CSS selector)
- Root cause (overflow, fixed width, missing media query, font scaling, etc.)
- Proposed CSS fix

## Files to Modify
- `/var/www/projects/nexifynewweb/style.css`
- `/var/www/projects/nexifynewweb/css/responsive.css`
- Individual PHP pages if structural HTML changes needed

## Testing Approach
1. Playwright scripts iterate all pages × all viewports
2. Check `scrollWidth`, `clientWidth`, computed font-size, element dimensions
3. Screenshot each failing combo
4. Apply fixes and re-verify
