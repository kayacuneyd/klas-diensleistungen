<?php
// includes/functions.php

/**
 * Çeviri fonksiyonu
 * Kullanım: t('welcome_message')
 */
function t($key, $lang = null) {
    $lang = $lang ?? $_SESSION['lang'] ?? DEFAULT_LANG;
    
    $file = __DIR__ . "/../data/translations/{$lang}.json";
    
    if (!file_exists($file)) {
        return $key;
    }
    
    $translations = json_decode(file_get_contents($file), true);
    
    return $translations[$key] ?? $key;
}

/**
 * Aktif sayfa kontrolü (menü highlight için)
 */
function is_active_page($page) {
    $current = $_GET['page'] ?? 'home';
    return $current === $page ? 'active' : '';
}

/**
 * Güvenli HTML çıktısı
 */
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * URL oluştur
 */
function url($path = '', $lang = null) {
    $lang = $lang ?? $_SESSION['lang'];
    return SITE_URL . '/' . ltrim($path, '/') . ($lang !== DEFAULT_LANG ? "?lang={$lang}" : '');
}

/**
 * Asset URL
 */
function asset($path) {
    return SITE_URL . '/assets/' . ltrim($path, '/');
}

/**
 * Hizmetleri yükle
 */
function get_services() {
    $file = __DIR__ . '/../data/services.json';
    return json_decode(file_get_contents($file), true)['services'] ?? [];
}

/**
 * Tek hizmet detayı (slug ile)
 */
function get_service_by_slug($slug) {
    $services = get_services();
    foreach ($services as $service) {
        if ($service['slug'] === $slug) {
            return $service;
        }
    }
    return null;
}

/**
 * Şirket bilgilerini yükle
 */
function get_company_info() {
    $file = __DIR__ . '/../data/company.json';
    return json_decode(file_get_contents($file), true);
}

/**
 * Form validasyon
 */
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validate_phone($phone) {
    // Basit validasyon, gerekirse düzenle
    return preg_match('/^[0-9+\-\s()]+$/', $phone);
}

/**
 * XSS temizleme
 */
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Meta tags oluştur
 */
function generate_meta_tags($title = '', $description = '', $keywords = '', $image = '') {
    $title = $title ?: SITE_NAME;
    $description = $description ?: SITE_DESCRIPTION;
    $image = $image ?: asset('images/logo.jpg');
    
    $meta = "
    <title>{$title}</title>
    <meta name='description' content='{$description}'>
    <meta name='keywords' content='{$keywords}'>
    
    <!-- Open Graph -->
    <meta property='og:title' content='{$title}'>
    <meta property='og:description' content='{$description}'>
    <meta property='og:image' content='{$image}'>
    <meta property='og:url' content='" . $_SERVER['REQUEST_URI'] . "'>
    <meta property='og:type' content='website'>
    
    <!-- Twitter Card -->
    <meta name='twitter:card' content='summary_large_image'>
    <meta name='twitter:title' content='{$title}'>
    <meta name='twitter:description' content='{$description}'>
    <meta name='twitter:image' content='{$image}'>
    ";
    
    return $meta;
}

/**
 * Breadcrumb oluştur
 */
function get_breadcrumb() {
    $page = $_GET['page'] ?? 'home';
    $breadcrumb = [
        ['title' => t('home'), 'url' => url()]
    ];
    
    if ($page !== 'home') {
        $breadcrumb[] = ['title' => t($page), 'url' => url($page)];
    }
    
    return $breadcrumb;
}

/**
 * JSON-LD Schema oluştur
 */
function generate_schema_org($type = 'Organization') {
    $company = get_company_info();
    
    if ($type === 'Organization') {
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "Organization",
            "name" => SITE_NAME,
            "url" => SITE_URL,
            "logo" => asset('images/logo.jpg'),
            "description" => SITE_DESCRIPTION,
            "address" => [
                "@type" => "PostalAddress",
                "streetAddress" => CONTACT_ADDRESS['street'],
                "addressLocality" => CONTACT_ADDRESS['city'],
                "postalCode" => CONTACT_ADDRESS['postal'],
                "addressCountry" => "DE"
            ],
            "contactPoint" => [
                "@type" => "ContactPoint",
                "telephone" => CONTACT_PHONE,
                "contactType" => "customer service",
                "email" => CONTACT_EMAIL
            ]
        ];
    }
    
    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}
```

AÇIKLAMA:
- Tüm yardımcı fonksiyonlar burada
- t() fonksiyonu çeviri için kullanılacak
- Güvenlik fonksiyonları (clean_input, validate_*)
- SEO fonksiyonları (meta tags, schema)
```

---

## 📦 BÖLÜM 4: Veri Dosyaları (JSON)

### 4.1 - data/services.json
```json
{
  "services": [
    {
      "id": 1,
      "slug": "konfektionieren",
      "icon": "📦",
      "image": "konfektionieren.jpg",
      "title": {
        "de": "Konfektionieren",
        "en": "Assembly",
        "tr": "Montaj"
      },
      "short_description": {
        "de": "Professionelle Konfektionierung Ihrer Produkte nach individuellen Anforderungen.",
        "en": "Professional assembly of your products according to individual requirements.",
        "tr": "Bireysel gereksinimlere göre ürünlerinizin profesyonel montajı."
      },
      "full_description": {
        "de": "Unsere Konfektionierungsdienstleistungen umfassen die komplette Aufbereitung und Zusammenstellung Ihrer Produkte. Vom einfachen Zusammenfügen bis hin zu komplexen Montagearbeiten – wir bieten maßgeschneiderte Lösungen für Ihre Anforderungen. Mit modernsten Anlagen und erfahrenem Personal garantieren wir höchste Qualität und Präzision.",
        "en": "Our assembly services include the complete preparation and compilation of your products...",
        "tr": "Montaj hizmetlerimiz ürünlerinizin tam hazırlanmasını ve bir araya getirilmesini içerir..."
      },
      "benefits": {
        "de": [
          "Flexible Kapazitäten",
          "Schnelle Bearbeitungszeiten",
          "Qualitätskontrolle nach DIN-Normen",
          "Individuelle Lösungen"
        ],
        "en": ["Flexible capacities", "Fast processing times", "Quality control according to DIN standards", "Individual solutions"],
        "tr": ["Esnek kapasiteler", "Hızlı işlem süreleri", "DIN standartlarına göre kalite kontrol", "Bireysel çözümler"]
      },
      "industries": {
        "de": ["Automobilindustrie", "Verlagswesen", "E-Commerce", "Pharma"],
        "en": ["Automotive", "Publishing", "E-Commerce", "Pharma"],
        "tr": ["Otomotiv", "Yayıncılık", "E-Ticaret", "Farma"]
      },
      "process_steps": {
        "de": [
          "Auftragsannahme und Planung",
          "Material bereitstellen",
          "Konfektionierung durchführen",
          "Qualitätsprüfung",
          "Verpackung und Versand"
        ],
        "en": ["Order acceptance and planning", "Material provision", "Assembly execution", "Quality check", "Packaging and shipping"],
        "tr": ["Sipariş kabulü ve planlama", "Malzeme temini", "Montaj gerçekleştirme", "Kalite kontrolü", "Paketleme ve gönderim"]
      }
    },
    {
      "id": 2,
      "slug": "einstecken",
      "icon": "📬",
      "image": "einstecken.jpg",
      "title": {
        "de": "Einstecken",
        "en": "Insertion",
        "tr": "Yerleştirme"
      },
      "short_description": {
        "de": "Präzises Einstecken von Beilagen, Flyern und Werbemitteln in Ihre Produkte.",
        "en": "Precise insertion of inserts, flyers and promotional materials into your products.",
        "tr": "Ekler, el ilanları ve tanıtım materyallerinin ürünlerinize hassas yerleştirilmesi."
      },
      "full_description": {
        "de": "Professionelles Einstecken von Beilagen, Werbeprospekten und Zusatzmaterialien...",
        "en": "Professional insertion of inserts, advertising brochures and additional materials...",
        "tr": "Ekler, reklam broşürleri ve ek materyallerin profesyonel yerleştirilmesi..."
      },
      "benefits": {
        "de": ["Hohe Geschwindigkeit", "Fehlerfreie Verarbeitung", "Verschiedene Formate möglich"],
        "en": ["High speed", "Error-free processing", "Various formats possible"],
        "tr": ["Yüksek hız", "Hatasız işleme", "Çeşitli formatlar mümkün"]
      },
      "industries": {
        "de": ["Direktmarketing", "Verlagswesen", "Einzelhandel"],
        "en": ["Direct marketing", "Publishing", "Retail"],
        "tr": ["Doğrudan pazarlama", "Yayıncılık", "Perakende"]
      },
      "process_steps": {
        "de": ["Materialprüfung", "Maschinelle Verarbeitung", "Stichprobenprüfung", "Verpackung"],
        "en": ["Material inspection", "Machine processing", "Sample check", "Packaging"],
        "tr": ["Malzeme kontrolü", "Makine işleme", "Numune kontrolü", "Paketleme"]
      }
    },
    {
      "id": 3,
      "slug": "buendeln",
      "icon": "🎁",
      "image": "buendeln.jpg",
      "title": {
        "de": "Bündeln",
        "en": "Bundling",
        "tr": "Demetleme"
      },
      "short_description": {
        "de": "Effizientes Bündeln von Produkten für Transport und Lagerung.",
        "en": "Efficient bundling of products for transport and storage.",
        "tr": "Taşıma ve depolama için ürünlerin verimli demetlenmesi."
      },
      "full_description": {
        "de": "Wir bündeln Ihre Produkte schnell und sicher...",
        "en": "We bundle your products quickly and safely...",
        "tr": "Ürünlerinizi hızlı ve güvenli bir şekilde demetleriz..."
      },
      "benefits": {
        "de": ["Platzsparend", "Transportsicher", "Individuelle Bündelgrößen"],
        "en": ["Space-saving", "Transport-safe", "Individual bundle sizes"],
        "tr": ["Yer tasarrufu", "Taşıma güvenliği", "Bireysel demet boyutları"]
      },
      "industries": {
        "de": ["Logistik", "Druckereien", "Großhandel"],
        "en": ["Logistics", "Printing", "Wholesale"],
        "tr": ["Lojistik", "Baskı", "Toptan satış"]
      },
      "process_steps": {
        "de": ["Sortierung", "Bündelung", "Banderolierung", "Etikettierung"],
        "en": ["Sorting", "Bundling", "Banding", "Labeling"],
        "tr": ["Sıralama", "Demetleme", "Bantlama", "Etiketleme"]
      }
    },
    {
      "id": 4,
      "slug": "einschrumpfen",
      "icon": "🔥",
      "image": "einschrumpfen.jpg",
      "title": {
        "de": "Einschrumpfen / Einschweißen",
        "en": "Shrink Wrapping",
        "tr": "Shrink Ambalaj"
      },
      "short_description": {
        "de": "Schutz und Präsentation Ihrer Produkte durch professionelles Schrumpfen.",
        "en": "Protection and presentation of your products through professional shrink wrapping.",
        "tr": "Profesyonel shrink ambalaj ile ürünlerinizin korunması ve sunumu."
      },
      "full_description": {
        "de": "Durch Einschrumpfen oder Einschweißen schützen wir Ihre Produkte optimal...",
        "en": "Through shrink wrapping or sealing, we optimally protect your products...",
        "tr": "Shrink ambalaj veya mühürleme yoluyla ürünlerinizi en iyi şekilde koruruz..."
      },
      "benefits": {
        "de": ["Optimaler Schutz", "Ansprechende Optik", "Hygienisch"],
        "en": ["Optimal protection", "Attractive appearance", "Hygienic"],
        "tr": ["Optimal koruma", "Çekici görünüm", "Hijyenik"]
      },
      "industries": {
        "de": ["Lebensmittel", "Kosmetik", "Elektronik"],
        "en": ["Food", "Cosmetics", "Electronics"],
        "tr": ["Gıda", "Kozmetik", "Elektronik"]
      },
      "process_steps": {
        "de": ["Vorbereitung", "Foliierung", "Schrumpftunnel", "Endkontrolle"],
        "en": ["Preparation", "Foiling", "Shrink tunnel", "Final inspection"],
        "tr": ["Hazırlık", "Folyolama", "Shrink tüneli", "Son kontrol"]
      }
    },
    {
      "id": 5,
      "slug": "etikettieren",
      "icon": "🏷️",
      "image": "etikettieren.jpg",
      "title": {
        "de": "Etikettieren",
        "en": "Labeling",
        "tr": "Etiketleme"
      },
      "short_description": {
        "de": "Professionelle Etikettierung nach Ihren Vorgaben und gesetzlichen Anforderungen.",
        "en": "Professional labeling according to your specifications and legal requirements.",
        "tr": "Özelliklerinize ve yasal gereksinimlere göre profesyonel etiketleme."
      },
      "full_description": {
        "de": "Wir etikettieren Ihre Produkte präzise und zuverlässig...",
        "en": "We label your products precisely and reliably...",
        "tr": "Ürünlerinizi hassas ve güvenilir bir şekilde etiketleriz..."
      },
      "benefits": {
        "de": ["Verschiedene Etikettenarten", "Hochgeschwindigkeit", "Barcode-Integration"],
        "en": ["Various label types", "High speed", "Barcode integration"],
        "tr": ["Çeşitli etiket türleri", "Yüksek hız", "Barkod entegrasyonu"]
      },
      "industries": {
        "de": ["Lebensmittel", "Pharma", "Logistik", "Einzelhandel"],
        "en": ["Food", "Pharma", "Logistics", "Retail"],
        "tr": ["Gıda", "Farma", "Lojistik", "Perakende"]
      },
      "process_steps": {
        "de": ["Etikettendruck", "Positionierung", "Aufbringung", "Kontrolle"],
        "en": ["Label printing", "Positioning", "Application", "Control"],
        "tr": ["Etiket baskısı", "Konumlandırma", "Uygulama", "Kontrol"]
      }
    },
    {
      "id": 6,
      "slug": "zusammentragen",
      "icon": "📚",
      "image": "zusammentragen.jpg",
      "title": {
        "de": "Zusammentragen",
        "en": "Collating",
        "tr": "Harmanlama"
      },
      "short_description": {
        "de": "Exaktes Zusammentragen von Druckerzeugnissen und Dokumenten.",
        "en": "Exact collating of printed materials and documents.",
        "tr": "Basılı malzemelerin ve belgelerin tam harmanlanması."
      },
      "full_description": {
        "de": "Professionelles Zusammentragen verschiedener Materialien...",
        "en": "Professional collating of various materials...",
        "tr": "Çeşitli malzemelerin profesyonel harmanlanması..."
      },
      "benefits": {
        "de": ["Fehlerfreie Sortierung", "Hohe Kapazität", "Flexible Formate"],
        "en": ["Error-free sorting", "High capacity", "Flexible formats"],
        "tr": ["Hatasız sıralama", "Yüksek kapasite", "Esnek formatlar"]
      },
      "industries": {
        "de": ["Druckereien", "Verlagswesen", "Büroservice"],
        "en": ["Printing", "Publishing", "Office services"],
        "tr": ["Baskı", "Yayıncılık", "Ofis hizmetleri"]
      },
      "process_steps": {
        "de": ["Material sortieren", "Zusammentragen", "Prüfen", "Bündeln"],
        "en": ["Sort material", "Collate", "Check", "Bundle"],
        "tr": ["Malzeme sıralama", "Harmanlama", "Kontrol", "Demetleme"]
      }
    },
    {
      "id": 7,
      "slug": "verpacken",
      "icon": "📦",
      "image": "verpacken.jpg",
      "title": {
        "de": "Verpacken",
        "en": "Packaging",
        "tr": "Paketleme"
      },
      "short_description": {
        "de": "Sichere und professionelle Verpackung für jeden Bedarf.",
        "en": "Safe and professional packaging for every need.",
        "tr": "Her ihtiyaç için güvenli ve profesyonel paketleme."
      },
      "full_description": {
        "de": "Wir bieten maßgeschneiderte Verpackungslösungen...",
        "en": "We offer customized packaging solutions...",
        "tr": "Özelleştirilmiş paketleme çözümleri sunuyoruz..."
      },
      "benefits": {
        "de": ["Verschiedene Verpackungsarten", "Transportsicher", "Umweltfreundliche Optionen"],
        "en": ["Various packaging types", "Transport-safe", "Eco-friendly options"],
        "tr": ["Çeşitli paketleme türleri", "Taşıma güvenliği", "Çevre dostu seçenekler"]
      },
      "industries": {
        "de": ["E-Commerce", "Logistik", "Einzelhandel"],
        "en": ["E-Commerce", "Logistics", "Retail"],
        "tr": ["E-Ticaret", "Lojistik", "Perakende"]
      },
      "process_steps": {
        "de": ["Verpackungsmaterial wählen", "Produkt sichern", "Versiegeln", "Etikettieren"],
        "en": ["Choose packaging material", "Secure product", "Seal", "Label"],
        "tr": ["Paketleme malzemesi seçme", "Ürünü güvence altına alma", "Mühürleme", "Etiketleme"]
      }
    },
    {
      "id": 8,
      "slug": "kommissionieren",
      "icon": "📋",
      "image": "kommissionieren.jpg",
      "title": {
        "de": "Kommissionieren",
        "en": "Order Picking",
        "tr": "Sipariş Toplama"
      },
      "short_description": {
        "de": "Effiziente Kommissionierung für optimale Logistikprozesse.",
        "en": "Efficient order picking for optimal logistics processes.",
        "tr": "Optimal lojistik süreçler için verimli sipariş toplama."
      },
      "full_description": {
        "de": "Schnelle und präzise Kommissionierung Ihrer Aufträge...",
        "en": "Fast and precise picking of your orders...",
        "tr": "Siparişlerinizin hızlı ve hassas toplanması..."
      },
      "benefits": {
        "de": ["Fehlerminimierung", "Schnelle Durchlaufzeit", "Lageroptimierung"],
        "en": ["Error minimization", "Fast turnaround", "Inventory optimization"],
        "tr": ["Hata minimizasyonu", "Hızlı işlem", "Envanter optimizasyonu"]
      },
      "industries": {
        "de": ["E-Commerce", "Großhandel", "Lagerlogistik"],
        "en": ["E-Commerce", "Wholesale", "Warehouse logistics"],
        "tr": ["E-Ticaret", "Toptan satış", "Depo lojistiği"]
      },
      "process_steps": {
        "de": ["Auftragseingang", "Picking", "Kontrolle", "Versandvorbereitung"],
        "en": ["Order receipt", "Picking", "Control", "Shipping preparation"],
        "tr": ["Sipariş alımı", "Toplama", "Kontrol", "Gönderim hazırlığı"]
      }
    }
  ]
}
```

NOT: Tüm 8 hizmet tanımlandı. Full_description bölümleri daha sonra detaylandırılabilir.