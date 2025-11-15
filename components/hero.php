<?php
// components/hero.php

$lang = $_SESSION['lang'] ?? DEFAULT_LANG;
$company = get_company_info();
$title = $title ?? t('hero_title');
$subtitle = $subtitle ?? t('hero_subtitle');
?>

<section class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6"><?php echo e($title); ?></h1>
        <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto"><?php echo e($subtitle); ?></p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo url('kontakt'); ?>" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105">
                <?php echo t('cta_contact'); ?>
            </a>
            <a href="<?php echo url('dienstleistungen'); ?>" class="bg-transparent border-2 border-white hover:bg-white hover:text-blue-900 text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                <?php echo t('cta_services'); ?>
            </a>
        </div>
    </div>
</section>

