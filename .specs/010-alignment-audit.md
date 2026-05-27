# Spec 010 — Alignment Audit & CSS Fixes

## Objective
Systematically audit every page for CTA button and pillar/feature block alignment issues, then apply surgical CSS fixes.

## Scope
Pages to audit:
- index.php (home)
- energy.php
- ecosystem.php
- virtual-office.php
- contact.php
- careers.php
- faq.php
- cookies.php

## Horizontal Alignment Checks
- All CTA buttons share the same horizontal axis within their section
- Pillar/feature cards have equal width + consistent left/right padding
- Button text is centered (no off-center labels)
- Section containers respect the same max-width grid (confirm: 1200px or 1320px)

## Vertical Alignment Checks
- Buttons in a row share equal height (use `min-height`, not `auto`)
- Pillar/feature cards have equal height regardless of content (parent grid: `display:flex; align-items:stretch`)
- Icons inside pillars are vertically centered relative to their headings
- CTA button text vertically centered (`display:flex; align-items:center; justify-content:center`)

## Deliverable Format
For each misaligned element:
- Page URL
- CSS selector
- Current behavior vs expected
- Proposed CSS fix (diff format)

## Technical Approach
1. Use Playwright to screenshot each page at 1440px, 1280px, 768px
2. Inspect computed styles via Playwright `evaluate()`
3. Identify misalignments programmatically
4. Apply fixes to `style.css` or `css/responsive.css`
5. Re-screenshot to verify fixes

## Files to Modify
- `/var/www/projects/nexifynewweb/style.css` — primary fixes
- `/var/www/projects/nexifynewweb/css/responsive.css` — breakpoint-specific fixes
