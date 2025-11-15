<?php
// pages/datenschutz.php - Privacy Policy page
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4"><?php echo t('datenschutz'); ?></h1>
    </div>
</section>

<!-- Privacy Policy Content -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto prose prose-lg">
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-blue-900 mb-6"><?php echo t('privacy_policy'); ?></h2>
                
                <div class="space-y-6 text-gray-700">
                    <div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-2"><?php echo t('data_collection'); ?></h3>
                        <p>
                            <?php echo t('data_collection_text'); ?>
                        </p>
                    </div>
                    
                    <div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-2"><?php echo t('contact_form_data'); ?></h3>
                        <p>
                            <?php echo t('contact_form_data_text'); ?>
                        </p>
                    </div>
                    
                    <div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-2"><?php echo t('cookies'); ?></h3>
                        <p>
                            <?php echo t('cookies_text'); ?>
                        </p>
                    </div>
                    
                    <div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-2"><?php echo t('data_security'); ?></h3>
                        <p>
                            <?php echo t('data_security_text'); ?>
                        </p>
                    </div>
                    
                    <div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-2"><?php echo t('your_rights'); ?></h3>
                        <p>
                            <?php echo t('your_rights_text'); ?>
                        </p>
                    </div>
                    
                    <div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-2"><?php echo t('contact_data_protection'); ?></h3>
                        <p>
                            <?php echo t('contact_data_protection_text'); ?><br>
                            <strong><?php echo e(SITE_NAME); ?></strong><br>
                            <?php echo e(CONTACT_ADDRESS['street']); ?><br>
                            <?php echo e(CONTACT_ADDRESS['postal']); ?> <?php echo e(CONTACT_ADDRESS['city']); ?><br>
                            <?php echo t('email'); ?>: <a href="mailto:<?php echo e(CONTACT_EMAIL); ?>" class="text-blue-600 hover:underline"><?php echo e(CONTACT_EMAIL); ?></a>
                        </p>
                    </div>
                </div>
                
                <div class="mt-8 p-4 bg-blue-50 rounded-lg">
                    <p class="text-sm text-gray-700">
                        <strong><?php echo t('last_updated'); ?></strong> 
                        <?php echo date('d.m.Y'); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
