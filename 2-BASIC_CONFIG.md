<?php
// config.php

// Hata raporlama (development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Site temel ayarları
define('SITE_URL', 'http://localhost/klas-website');
define('SITE_NAME', 'K.L.A.S. Dienstleistungs GmbH');
define('SITE_DESCRIPTION', 'Professionelle Dienstleistungen seit 1997');
define('DEFAULT_LANG', 'de');

// Sayfa tanımları
define('PAGES', [
    'home' => ['de' => 'Startseite', 'en' => 'Home', 'tr' => 'Ana Sayfa'],
    'unternehmen' => ['de' => 'Unternehmen', 'en' => 'Company', 'tr' => 'Şirket'],
    'dienstleistungen' => ['de' => 'Dienstleistungen', 'en' => 'Services', 'tr' => 'Hizmetler'],
    'kontakt' => ['de' => 'Kontakt', 'en' => 'Contact', 'tr' => 'İletişim'],
    'anfahrt' => ['de' => 'Anfahrt', 'en' => 'Location', 'tr' => 'Konum'],
]);

// İletişim bilgileri
define('CONTACT_EMAIL', 'info@klas-dienstleistung.de');
define('CONTACT_PHONE', '+49 XXX XXXXXXX');
define('CONTACT_ADDRESS', [
    'street' => 'Straße XX',
    'city' => 'Stadt',
    'postal' => 'PLZ',
    'country' => 'Deutschland'
]);

// reCAPTCHA keys (şimdilik boş)
define('RECAPTCHA_SITE_KEY', '');
define('RECAPTCHA_SECRET_KEY', '');

// Session başlat
session_start();

// Varsayılan dil ayarla
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = DEFAULT_LANG;
}

// Dil değiştirme
if (isset($_GET['lang']) && in_array($_GET['lang'], ['de', 'en', 'tr'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
```

ÖNEMLİ NOTLAR:
- CONTACT_* değişkenlerini gerçek bilgilerle güncelleyeceğiz
- Production'da display_errors = 0 olacak
- reCAPTCHA key'leri formdan önce alınacak
```

### 2.2 - .htaccess
```apache
# .htaccess

# SEO-friendly URLs
RewriteEngine On
RewriteBase /

# HTTPS yönlendirme (production'da)
# RewriteCond %{HTTPS} off
# RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# www olmadan yönlendir
# RewriteCond %{HTTP_HOST} ^www\.(.*)$ [NC]
# RewriteRule ^(.*)$ http://%1/$1 [R=301,L]

# Ana sayfa
RewriteRule ^$ index.php?page=home [L]

# Diğer sayfalar
RewriteRule ^unternehmen/?$ index.php?page=unternehmen [L]
RewriteRule ^dienstleistungen/?$ index.php?page=dienstleistungen [L]
RewriteRule ^dienstleistungen/([a-z-]+)/?$ index.php?page=dienstleistung-detail&slug=$1 [L]
RewriteRule ^kontakt/?$ index.php?page=kontakt [L]
RewriteRule ^anfahrt/?$ index.php?page=anfahrt [L]
RewriteRule ^impressum/?$ index.php?page=impressum [L]
RewriteRule ^datenschutz/?$ index.php?page=datenschutz [L]

# Dosya uzantılarını gizle
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME}.php -f
RewriteRule ^([^\.]+)$ $1.php [L]

# Cache ayarları
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/svg+xml "access plus 1 year"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType text/javascript "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
</IfModule>

# Gzip compression
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript application/json
</IfModule>

# Güvenlik başlıkları
<IfModule mod_headers.c>
    Header set X-Content-Type-Options "nosniff"
    Header set X-Frame-Options "SAMEORIGIN"
    Header set X-XSS-Protection "1; mode=block"
</IfModule>

# PHP ayarları
php_value upload_max_filesize 10M
php_value post_max_size 10M
php_value max_execution_time 300
php_value max_input_time 300

# Hassas dosyaları koru
<FilesMatch "^(config\.php|\.htaccess)$">
    Order allow,deny
    Deny from all
</FilesMatch>
```

ÖNEMLİ:
- URL yapısı: /dienstleistungen/konfektionieren gibi temiz URL'ler
- Cache headers performans için kritik
- HTTPS yönlendirmeleri production'da açılacak