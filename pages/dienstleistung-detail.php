<?php
// pages/dienstleistung-detail.php

$slug = $_GET['slug'] ?? null;
$lang = $_SESSION['lang'] ?? DEFAULT_LANG;

if (!$slug) {
    header('Location: ' . url('dienstleistungen'));
    exit;
}

$service = get_service_by_slug($slug);

if (!$service) {
    header('Location: ' . url('dienstleistungen'));
    exit;
}

$title = $service['title'][$lang] ?? $service['title'][DEFAULT_LANG];
$full_description = $service['full_description'][$lang] ?? $service['full_description'][DEFAULT_LANG];
$benefits = $service['benefits'][$lang] ?? $service['benefits'][DEFAULT_LANG];
$industries = $service['industries'][$lang] ?? $service['industries'][DEFAULT_LANG];
$process_steps = $service['process_steps'][$lang] ?? $service['process_steps'][DEFAULT_LANG];
$icon = $service['icon'] ?? '📦';
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="text-6xl mb-4"><?php echo e($icon); ?></div>
        <h1 class="text-4xl md:text-5xl font-bold mb-4"><?php echo e($title); ?></h1>
        <p class="text-xl text-blue-100"><?php echo e($service['short_description'][$lang] ?? $service['short_description'][DEFAULT_LANG]); ?></p>
    </div>
</section>

<!-- Breadcrumb -->
<nav class="bg-gray-100 py-4">
    <div class="container mx-auto px-4">
        <div class="flex items-center space-x-2 text-sm">
            <a href="<?php echo url(); ?>" class="text-blue-600 hover:text-blue-800"><?php echo t('home'); ?></a>
            <span class="text-gray-400">/</span>
            <a href="<?php echo url('dienstleistungen'); ?>" class="text-blue-600 hover:text-blue-800"><?php echo t('dienstleistungen'); ?></a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-600"><?php echo e($title); ?></span>
        </div>
    </div>
</nav>

<!-- Full Description -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="prose prose-lg max-w-none">
                <p class="text-lg text-gray-700 leading-relaxed mb-8"><?php echo nl2br(e($full_description)); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Benefits -->
<?php if (!empty($benefits)): ?>
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-blue-900 mb-12"><?php echo t('benefits'); ?></h2>
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($benefits as $benefit): ?>
                <div class="bg-white p-6 rounded-lg shadow-md flex items-start">
                    <div class="text-orange-500 text-2xl mr-4">✓</div>
                    <p class="text-gray-700 text-lg"><?php echo e($benefit); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Industries -->
<?php if (!empty($industries)): ?>
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-blue-900 mb-12"><?php echo t('industries'); ?></h2>
        <div class="max-w-4xl mx-auto">
            <div class="flex flex-wrap justify-center gap-4">
                <?php foreach ($industries as $industry): ?>
                <span class="bg-blue-100 text-blue-900 px-6 py-3 rounded-full font-semibold"><?php echo e($industry); ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Process Steps -->
<?php if (!empty($process_steps)): ?>
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-blue-900 mb-12"><?php echo t('process'); ?></h2>
        <div class="max-w-4xl mx-auto">
            <div class="space-y-6">
                <?php foreach ($process_steps as $index => $step): ?>
                <div class="flex items-start">
                    <div class="bg-orange-500 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold mr-6 flex-shrink-0">
                        <?php echo $index + 1; ?>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md flex-1">
                        <p class="text-gray-700 text-lg"><?php echo e($step); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="py-16 bg-orange-500 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4"><?php echo t('get_quote'); ?></h2>
        <p class="text-xl mb-8"><?php echo t('contact_us_for_more') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Kontaktieren Sie uns für weitere Informationen zu dieser Dienstleistung' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Contact us for more information about this service' : 'Bu hizmet hakkında daha fazla bilgi için bizimle iletişime geçin')); ?></p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo url('kontakt'); ?>" class="bg-white text-orange-500 hover:bg-blue-900 hover:text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                <?php echo t('cta_contact'); ?>
            </a>
            <a href="tel:<?php echo e(CONTACT_PHONE); ?>" class="bg-transparent border-2 border-white hover:bg-white hover:text-orange-500 font-semibold py-3 px-8 rounded-lg transition duration-300">
                <?php echo t('call_us'); ?>
            </a>
        </div>
    </div>
</section>

<!-- Related Services -->
<?php
$all_services = get_services();
$related_services = array_filter($all_services, function($s) use ($service) {
    return $s['id'] !== $service['id'];
});
$related_services = array_slice($related_services, 0, 4);
?>

<?php if (!empty($related_services)): ?>
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-blue-900 mb-12"><?php echo t('related_services'); ?></h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($related_services as $related_service): ?>
                <?php $service = $related_service; ?>
                <?php include __DIR__ . '/../components/service-card.php'; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

