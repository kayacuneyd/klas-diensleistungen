<?php
// pages/home.php

$lang = $_SESSION['lang'] ?? DEFAULT_LANG;
$company = get_company_info();
$services = get_services();
$intro_video_url = 'https://klas-dienstleistung.de/wp-content/uploads/2022/10/intro.mp4';
$gallery = [
    [
        'image' => asset('images/factory.jpg'),
        'title' => t('visual_facility_title'),
        'description' => t('visual_facility_text')
    ],
    [
        'image' => asset('images/team.jpg'),
        'title' => t('visual_team_title'),
        'description' => t('visual_team_text')
    ],
    [
        'image' => asset('images/logistics.jpg'),
        'title' => t('visual_logistics_title'),
        'description' => t('visual_logistics_text')
    ],
];
?>

<!-- Hero Section -->
<?php include __DIR__ . '/../components/hero.php'; ?>

<!-- Intro Video -->
<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4">
                    <?php echo t('intro_video_title'); ?>
                </h2>
                <p class="text-gray-700 text-lg leading-relaxed">
                    <?php echo t('intro_video_description'); ?>
                </p>
            </div>
            <div class="rounded-2xl overflow-hidden shadow-xl">
                <video class="w-full h-full" controls preload="none" playsinline poster="<?php echo asset('images/logo.jpg'); ?>">
                    <source src="<?php echo e($intro_video_url); ?>" type="video/mp4">
                    <?php echo t('intro_video_fallback'); ?>
                </video>
            </div>
        </div>
    </div>
</section>

<!-- Visual Gallery -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4"><?php echo t('visual_gallery_title'); ?></h2>
            <p class="text-gray-600"><?php echo t('visual_gallery_description'); ?></p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php foreach ($gallery as $item): ?>
            <figure class="relative overflow-hidden rounded-2xl shadow-lg group">
                <img src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['title']); ?>" class="w-full h-64 object-cover transform group-hover:scale-105 transition duration-500">
                <figcaption class="absolute inset-0 bg-blue-900/80 text-white flex flex-col justify-end p-6 opacity-0 group-hover:opacity-100 transition duration-300">
                    <h3 class="text-xl font-semibold mb-2"><?php echo e($item['title']); ?></h3>
                    <p class="text-sm text-blue-100"><?php echo e($item['description']); ?></p>
                </figcaption>
            </figure>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- About Us Numbers -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center text-blue-900 mb-12"><?php echo t('about_us_numbers'); ?></h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="bg-blue-50 p-8 rounded-lg">
                <div class="text-5xl font-bold text-orange-500 mb-2">
                    <?php 
                    $years = date('Y') - ($company['founded'] ?? 1997);
                    echo $years; 
                    ?>
                    <span class="text-2xl">+</span>
                </div>
                <h3 class="text-xl font-semibold text-blue-900"><?php echo t('years_experience'); ?></h3>
            </div>
            <div class="bg-blue-50 p-8 rounded-lg">
                <div class="text-5xl font-bold text-orange-500 mb-2">2000<span class="text-2xl">+</span></div>
                <h3 class="text-xl font-semibold text-blue-900"><?php echo t('production_area'); ?></h3>
            </div>
            <div class="bg-blue-50 p-8 rounded-lg">
                <div class="text-5xl font-bold text-orange-500 mb-2">8</div>
                <h3 class="text-xl font-semibold text-blue-900"><?php echo t('services_offered'); ?></h3>
            </div>
        </div>
    </div>
</section>

<!-- Services Overview -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center text-blue-900 mb-12"><?php echo t('service_overview'); ?></h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php 
            // Show first 4 services on homepage
            $home_services = array_slice($services, 0, 4);
            foreach ($home_services as $service): 
                include __DIR__ . '/../components/service-card.php';
            endforeach; 
            ?>
        </div>
        <div class="text-center mt-8">
            <a href="<?php echo url('dienstleistungen'); ?>" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                <?php echo t('cta_services'); ?>
            </a>
        </div>
    </div>
</section>

<!-- Why K.L.A.S. -->
<?php if ($company && isset($company['usps'])): ?>
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center text-blue-900 mb-12"><?php echo t('why_klas'); ?></h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($company['usps'][$lang] ?? $company['usps'][DEFAULT_LANG] as $usp): ?>
            <div class="bg-blue-50 p-6 rounded-lg">
                <div class="text-orange-500 text-3xl mb-3">✓</div>
                <p class="text-gray-700"><?php echo e($usp); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<?php include __DIR__ . '/../components/cta-section.php'; ?>
