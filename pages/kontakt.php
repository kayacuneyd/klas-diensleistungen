<?php
// pages/kontakt.php - Contact page with form handling

$form_success = false;
$form_error = '';
$form_data = [
    'name' => '',
    'email' => '',
    'phone' => '',
    'subject' => '',
    'message' => ''
];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and clean form data
    $form_data['name'] = clean_input($_POST['name'] ?? '');
    $form_data['email'] = clean_input($_POST['email'] ?? '');
    $form_data['phone'] = clean_input($_POST['phone'] ?? '');
    $form_data['subject'] = clean_input($_POST['subject'] ?? '');
    $form_data['message'] = clean_input($_POST['message'] ?? '');
    $privacy_agree = isset($_POST['privacy_agree']) && $_POST['privacy_agree'] === '1';
    
    // Validation
    $errors = [];
    
    if (empty($form_data['name'])) {
        $errors[] = t('name_required') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Name ist erforderlich' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Name is required' : 'İsim gereklidir'));
    }
    
    if (empty($form_data['email']) || !validate_email($form_data['email'])) {
        $errors[] = t('email_required') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Gültige E-Mail ist erforderlich' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Valid email is required' : 'Geçerli e-posta gereklidir'));
    }
    
    if (!empty($form_data['phone']) && !validate_phone($form_data['phone'])) {
        $errors[] = t('phone_invalid') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Ungültige Telefonnummer' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Invalid phone number' : 'Geçersiz telefon numarası'));
    }
    
    if (empty($form_data['message'])) {
        $errors[] = t('message_required') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Nachricht ist erforderlich' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Message is required' : 'Mesaj gereklidir'));
    }
    
    if (!$privacy_agree) {
        $errors[] = t('privacy_required') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Sie müssen der Datenschutzerklärung zustimmen' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'You must agree to the privacy policy' : 'Gizlilik politikasını kabul etmelisiniz'));
    }
    
    // If no errors, send email
    if (empty($errors)) {
        $to = CONTACT_EMAIL;
        $subject = 'Kontaktanfrage: ' . ($form_data['subject'] ?: 'Allgemeine Anfrage');
        $message = "Neue Kontaktanfrage von der Website:\n\n";
        $message .= "Name: " . $form_data['name'] . "\n";
        $message .= "Email: " . $form_data['email'] . "\n";
        $message .= "Telefon: " . ($form_data['phone'] ?: 'Nicht angegeben') . "\n";
        $message .= "Betreff: " . ($form_data['subject'] ?: 'Allgemeine Anfrage') . "\n\n";
        $message .= "Nachricht:\n" . $form_data['message'] . "\n";
        
        $headers = "From: " . $form_data['email'] . "\r\n";
        $headers .= "Reply-To: " . $form_data['email'] . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        if (mail($to, $subject, $message, $headers)) {
            $form_success = true;
            // Reset form data
            $form_data = [
                'name' => '',
                'email' => '',
                'phone' => '',
                'subject' => '',
                'message' => ''
            ];
        } else {
            $form_error = t('form_error');
        }
    } else {
        $form_error = implode('<br>', $errors);
    }
}
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4"><?php echo t('kontakt'); ?></h1>
        <p class="text-xl text-blue-100"><?php echo t('contact_us_for_info') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Kontaktieren Sie uns für weitere Informationen' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'Contact us for more information' : 'Daha fazla bilgi için bizimle iletişime geçin')); ?></p>
    </div>
</section>

<!-- Contact Form & Info -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
            <!-- Contact Form -->
            <div>
                <h2 class="text-3xl font-bold text-blue-900 mb-6"><?php echo t('contact_form_title'); ?></h2>
                
                <?php if ($form_success): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    <?php echo t('form_success'); ?>
                </div>
                <?php endif; ?>
                
                <?php if ($form_error): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <?php echo $form_error; ?>
                </div>
                <?php endif; ?>
                
                <form method="POST" action="" class="space-y-6">
                    <div>
                        <label for="name" class="block text-gray-700 font-semibold mb-2"><?php echo t('your_name'); ?> <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="<?php echo e($form_data['name']); ?>" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-gray-700 font-semibold mb-2"><?php echo t('your_email'); ?> <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" value="<?php echo e($form_data['email']); ?>" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-gray-700 font-semibold mb-2"><?php echo t('your_phone'); ?></label>
                        <input type="tel" id="phone" name="phone" value="<?php echo e($form_data['phone']); ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label for="subject" class="block text-gray-700 font-semibold mb-2"><?php echo t('subject'); ?></label>
                        <input type="text" id="subject" name="subject" value="<?php echo e($form_data['subject']); ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label for="message" class="block text-gray-700 font-semibold mb-2"><?php echo t('your_message'); ?> <span class="text-red-500">*</span></label>
                        <textarea id="message" name="message" rows="6" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"><?php echo e($form_data['message']); ?></textarea>
                    </div>
                    
                    <div>
                        <label class="flex items-start">
                            <input type="checkbox" name="privacy_agree" value="1" required
                                   class="mt-1 mr-2">
                            <span class="text-gray-700 text-sm">
                                <?php echo t('privacy_agree'); ?> 
                                <a href="<?php echo url('datenschutz'); ?>" class="text-blue-600 hover:underline" target="_blank">
                                    <?php echo t('read_privacy') ?: (($_SESSION['lang'] ?? DEFAULT_LANG) === 'de' ? 'Datenschutzerklärung lesen' : (($_SESSION['lang'] ?? DEFAULT_LANG) === 'en' ? 'read privacy policy' : 'gizlilik politikasını oku')); ?>
                                </a>
                            </span>
                        </label>
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                        <?php echo t('send_message'); ?>
                    </button>
                </form>
            </div>
            
            <!-- Contact Information -->
            <div>
                <h2 class="text-3xl font-bold text-blue-900 mb-6"><?php echo t('contact_info'); ?></h2>
                
                <div class="space-y-6 mb-8">
                    <div class="flex items-start">
                        <div class="bg-blue-100 p-3 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1"><?php echo t('phone'); ?></h3>
                            <a href="tel:<?php echo e(CONTACT_PHONE); ?>" class="text-blue-600 hover:underline">
                                <?php echo e(CONTACT_PHONE); ?>
                            </a>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-blue-100 p-3 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1"><?php echo t('email'); ?></h3>
                            <a href="mailto:<?php echo e(CONTACT_EMAIL); ?>" class="text-blue-600 hover:underline">
                                <?php echo e(CONTACT_EMAIL); ?>
                            </a>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-blue-100 p-3 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1"><?php echo t('address'); ?></h3>
                            <p class="text-gray-700">
                                <?php echo e(CONTACT_ADDRESS['street']); ?><br>
                                <?php echo e(CONTACT_ADDRESS['postal']); ?> <?php echo e(CONTACT_ADDRESS['city']); ?><br>
                                <?php echo e(CONTACT_ADDRESS['country']); ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-blue-50 p-6 rounded-lg">
                    <h3 class="font-semibold text-blue-900 mb-2"><?php echo t('business_hours', 'Business Hours", "Çalışma Saatleri'); ?></h3>
                    <p class="text-gray-700">
                        <?php echo t('monday_friday', 'Monday - Friday: 8:00 - 17:00", "Pazartesi - Cuma: 08:00 - 17:00'); ?><br>
                        <?php echo t('saturday_sunday', 'Saturday - Sunday: Closed", "Cumartesi - Pazar: Kapalı'); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

