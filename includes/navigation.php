<!-- Navigation -->
<header class="bg-white/95 backdrop-blur border-b border-gray-200 shadow-sm sticky top-0 z-50">
    <nav class="container mx-auto px-4 py-4 text-slate-900">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <?php
            $logo_path = __DIR__ . '/../assets/images/logo.jpg';
            $logo_exists = file_exists($logo_path);
            ?>
            <a href="<?php echo url(); ?>" class="flex items-center space-x-2 text-slate-900">
                <?php if ($logo_exists): ?>
                    <img src="<?php echo asset('images/logo.jpg'); ?>" alt="<?php echo e(SITE_NAME); ?>" class="h-12 w-auto rounded-full border border-gray-200">
                <?php else: ?>
                    <span class="text-xl font-bold"><?php echo e(SITE_NAME); ?></span>
                <?php endif; ?>
            </a>
            
            <!-- Desktop Navigation -->
            <ul class="hidden md:flex items-center space-x-6 text-sm font-semibold">
                <li><a href="<?php echo url(); ?>" class="nav-link <?php echo is_active_page('home') === 'active' ? 'text-blue-900' : 'text-slate-600'; ?>"><?php echo t('home'); ?></a></li>
                <li><a href="<?php echo url('unternehmen'); ?>" class="nav-link <?php echo is_active_page('unternehmen') === 'active' ? 'text-blue-900' : 'text-slate-600'; ?>"><?php echo t('unternehmen'); ?></a></li>
                <li><a href="<?php echo url('dienstleistungen'); ?>" class="nav-link <?php echo is_active_page('dienstleistungen') === 'active' || is_active_page('dienstleistung-detail') === 'active' ? 'text-blue-900' : 'text-slate-600'; ?>"><?php echo t('dienstleistungen'); ?></a></li>
                <li><a href="<?php echo url('kontakt'); ?>" class="nav-link <?php echo is_active_page('kontakt') === 'active' ? 'text-blue-900' : 'text-slate-600'; ?>"><?php echo t('kontakt'); ?></a></li>
                <li><a href="<?php echo url('anfahrt'); ?>" class="nav-link <?php echo is_active_page('anfahrt') === 'active' ? 'text-blue-900' : 'text-slate-600'; ?>"><?php echo t('anfahrt'); ?></a></li>
            </ul>
            
            <!-- Language Switcher -->
            <?php
            $current_page = $_GET['page'] ?? 'home';
            $current_slug = $_GET['slug'] ?? null;
            if ($current_page === 'home') {
                $current_path = '';
            } elseif ($current_page === 'dienstleistung-detail' && $current_slug) {
                $current_path = 'dienstleistungen/' . $current_slug;
            } else {
                $current_path = $current_page;
            }
            $current_lang = $_SESSION['lang'] ?? DEFAULT_LANG;
            $available_languages = [
                'de' => ['label' => 'Deutsch (DE)'],
                'en' => ['label' => 'English (EN)'],
                'tr' => ['label' => 'Türkçe (TR)'],
            ];
            ?>
            <div class="hidden md:flex items-center space-x-2">
                <label for="desktop-language" class="text-xs uppercase tracking-wide text-slate-500"><?php echo t('language'); ?></label>
                <select id="desktop-language"
                        class="bg-white border border-gray-200 rounded-md px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        onchange="if(this.value){window.location.href=this.value;}">
                    <?php foreach ($available_languages as $code => $data): ?>
                        <option value="<?php echo url($current_path, $code); ?>" <?php echo $current_lang === $code ? 'selected' : ''; ?>>
                            <?php echo e($data['label']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-slate-900 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        
        <!-- Mobile Navigation -->
        <div x-show="mobileMenuOpen" x-transition class="md:hidden mt-4 pb-4 bg-white border border-gray-200 rounded-xl shadow-lg">
            <ul class="space-y-3 p-4 text-slate-700">
                <li><a href="<?php echo url(); ?>" class="block py-2 px-3 rounded-lg hover:bg-gray-50 transition <?php echo is_active_page('home') === 'active' ? 'text-blue-900 font-semibold' : ''; ?>"><?php echo t('home'); ?></a></li>
                <li><a href="<?php echo url('unternehmen'); ?>" class="block py-2 px-3 rounded-lg hover:bg-gray-50 transition <?php echo is_active_page('unternehmen') === 'active' ? 'text-blue-900 font-semibold' : ''; ?>"><?php echo t('unternehmen'); ?></a></li>
                <li><a href="<?php echo url('dienstleistungen'); ?>" class="block py-2 px-3 rounded-lg hover:bg-gray-50 transition <?php echo is_active_page('dienstleistungen') === 'active' || is_active_page('dienstleistung-detail') === 'active' ? 'text-blue-900 font-semibold' : ''; ?>"><?php echo t('dienstleistungen'); ?></a></li>
                <li><a href="<?php echo url('kontakt'); ?>" class="block py-2 px-3 rounded-lg hover:bg-gray-50 transition <?php echo is_active_page('kontakt') === 'active' ? 'text-blue-900 font-semibold' : ''; ?>"><?php echo t('kontakt'); ?></a></li>
                <li><a href="<?php echo url('anfahrt'); ?>" class="block py-2 px-3 rounded-lg hover:bg-gray-50 transition <?php echo is_active_page('anfahrt') === 'active' ? 'text-blue-900 font-semibold' : ''; ?>"><?php echo t('anfahrt'); ?></a></li>
                <li class="pt-2 border-t border-gray-200">
                    <div class="flex items-center space-x-2">
                        <label for="mobile-language" class="text-sm text-slate-500"><?php echo t('language'); ?></label>
                        <select id="mobile-language"
                                class="flex-1 bg-white border border-gray-200 rounded-md px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                onchange="if(this.value){window.location.href=this.value;}">
                            <?php foreach ($available_languages as $code => $data): ?>
                                <option value="<?php echo url($current_path, $code); ?>" <?php echo $current_lang === $code ? 'selected' : ''; ?>>
                                    <?php echo e($data['label']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
