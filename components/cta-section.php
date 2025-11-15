<?php
// components/cta-section.php
// Call-to-action section component

$title = $title ?? t('cta_contact');
$subtitle = $subtitle ?? '';
$button_text = $button_text ?? t('cta_contact');
$button_link = $button_link ?? url('kontakt');
?>

<section class="bg-orange-500 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <?php if ($title): ?>
        <h2 class="text-3xl md:text-4xl font-bold mb-4"><?php echo e($title); ?></h2>
        <?php endif; ?>
        <?php if ($subtitle): ?>
        <p class="text-xl mb-8 max-w-2xl mx-auto"><?php echo e($subtitle); ?></p>
        <?php endif; ?>
        <a href="<?php echo e($button_link); ?>" class="inline-block bg-white text-orange-500 hover:bg-blue-900 hover:text-white font-semibold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105">
            <?php echo e($button_text); ?>
        </a>
    </div>
</section>

