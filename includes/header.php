<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? DEFAULT_LANG; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <?php
    // Generate meta tags based on current page
    $current_page = $_GET['page'] ?? 'home';
    $page_title = SITE_NAME;
    $page_description = SITE_DESCRIPTION;
    
    // Customize meta for specific pages
    if ($current_page === 'dienstleistung-detail' && isset($_GET['slug'])) {
        $service = get_service_by_slug($_GET['slug']);
        if ($service) {
            $lang = $_SESSION['lang'] ?? DEFAULT_LANG;
            $page_title = $service['title'][$lang] . ' - ' . SITE_NAME;
            $page_description = $service['short_description'][$lang];
        }
    } elseif ($current_page !== 'home') {
        $page_title = t($current_page) . ' - ' . SITE_NAME;
    }
    
    echo generate_meta_tags($page_title, $page_description);
    ?>
    
    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo asset('css/custom.css'); ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="<?php echo asset('images/logo.jpg'); ?>">
    
    <!-- Schema.org JSON-LD -->
    <?php echo generate_schema_org('Organization'); ?>
</head>
<body class="bg-gray-50 text-gray-900">
    <div id="app" x-data="{ mobileMenuOpen: false }">

