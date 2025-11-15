<?php
// pages/impressum.php - Legal Notice page
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4"><?php echo t('impressum'); ?></h1>
    </div>
</section>

<!-- Legal Notice Content -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto prose prose-lg">
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-blue-900 mb-6"><?php echo t('legal_notice'); ?></h2>
                
                <div class="space-y-6 text-gray-700">
                    <div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-2"><?php echo t('company_info'); ?></h3>
                        <p>
                            <strong><?php echo e(SITE_NAME); ?></strong><br>
                            <?php echo e(CONTACT_ADDRESS['street']); ?><br>
                            <?php echo e(CONTACT_ADDRESS['postal']); ?> <?php echo e(CONTACT_ADDRESS['city']); ?><br>
                            <?php echo e(CONTACT_ADDRESS['country']); ?>
                        </p>
                    </div>
                    
                    <div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-2"><?php echo t('contact'); ?></h3>
                        <p>
                            <?php echo t('phone'); ?>: <a href="tel:<?php echo e(CONTACT_PHONE); ?>" class="text-blue-600 hover:underline"><?php echo e(CONTACT_PHONE); ?></a><br>
                            <?php echo t('email'); ?>: <a href="mailto:<?php echo e(CONTACT_EMAIL); ?>" class="text-blue-600 hover:underline"><?php echo e(CONTACT_EMAIL); ?></a>
                        </p>
                    </div>
                    
                    <div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-2"><?php echo t('responsible'); ?></h3>
                        <p>
                            <?php echo t('impressum_note'); ?>
                        </p>
                    </div>
                    
                    <div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-2"><?php echo t('liability'); ?></h3>
                        <p>
                            <?php echo t('liability_note'); ?>
                        </p>
                    </div>
                    
                    <div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-2"><?php echo t('copyright'); ?></h3>
                        <p>
                            <?php echo t('copyright_note'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
