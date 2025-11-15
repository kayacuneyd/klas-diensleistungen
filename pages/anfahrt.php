<?php
// pages/anfahrt.php - Location/Map page
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4"><?php echo t('anfahrt'); ?></h1>
        <p class="text-xl text-blue-100"><?php echo t('find_us') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Finden Sie uns' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Find us' : 'Bizi bulun')); ?></p>
    </div>
</section>

<!-- Address & Map -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
            <!-- Address Information -->
            <div>
                <h2 class="text-3xl font-bold text-blue-900 mb-6"><?php echo t('address'); ?></h2>
                
                <div class="space-y-6 mb-8">
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2"><?php echo e(SITE_NAME); ?></h3>
                        <p class="text-gray-700">
                            <?php echo e(CONTACT_ADDRESS['street']); ?><br>
                            <?php echo e(CONTACT_ADDRESS['postal']); ?> <?php echo e(CONTACT_ADDRESS['city']); ?><br>
                            <?php echo e(CONTACT_ADDRESS['country']); ?>
                        </p>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2"><?php echo t('contact_info'); ?></h3>
                        <p class="text-gray-700">
                            <strong><?php echo t('phone'); ?>:</strong> 
                            <a href="tel:<?php echo e(CONTACT_PHONE); ?>" class="text-blue-600 hover:underline">
                                <?php echo e(CONTACT_PHONE); ?>
                            </a><br>
                            <strong><?php echo t('email'); ?>:</strong> 
                            <a href="mailto:<?php echo e(CONTACT_EMAIL); ?>" class="text-blue-600 hover:underline">
                                <?php echo e(CONTACT_EMAIL); ?>
                            </a>
                        </p>
                    </div>
                    
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <h3 class="font-semibold text-blue-900 mb-2"><?php echo t('business_hours') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Öffnungszeiten' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Business Hours' : 'Çalışma Saatleri')); ?></h3>
                        <p class="text-gray-700">
                            <?php echo t('monday_friday') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Montag - Freitag: 8:00 - 17:00' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Monday - Friday: 8:00 - 17:00' : 'Pazartesi - Cuma: 08:00 - 17:00')); ?><br>
                            <?php echo t('saturday_sunday') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Samstag - Sonntag: Geschlossen' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Saturday - Sunday: Closed' : 'Cumartesi - Pazar: Kapalı')); ?>
                        </p>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-semibold text-gray-900 mb-4"><?php echo t('directions') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Anfahrt' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Directions' : 'Yön tarifi')); ?></h3>
                    <p class="text-gray-700 mb-4">
                        <?php 
                        $directions_text = (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de') 
                            ? 'Sie erreichen uns einfach mit dem Auto oder öffentlichen Verkehrsmitteln. Kostenfreie Parkplätze stehen vor Ort zur Verfügung.'
                            : ((($_SESSION['lang'] ?? DEFAULT_LANG) === 'en')
                                ? 'You can reach us easily by car or public transport. Free parking is available on site.'
                                : 'Arabayla veya toplu taşımayla kolayca bize ulaşabilirsiniz. Sahada ücretsiz otopark mevcuttur.');
                        echo e($directions_text);
                        ?>
                    </p>
                    <a href="https://maps.google.com/?q=<?php echo urlencode(CONTACT_ADDRESS['street'] . ', ' . CONTACT_ADDRESS['postal'] . ' ' . CONTACT_ADDRESS['city']); ?>" 
                       target="_blank"
                       class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                        <?php echo t('open_in_google_maps') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'In Google Maps öffnen' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Open in Google Maps' : 'Google Maps\'te aç')); ?>
                    </a>
                </div>
            </div>
            
            <!-- Map Placeholder -->
            <div>
                <div class="bg-gray-200 rounded-lg h-full min-h-[500px] flex items-center justify-center">
                    <div class="text-center text-gray-500">
                        <svg class="w-24 h-24 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <p class="text-lg font-semibold"><?php echo t('map_placeholder') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Interaktive Karte' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Interactive Map' : 'İnteraktif Harita')); ?></p>
                        <p class="text-sm mt-2"><?php echo t('map_note') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Google Maps Integration kann hier hinzugefügt werden' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Google Maps integration can be added here' : 'Google Maps entegrasyonu buraya eklenebilir')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

