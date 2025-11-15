<?php
// index.php - Main Router

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/functions.php';

// Get page from URL
$page = $_GET['page'] ?? 'home';
$slug = $_GET['slug'] ?? null;

// Valid pages
$valid_pages = [
    'home',
    'unternehmen',
    'dienstleistungen',
    'dienstleistung-detail',
    'kontakt',
    'anfahrt',
    'impressum',
    'datenschutz'
];

// Validate page
if (!in_array($page, $valid_pages)) {
    $page = 'home';
}

// Special handling for service detail page
if ($page === 'dienstleistung-detail' && !$slug) {
    // Redirect to services page if no slug provided
    header('Location: ' . url('dienstleistungen'));
    exit;
}

// Include header
include __DIR__ . '/includes/header.php';

// Include navigation
include __DIR__ . '/includes/navigation.php';

// Main content area
echo '<main>';

// Load the appropriate page
$page_file = __DIR__ . '/pages/' . $page . '.php';

if (file_exists($page_file)) {
    include $page_file;
} else {
    // Fallback to home if page not found
    include __DIR__ . '/pages/home.php';
}

echo '</main>';

// Include footer
include __DIR__ . '/includes/footer.php';

