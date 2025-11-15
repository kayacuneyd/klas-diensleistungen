Aşağıdaki klasör ve dosya yapısını oluştur:

klas-website/
├── index.php
├── config.php
├── .htaccess
├── robots.txt
├── sitemap.xml
├── assets/
│   ├── css/
│   │   └── custom.css
│   ├── js/
│   │   └── main.js
│   └── images/
│       ├── logo.jpg (şimdilik placeholder)
│       └── services/ (8 hizmet için placeholder görseller)
├── includes/
│   ├── header.php
│   ├── footer.php
│   ├── navigation.php
│   └── functions.php
├── pages/
│   ├── home.php
│   ├── unternehmen.php
│   ├── dienstleistungen.php
│   ├── dienstleistung-detail.php
│   ├── kontakt.php
│   ├── anfahrt.php
│   ├── impressum.php
│   └── datenschutz.php
├── components/
│   ├── service-card.php
│   ├── cta-section.php
│   └── hero.php
└── data/
    ├── services.json
    ├── company.json
    └── translations/
        ├── de.json
        ├── en.json
        └── tr.json

ÖNEMLI:
- Her klasör için README.md ekle (kullanım amacını açıkla)
- Tüm PHP dosyalarında UTF-8 encoding kullan
- Klasik PHP yapısı (namespace yok, autoload yok)