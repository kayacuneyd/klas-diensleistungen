<?php
// pages/dienstleistungen.php

$lang = $_SESSION['lang'] ?? DEFAULT_LANG;
$services = get_services();
$intro_points = [
    ['title' => t('service_intro_point_1_title'), 'text' => t('service_intro_point_1_text')],
    ['title' => t('service_intro_point_2_title'), 'text' => t('service_intro_point_2_text')],
    ['title' => t('service_intro_point_3_title'), 'text' => t('service_intro_point_3_text')],
];
$logistics_points = [
    t('service_logistics_point_1'),
    t('service_logistics_point_2'),
    t('service_logistics_point_3'),
];
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4"><?php echo t('dienstleistungen'); ?></h1>
        <p class="text-xl text-blue-100"><?php echo t('service_overview'); ?></p>
    </div>
</section>

<!-- Services Intro -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-orange-500 mb-3"><?php echo t('dienstleistungen'); ?></p>
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-6"><?php echo t('service_intro_title'); ?></h2>
                <p class="text-lg text-gray-700 leading-relaxed"><?php echo t('service_intro_text'); ?></p>
            </div>
            <div class="space-y-4">
                <?php foreach ($intro_points as $point): ?>
                <div class="p-5 bg-gray-50 border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition">
                    <h3 class="text-xl font-semibold text-blue-900 mb-2"><?php echo e($point['title']); ?></h3>
                    <p class="text-gray-600"><?php echo e($point['text']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($services as $service): ?>
                <?php include __DIR__ . '/../components/service-card.php'; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Logistics / Quality Highlight -->
<section class="py-16 bg-blue-900 text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-bold mb-4"><?php echo t('service_logistics_title'); ?></h2>
            <p class="text-blue-100 text-lg"><?php echo t('service_logistics_text'); ?></p>
        </div>
        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php foreach ($logistics_points as $item): ?>
            <div class="bg-white/10 border border-white/20 rounded-2xl p-6 text-left backdrop-blur">
                <div class="text-3xl mb-3">•</div>
                <p class="text-blue-50 text-lg leading-relaxed"><?php echo e($item); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<?php include __DIR__ . '/../components/cta-section.php'; ?>
