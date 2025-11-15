<!-- Footer -->
<footer class="bg-blue-900 text-white mt-16">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Company Info -->
            <div>
                <h3 class="text-xl font-bold mb-4 text-orange-400"><?php echo e(SITE_NAME); ?></h3>
                <p class="text-gray-300 mb-4"><?php echo t('footer_text'); ?></p>
                <p class="text-sm text-gray-400">
                    <?php echo e(CONTACT_ADDRESS['street']); ?><br>
                    <?php echo e(CONTACT_ADDRESS['postal']); ?> <?php echo e(CONTACT_ADDRESS['city']); ?><br>
                    <?php echo e(CONTACT_ADDRESS['country']); ?>
                </p>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="text-xl font-bold mb-4 text-orange-400"><?php echo t('quick_links') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Schnellzugriff' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Quick Links' : 'Hızlı Bağlantılar')); ?></h3>
                <ul class="space-y-2">
                    <li><a href="<?php echo url(); ?>" class="hover:text-orange-400 transition"><?php echo t('home'); ?></a></li>
                    <li><a href="<?php echo url('unternehmen'); ?>" class="hover:text-orange-400 transition"><?php echo t('unternehmen'); ?></a></li>
                    <li><a href="<?php echo url('dienstleistungen'); ?>" class="hover:text-orange-400 transition"><?php echo t('dienstleistungen'); ?></a></li>
                    <li><a href="<?php echo url('kontakt'); ?>" class="hover:text-orange-400 transition"><?php echo t('kontakt'); ?></a></li>
                </ul>
            </div>
            
            <!-- Contact -->
            <div>
                <h3 class="text-xl font-bold mb-4 text-orange-400"><?php echo t('contact_info'); ?></h3>
                <ul class="space-y-2 text-gray-300">
                    <li>
                        <strong><?php echo t('phone'); ?>:</strong><br>
                        <a href="tel:<?php echo e(CONTACT_PHONE); ?>" class="hover:text-orange-400"><?php echo e(CONTACT_PHONE); ?></a>
                    </li>
                    <li>
                        <strong><?php echo t('email'); ?>:</strong><br>
                        <a href="mailto:<?php echo e(CONTACT_EMAIL); ?>" class="hover:text-orange-400"><?php echo e(CONTACT_EMAIL); ?></a>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Bottom Bar -->
        <div class="border-t border-blue-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center text-center md:text-left">
            <div class="text-gray-400 text-sm mb-4 md:mb-0 space-y-1">
                <p>&copy; <?php echo date('Y'); ?> <?php echo e(SITE_NAME); ?>. <?php echo t('all_rights_reserved'); ?></p>
                <?php
                $credit_link = '<a href="https://kayacuneyt.com" target="_blank" rel="noopener" class="text-orange-400 hover:text-orange-300 font-semibold">Cüneyt Kaya</a>';
                $signature_template = t('footer_signature');
                $signature_line = strpos($signature_template, '%s') !== false
                    ? sprintf($signature_template, $credit_link)
                    : $signature_template . ' ' . $credit_link;
                ?>
                <p><?php echo $signature_line; ?></p>
            </div>
            <div class="flex space-x-4 text-sm">
                <a href="<?php echo url('impressum'); ?>" class="hover:text-orange-400 transition"><?php echo t('impressum'); ?></a>
                <span class="text-gray-600">|</span>
                <a href="<?php echo url('datenschutz'); ?>" class="hover:text-orange-400 transition"><?php echo t('datenschutz'); ?></a>
            </div>
        </div>
    </div>
</footer>

<!-- Custom JavaScript -->
<script src="<?php echo asset('js/main.js'); ?>"></script>
</div> <!-- End #app -->
</body>
</html>
