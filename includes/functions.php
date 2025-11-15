<?php
// includes/functions.php

/**
 * Çeviri fonksiyonu
 * Kullanım: t('welcome_message')
 */
function t($key, $lang = null) {
    $lang = $lang ?? $_SESSION['lang'] ?? DEFAULT_LANG;

    static $cache = [];
    if (!isset($cache[$lang])) {
        $file = __DIR__ . "/../data/translations/{$lang}.json";
        if (!file_exists($file)) {
            $cache[$lang] = [];
        } else {
            $decoded = json_decode(file_get_contents($file), true);
            $cache[$lang] = is_array($decoded) ? $decoded : [];
        }
    }

    return $cache[$lang][$key] ?? $key;
}

/**
 * Aktif sayfa kontrolü (menü highlight için)
 */
function is_active_page($page) {
    $current = $_GET['page'] ?? 'home';
    return $current === $page ? 'active' : '';
}

/**
 * Güvenli HTML çıktısı
 */
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * URL oluştur
 */
function url($path = '', $lang = null) {
    $current_lang = $_SESSION['lang'] ?? DEFAULT_LANG;
    $explicit_lang = func_num_args() >= 2 && $lang !== null;
    $lang = $lang ?? $current_lang;
    
    // Base URL'i hazırla
    $base = rtrim(SITE_URL, '/');
    
    // Path'i temizle ve ekle
    if ($path !== '') {
        $path = ltrim($path, '/');
        if (USE_PRETTY_URLS) {
            $base .= '/' . $path;
        }
    }
    
    if (!USE_PRETTY_URLS) {
        $query = [];
        if ($path === '' || $path === 'home') {
            $query['page'] = 'home';
        } elseif (strpos($path, 'dienstleistungen/') === 0) {
            $query['page'] = 'dienstleistung-detail';
            $query['slug'] = substr($path, strlen('dienstleistungen/'));
        } elseif ($path !== '') {
            $query['page'] = $path;
        }
        
        $base .= '/index.php';
        if (!empty($query)) {
            $base .= '?' . http_build_query($query);
        }
    }
    
    // Dil parametresini ekle
    $should_force_param = $explicit_lang && $current_lang !== $lang;
    if ($lang !== DEFAULT_LANG || $should_force_param) {
        // URL'de zaten query string var mı kontrol et
        $separator = strpos($base, '?') !== false ? '&' : '?';
        $base .= $separator . 'lang=' . urlencode($lang);
    }
    
    return $base;
}

/**
 * Asset URL
 */
function asset($path) {
    return SITE_URL . '/assets/' . ltrim($path, '/');
}

/**
 * Hizmetleri yükle
 */
function get_services() {
    $file = __DIR__ . '/../data/services.json';
    if (!file_exists($file)) {
        return [];
    }
    return json_decode(file_get_contents($file), true)['services'] ?? [];
}

/**
 * Tek hizmet detayı (slug ile)
 */
function get_service_by_slug($slug) {
    $services = get_services();
    foreach ($services as $service) {
        if ($service['slug'] === $slug) {
            return $service;
        }
    }
    return null;
}

/**
 * Şirket bilgilerini yükle
 */
function get_company_info() {
    $file = __DIR__ . '/../data/company.json';
    if (!file_exists($file)) {
        return null;
    }
    return json_decode(file_get_contents($file), true);
}

/**
 * Form validasyon
 */
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validate_phone($phone) {
    // Basit validasyon, gerekirse düzenle
    return preg_match('/^[0-9+\-\s()]+$/', $phone);
}

/**
 * XSS temizleme
 */
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Meta tags oluştur
 */
function generate_meta_tags($title = '', $description = '', $keywords = '', $image = '') {
    $title = $title ?: SITE_NAME;
    $description = $description ?: SITE_DESCRIPTION;
    $image = $image ?: asset('images/logo.jpg');
    
    // Mevcut sayfa URL'sini oluştur
    $current_page = $_GET['page'] ?? 'home';
    $current_slug = $_GET['slug'] ?? null;
    
    if ($current_page === 'home') {
        $current_path = '';
    } elseif ($current_page === 'dienstleistung-detail' && $current_slug) {
        $current_path = 'dienstleistungen/' . $current_slug;
    } else {
        $current_path = $current_page;
    }
    
    $url = url($current_path);
    
    $meta = "
    <title>" . e($title) . "</title>
    <meta name='description' content='" . e($description) . "'>
    <meta name='keywords' content='" . e($keywords) . "'>
    
    <!-- Open Graph -->
    <meta property='og:title' content='" . e($title) . "'>
    <meta property='og:description' content='" . e($description) . "'>
    <meta property='og:image' content='" . e($image) . "'>
    <meta property='og:url' content='" . e($url) . "'>
    <meta property='og:type' content='website'>
    
    <!-- Twitter Card -->
    <meta name='twitter:card' content='summary_large_image'>
    <meta name='twitter:title' content='" . e($title) . "'>
    <meta name='twitter:description' content='" . e($description) . "'>
    <meta name='twitter:image' content='" . e($image) . "'>
    ";
    
    return $meta;
}

/**
 * Breadcrumb oluştur
 */
function get_breadcrumb() {
    $page = $_GET['page'] ?? 'home';
    $breadcrumb = [
        ['title' => t('home'), 'url' => url()]
    ];
    
    if ($page !== 'home') {
        $breadcrumb[] = ['title' => t($page), 'url' => url($page)];
    }
    
    return $breadcrumb;
}

/**
 * JSON-LD Schema oluştur
 */
function generate_schema_org($type = 'Organization') {
    $company = get_company_info();
    
    if ($type === 'Organization') {
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "Organization",
            "name" => SITE_NAME,
            "url" => SITE_URL,
            "logo" => asset('images/logo.jpg'),
            "description" => SITE_DESCRIPTION,
            "address" => [
                "@type" => "PostalAddress",
                "streetAddress" => CONTACT_ADDRESS['street'],
                "addressLocality" => CONTACT_ADDRESS['city'],
                "postalCode" => CONTACT_ADDRESS['postal'],
                "addressCountry" => "DE"
            ],
            "contactPoint" => [
                "@type" => "ContactPoint",
                "telephone" => CONTACT_PHONE,
                "contactType" => "customer service",
                "email" => CONTACT_EMAIL
            ]
        ];
        
        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }
    
    return '';
}
