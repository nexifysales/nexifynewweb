<?php
/**
 * NexiFy — Site Configuration
 * Central config for IDs, keys, and feature flags.
 *
 * ⚠️  Do NOT commit real credentials to version control.
 *     Replace placeholders before going live.
 */

// ─── Google Analytics 4 ───────────────────────────────────────────────────────
// Replace G-XXXXXXXXXX with your real GA4 Measurement ID.
// GA fires ONLY after the user accepts analytics cookies (GDPR consent).
define('GA_MEASUREMENT_ID', 'G-VF22MC5P66');

// ─── Google Search Console Verification ───────────────────────────────────────
// Paste the verification code value from Search Console → "HTML tag" method.
// Example: define('GSC_VERIFICATION', 'abc123XYZ_your_code_here');
// Leave empty ('') to skip the meta tag entirely.
define('GSC_VERIFICATION', 'Xa4Lj5sREbPET8Xj0VxRfYUND0yYXELDdryu1mWNFeI');

// ─── Environment ──────────────────────────────────────────────────────────────
// Set to true on production (nexify.gr). Affects error reporting, etc.
define('IS_PRODUCTION', true);
