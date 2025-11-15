# K.L.A.S. Dienstleistungs GmbH Website

Modern, responsive corporate website for K.L.A.S. Dienstleistungs GmbH - a German industrial services company specializing in Konfektionierung, Etikettierung, and Verpackung.

## Project Overview

- **Company**: K.L.A.S. Dienstleistungs GmbH
- **Industry**: Industrial Services (Assembly, Labeling, Packaging)
- **Founded**: 1997
- **Location**: Germany
- **Facility**: 2000+ m² production area
- **Services**: 8 different industrial process services

## Technology Stack

- **Backend**: Vanilla PHP 8.0+ (no Composer, no frameworks)
- **Frontend**: TailwindCSS (CDN) + Alpine.js (CDN)
- **Data**: JSON files (services, company info, translations)
- **Languages**: German (default), English, Turkish
- **Architecture**: Classic PHP structure (no autoload, no namespaces)

## Project Structure

```
klas-diensleistungen/
├── index.php              # Main router
├── config.php             # Site configuration
├── .htaccess              # URL rewriting & server config
├── robots.txt             # Search engine directives
├── sitemap.xml            # XML sitemap
├── assets/
│   ├── css/
│   │   └── custom.css     # Custom CSS overrides
│   ├── js/
│   │   └── main.js        # Custom JavaScript
│   └── images/            # Images directory
│       └── services/      # Service images
├── includes/
│   ├── header.php         # HTML head & meta tags
│   ├── footer.php         # Footer & scripts
│   ├── navigation.php     # Main navigation & language switcher
│   └── functions.php      # Helper functions
├── pages/
│   ├── home.php           # Homepage
│   ├── unternehmen.php    # Company page
│   ├── dienstleistungen.php           # Services listing
│   ├── dienstleistung-detail.php      # Service detail page
│   ├── kontakt.php        # Contact form page
│   ├── anfahrt.php        # Location/map page
│   ├── impressum.php      # Legal notice
│   └── datenschutz.php    # Privacy policy
├── components/
│   ├── hero.php           # Hero section component
│   ├── service-card.php   # Service card component
│   └── cta-section.php    # Call-to-action component
└── data/
    ├── services.json      # All 8 services data
    ├── company.json       # Company information
    └── translations/
        ├── de.json        # German translations
        ├── en.json        # English translations
        └── tr.json        # Turkish translations
```

## Features

### Multi-language Support
- German (default), English, Turkish
- Session-based language switching
- All UI text uses translation function `t()`

### Services
8 industrial services:
1. Konfektionieren (Assembly)
2. Einstecken (Insertion)
3. Bündeln (Bundling)
4. Einschrumpfen (Shrink Wrapping)
5. Etikettieren (Labeling)
6. Zusammentragen (Collating)
7. Verpacken (Packaging)
8. Kommissionieren (Order Picking)

### SEO Features
- Clean URLs via .htaccess rewrites
- Meta tags (title, description, keywords)
- Open Graph tags
- Twitter Cards
- JSON-LD Schema.org markup
- XML sitemap
- Breadcrumbs

### Contact Form
- Server-side validation
- Email sending via PHP mail()
- XSS protection
- Privacy policy agreement

### Security
- Input sanitization
- XSS protection
- CSRF protection ready
- File protection via .htaccess

## Installation

1. Upload all files to your web server
2. Configure `config.php`:
   - Update `SITE_URL` with your domain
   - Update contact information
   - Add reCAPTCHA keys if needed
3. Ensure PHP 8.0+ is installed
4. Set proper file permissions
5. Add logo image to `assets/images/logo.jpg`
6. Add service images to `assets/images/services/`

## Configuration

### config.php
Main configuration file contains:
- Site URL and name
- Contact information
- Default language
- Page definitions
- reCAPTCHA keys (optional)

### .htaccess
- Clean URL rewriting
- Cache headers
- Security headers
- Gzip compression

## Development

### Adding New Pages
1. Add page route in `.htaccess`
2. Create page file in `pages/` directory
3. Add page to router in `index.php`

### Adding Translations
1. Add translation key to all language files in `data/translations/`
2. Use `t('key')` function in templates

### Adding Services
1. Add service data to `data/services.json`
2. Service will automatically appear on services page

## Browser Support

- Modern browsers (Chrome, Firefox, Safari, Edge)
- Mobile responsive (mobile-first design)
- Progressive enhancement

## Design Principles

- **Colors**: Dark blue (#1e3a8a, #1e40af) + Orange accents (#f97316, #fb923c)
- **Typography**: System fonts for optimal performance
- **Layout**: Mobile-first responsive design
- **Style**: Corporate, professional, clean, minimalist

## Notes

- No database required - all data in JSON files
- No Composer dependencies
- No framework dependencies
- Pure vanilla PHP implementation
- Production ready (configure error reporting in config.php)

## License

Proprietary - K.L.A.S. Dienstleistungs GmbH

