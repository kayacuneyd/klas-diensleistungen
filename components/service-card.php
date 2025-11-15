<?php
// components/service-card.php
// Usage: include with $service variable set

if (!isset($service)) {
    return;
}

$lang = $_SESSION['lang'] ?? DEFAULT_LANG;
$title = $service['title'][$lang] ?? $service['title'][DEFAULT_LANG];
$description = $service['short_description'][$lang] ?? $service['short_description'][DEFAULT_LANG];
$image_file = $service['image'] ?? 'default.jpg';
$image_path = __DIR__ . '/../assets/images/services/' . $image_file;
$background = file_exists($image_path)
    ? asset('images/services/' . $image_file)
    : asset('images/factory.jpg');
$slug = $service['slug'];
?>

<div class="service-card" style="--card-bg: url('<?php echo e($background); ?>');">
    <div class="service-card-content p-6 md:p-8 space-y-4">
        <span class="text-xs uppercase tracking-[0.2em] text-blue-100"><?php echo t('dienstleistungen'); ?></span>
        <h3 class="text-2xl md:text-3xl font-bold"><?php echo e($title); ?></h3>
        <p class="text-blue-100 leading-relaxed"><?php echo e($description); ?></p>
        <div>
            <a href="<?php echo url('dienstleistungen/' . $slug); ?>" class="inline-flex items-center gap-2 bg-white/90 text-blue-900 font-semibold py-2.5 px-5 rounded-full hover:bg-white transition">
                <?php echo t('learn_more'); ?>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
