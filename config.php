<?php
// config.php

// Hata raporlama (development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Site temel ayarları - SITE_URL'i otomatik tespit et
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$script_path = dirname($_SERVER['SCRIPT_NAME'] ?? '');
// Script path'i temizle ve normalize et
if ($script_path === '/' || $script_path === '\\') {
    $script_path = '';
} else {
    $script_path = rtrim($script_path, '/');
}
define('SITE_URL', $protocol . '://' . $host . $script_path);
define('SITE_NAME', 'K.L.A.S. Dienstleistungs GmbH');
define('SITE_DESCRIPTION', 'Professionelle Dienstleistungen seit 1997');
define('DEFAULT_LANG', 'de');

// SEO URL'leri kullanma kontrolü (varsayılan: açık)
$env_pretty = getenv('USE_PRETTY_URLS');
if ($env_pretty === false) {
    define('USE_PRETTY_URLS', true);
} else {
    $parsed_pretty = filter_var($env_pretty, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    define('USE_PRETTY_URLS', $parsed_pretty ?? true);
}

// Sayfa tanımları
define('PAGES', [
    'home' => ['de' => 'Startseite', 'en' => 'Home', 'tr' => 'Ana Sayfa'],
    'unternehmen' => ['de' => 'Unternehmen', 'en' => 'Company', 'tr' => 'Şirket'],
    'dienstleistungen' => ['de' => 'Dienstleistungen', 'en' => 'Services', 'tr' => 'Hizmetler'],
    'kontakt' => ['de' => 'Kontakt', 'en' => 'Contact', 'tr' => 'İletişim'],
    'anfahrt' => ['de' => 'Anfahrt', 'en' => 'Location', 'tr' => 'Konum'],
]);

// İletişim bilgileri
define('CONTACT_EMAIL', 'info@klas-dienstleistung.de');
define('CONTACT_PHONE', '+49 XXX XXXXXXX');
define('CONTACT_ADDRESS', [
    'street' => 'Straße XX',
    'city' => 'Stadt',
    'postal' => 'PLZ',
    'country' => 'Deutschland'
]);

// reCAPTCHA keys (şimdilik boş)
define('RECAPTCHA_SITE_KEY', '');
define('RECAPTCHA_SECRET_KEY', '');

// Session başlat
session_start();

// Varsayılan dil ayarla
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = DEFAULT_LANG;
}

// Dil değiştirme
if (isset($_GET['lang']) && in_array($_GET['lang'], ['de', 'en', 'tr'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Pretty URL'leri çözümle (mod_rewrite olmayan ortamlarda)
if (USE_PRETTY_URLS && empty($_GET['page'])) {
    $request_uri = $_SERVER['REQUEST_URI'] ?? '/';
    $path = parse_url($request_uri, PHP_URL_PATH);
    $path = trim($path, '/');
    
    $base_path = trim($script_path, '/');
    if ($base_path !== '' && strpos($path, $base_path) === 0) {
        $path = trim(substr($path, strlen($base_path)), '/');
    }
    
    if ($path === '' || $path === 'index.php') {
        $_GET['page'] = 'home';
    } else {
        $static_pages = [
            'unternehmen',
            'dienstleistungen',
            'kontakt',
            'anfahrt',
            'impressum',
            'datenschutz'
        ];
        
        if (in_array($path, $static_pages, true)) {
            $_GET['page'] = $path;
        } elseif (preg_match('#^dienstleistungen/([a-z0-9-]+)/?$#i', $path, $matches)) {
            $_GET['page'] = 'dienstleistung-detail';
            $_GET['slug'] = $matches[1];
        } else {
            $_GET['page'] = 'home';
        }
    }
}
