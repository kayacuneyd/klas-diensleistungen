<?php
// pages/unternehmen.php

$lang = $_SESSION['lang'] ?? DEFAULT_LANG;
$company = get_company_info();

if (!$company) {
    // Fallback if company data not found
    header('Location: ' . url());
    exit;
}
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4"><?php echo t('unternehmen'); ?></h1>
        <p class="text-xl text-blue-100"><?php echo e($company['tagline'][$lang] ?? $company['tagline'][DEFAULT_LANG]); ?></p>
    </div>
</section>

<!-- About Us -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div>
                <h2 class="text-3xl font-bold text-blue-900 mb-6"><?php echo e($company['name']); ?></h2>
                <p class="text-lg text-gray-700 mb-8 leading-relaxed">
                    <?php echo e($company['about'][$lang] ?? $company['about'][DEFAULT_LANG]); ?>
                </p>
                
                <?php if (isset($company['mission'])): ?>
                <div class="bg-blue-50 p-6 rounded-lg">
                    <h3 class="text-2xl font-bold text-blue-900 mb-3"><?php echo t('mission') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Mission' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Mission' : 'Misyon')); ?></h3>
                    <p class="text-gray-700"><?php echo e($company['mission'][$lang] ?? $company['mission'][DEFAULT_LANG]); ?></p>
                </div>
                <?php endif; ?>
            </div>
            <div class="space-y-4">
                <div class="rounded-2xl overflow-hidden shadow-2xl relative">
                    <img src="<?php echo asset('images/team.jpg'); ?>" alt="<?php echo e($company['name']); ?>" class="w-full h-80 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 via-blue-900/10 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                        <p class="text-sm uppercase tracking-widest text-blue-200"><?php echo t('unternehmen'); ?></p>
                        <p class="text-lg font-semibold"><?php echo t('company_gallery_caption'); ?></p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <img src="<?php echo asset('images/factory.jpg'); ?>" alt="<?php echo t('visual_facility_title'); ?>" class="rounded-2xl h-32 object-cover shadow-md">
                    <img src="<?php echo asset('images/logistics.jpg'); ?>" alt="<?php echo t('visual_logistics_title'); ?>" class="rounded-2xl h-32 object-cover shadow-md">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Company Stats -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="bg-white p-8 rounded-lg shadow-md">
                <div class="text-5xl font-bold text-orange-500 mb-2">
                    <?php echo date('Y') - ($company['founded'] ?? 1997); ?>+
                </div>
                <h3 class="text-xl font-semibold text-blue-900"><?php echo t('years_experience'); ?></h3>
                <p class="text-gray-600 mt-2"><?php echo t('since') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Seit' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Since' : 'Beraber')); ?> <?php echo e($company['founded'] ?? 1997); ?></p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-md">
                <div class="text-5xl font-bold text-orange-500 mb-2"><?php echo e($company['area'] ?? '2000+'); ?></div>
                <h3 class="text-xl font-semibold text-blue-900"><?php echo t('production_area'); ?></h3>
                <p class="text-gray-600 mt-2"><?php echo t('production_space') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Produktionsfläche' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Production Space' : 'Üretim Alanı')); ?></p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-md">
                <div class="text-5xl font-bold text-orange-500 mb-2">8</div>
                <h3 class="text-xl font-semibold text-blue-900"><?php echo t('services_offered'); ?></h3>
                <p class="text-gray-600 mt-2"><?php echo t('different_services') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Verschiedene Dienstleistungen' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Different Services' : 'Farklı Hizmet')); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Values -->
<?php if (isset($company['values'])): ?>
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center text-blue-900 mb-12"><?php echo t('our_values') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Unsere Werte' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Our Values' : 'Değerlerimiz')); ?></h2>
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($company['values'][$lang] ?? $company['values'][DEFAULT_LANG] as $value): ?>
                <div class="bg-blue-50 p-6 rounded-lg">
                    <div class="text-orange-500 text-2xl mb-2">✓</div>
                    <p class="text-gray-700 text-lg"><?php echo e($value); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Timeline -->
<?php if (isset($company['timeline'])): ?>
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center text-blue-900 mb-12"><?php echo t('company_history') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Unternehmensgeschichte' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Company History' : 'Şirket Tarihi')); ?></h2>
        <div class="max-w-4xl mx-auto">
            <div class="space-y-8">
                <?php foreach ($company['timeline'] as $item): ?>
                <div class="flex items-start">
                    <div class="bg-orange-500 text-white rounded-full w-16 h-16 flex items-center justify-center font-bold text-xl mr-6 flex-shrink-0">
                        <?php echo e($item['year']); ?>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md flex-1">
                        <p class="text-gray-700 text-lg"><?php echo e($item['event'][$lang] ?? $item['event'][DEFAULT_LANG]); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<?php include __DIR__ . '/../components/cta-section.php'; ?>
