#!/usr/bin/env php
<?php
/**
 * NexiFy — Single-page renderer for static build
 *
 * Usage: php deploy/render-page.php <source.php> <output-name>
 * Example: php deploy/render-page.php index.php index
 *
 * Outputs rendered HTML to stdout.
 */

if ($argc < 3) {
    fwrite(STDERR, "Usage: php render-page.php <source.php> <output-name>\n");
    exit(1);
}

$page     = $argv[1];  // e.g. "energy.php"
$pageName = $argv[2];  // e.g. "energy"

$projectRoot = dirname(__DIR__);
$sourcePath  = $projectRoot . '/' . $page;

if (!file_exists($sourcePath)) {
    fwrite(STDERR, "SKIP: $page (not found)\n");
    exit(0);
}

// Simulate a real browser/web-server environment
$_SERVER['HTTP_HOST']       = 'nexify.gr';
$_SERVER['HTTPS']           = 'on';
$_SERVER['SERVER_NAME']     = 'nexify.gr';
$_SERVER['SERVER_PORT']     = '443';
$_SERVER['REQUEST_URI']     = '/' . $pageName . '.html';
$_SERVER['REQUEST_METHOD']  = 'GET';
$_SERVER['PHP_SELF']        = '/' . $page;
$_SERVER['SCRIPT_NAME']     = '/' . $page;
$_SERVER['SCRIPT_FILENAME'] = $sourcePath;

$_GET   = [];
$_POST  = [];
$_FILES = [];

// Change working dir so relative includes work
chdir($projectRoot);

// Capture page output
ob_start();
include $sourcePath;
$html = ob_get_clean();

// ─── Post-processing ──────────────────────────────────────────
// Fix canonical/og:url meta tags: https://nexify.gr/page.php → .html
$html = preg_replace(
    '/content="(https:\/\/nexify\.gr\/[^"]+)\.php"/',
    'content="$1.html"',
    $html
);
// Fix <link rel="canonical" href="...php">
$html = preg_replace(
    '/href="(https:\/\/nexify\.gr\/[^"]+)\.php"/',
    'href="$1.html"',
    $html
);

// Fix chatbot widget endpoint: data-api="chatbot/api.php" → data-api="chatbot/api"
$html = str_replace(
    'data-api="chatbot/api.php"',
    'data-api="chatbot/api"',
    $html
);

// Replace .php links with .html (internal pages only)
// Pattern: href="page.php" or href="page.php#..." or href="page.php?..."
$html = preg_replace_callback(
    '/\b(href|action)="([^"#?]*?)\.php([#?][^"]*)?"/',
    function ($m) {
        // Keep external URLs (contain //) unchanged
        if (strpos($m[2], '//') !== false) return $m[0];
        // Keep chatbot/api.php - handled by _redirects rewrite rule
        if (strpos($m[2], 'chatbot/api') !== false) return $m[0];

        // Replace .php with .html
        return $m[1] . '="' . $m[2] . '.html' . ($m[3] ?? '') . '"';
    },
    $html
);

// Output the final HTML
echo $html;
