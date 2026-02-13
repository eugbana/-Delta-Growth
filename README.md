# Delta Growth WordPress Theme

A modern, conversion-focused WordPress theme built for growth-oriented businesses with complete dynamic content architecture, WooCommerce integration, and advanced features.

Features

**7 Dynamic Front Page Sections** (Hero, About, Services, Featured Products, Testimonials, Pricing, Contact)
**3 Custom Post Types** (Services, Testimonials, Pricing Plans)
**WooCommerce Integration** with Featured Products section
 **Advanced Custom Fields Integration** (programmatic field registration)
**Auto-playing Testimonial Slider** with touch/swipe support and centered layout
**Contact Section** with WPForms integration and contact information display
**Comprehensive Footer** with logo, quick links, social media, and copyright
**SVG Graphics** for decorative elements throughout the site
**Mobile-First Responsive Design** with CSS Grid layouts
**Font Awesome Icons** (auto-loaded via CDN v6.5.1)
**CSS Custom Properties** for easy customization
**WordPress Coding Standards** compliant
**Lazy Loading** for optimized image performance

What's Included

Custom Post Types
1. **Services** - Showcase your services with icons and descriptions
  - Fields: Short Description, Icon Class, Featured Image
2. **Testimonials** - Display client reviews with ratings and photos
  - Fields: Client Company, Rating (1-5 stars), Featured Image
3. **Pricing Plans** - Present pricing tiers with feature lists
  - Fields: Price, Features (textarea, one per line), Highlight Plan (toggle)

Front Page Sections
1. **Hero** - Full-width banner with headline, subtext, and CTA button
  - Decorative SVG background graphics
2. **About** - Company intro with 3 service highlights
  - Wave divider SVG graphics
3. **Services** - Responsive 3-column grid of services
  - Font Awesome icons, short descriptions, "Learn More" links
4. **Featured Products** - WooCommerce products showcase
  - 3 latest products with thumbnails, prices, excerpts, Add to Cart buttons
  - Responsive grid: 3 columns (desktop), 2 columns (tablet), 1 column (mobile)
  - Lazy loading for product images
5. **Testimonials** - Auto-playing slider with client reviews
  - Centered single-testimonial layout
  - Star ratings, client photos, company information
  - Navigation dots with active state animation
6. **Pricing** - Pricing cards with highlighted "Most Popular" option
  - Feature lists, CTA buttons, responsive grid layout
7. **Contact** - Contact form and information display
  - WPForms integration (form ID: 10)
  - Contact info with Font Awesome icons (email, phone, address)
  - Two-column layout (desktop), stacked (mobile)

Quick Setup

### Prerequisites
- WordPress 5.0 or higher
- PHP 7.4 or higher
- Advanced Custom Fields plugin (free version) - **Required**
- WooCommerce plugin - **Required** for Featured Products section
- WPForms Lite plugin - **Required** for Contact form

### Installation Steps

1. **Activate the theme**
  - Go to Appearance → Themes
  - Activate "Delta Growth"

2. **Install Required Plugins**
  - Go to Plugins → Add New
  - Install and activate:
    - **Advanced Custom Fields** (free version)
    - **WooCommerce** (for product features)
    - **WPForms Lite** (for contact form)

3. **ACF Field Groups (Auto-Registered)**
  - ACF field groups are **automatically registered** via `functions.php`
  - No manual field group creation needed!
  - Fields are programmatically added on theme activation
  - **Note:** Repeater fields require ACF PRO; free version uses textarea fields


4. **Set Front Page**
  - Go to Settings → Reading
  - Select "A static page"
  - Choose "Home" as homepage

5. **Configure WPForms**
  - Go to WPForms → Add New
  - Create a contact form
  - Note the form ID (default: 10)
  - Update form ID in `front-page.php` if different

6. **Add WooCommerce Products** (Optional)
  - Go to Products → Add New
  - Add at least 3 products to populate Featured Products section
  - Add product images for best display

7. **Done!** Visit your site to see the results

Documentation

- **`README.md`** - This file (complete project documentation)
- **`functions.php`** - Theme functions and ACF field registration
- **`front-page.php`** - Homepage template with all sections

Customization

### Colors
Edit CSS variables in `style.css`:
```css
:root {
   --primary: #0F172A;    /* Dark blue-gray */
   --accent: #38BDF8;     /* Bright blue */
   --white: #ffffff;
   --gray-light: #f8fafc;
}
```

### Typography
- Font: Inter (Google Fonts)
- Loaded automatically
- Change in `functions.php` if needed

### Spacing
Uses 8px scale system:
- `--spacing-xs: 8px`
- `--spacing-sm: 16px`
- `--spacing-md: 24px`
- `--spacing-lg: 32px`
- `--spacing-xl: 40px`
- `--spacing-2xl: 48px`
- `--spacing-3xl: 64px`

Content Guidelines

### Services
- **Title:** Short, clear service name
- **Content:** Detailed description with benefits
- **Short Description:** 100-150 characters for cards
- **Icon Class:** Font Awesome class (e.g., `fas fa-chart-line`)
- **Featured Image:** 800x600px recommended

### Testimonials
- **Title:** Client's full name
- **Content:** The testimonial quote (2-3 sentences ideal)
- **Client Company:** Job title and company name
- **Rating:** 1-5 stars
- **Featured Image:** Client photo, square format, 300x300px minimum

### Pricing Plans
- **Title:** Plan name (e.g., "Growth Starter")
- **Content:** Brief plan description
- **Price:** Include currency and period (e.g., "£1,200 / month")
- **Features:** List of included features (textarea format, one feature per line)
 - **Note:** ACF free version uses textarea instead of repeater field
 - Enter one feature per line
 - Helper function `delta_growth_get_pricing_plan_features()` parses the textarea
- **Highlight Plan:** Toggle on for "Most Popular" badge

### Featured Products (WooCommerce)
- **Product Title:** Clear, descriptive product name
- **Product Image:** High-quality image (recommended: 800x800px or larger)
 - Images are lazy-loaded for performance
 - Uses `woocommerce_thumbnail` size (300x300px)
 - Constrained to max-height: 400px
- **Price:** Set in WooCommerce product settings
- **Short Description:** Brief product description (15 words shown in excerpt)
- **Add to Cart:** Automatically generated WooCommerce button

## Technical Details

### File Structure
```
delta-growth/
├── style.css                    # Main stylesheet (1827 lines)
├── functions.php                # Theme functions & ACF registration (955 lines)
├── front-page.php              # Homepage template with 7 sections
├── header.php                  # Header with logo and navigation
├── footer.php                  # Comprehensive footer (logo, links, social, copyright)
├── index.php                   # Blog index
├── create-content-only.php     # Content creation script (run once)
├── archive-service.php         # Services archive
├── single-service.php          # Single service
├── archive-testimonial.php     # Testimonials archive
├── single-testimonial.php      # Single testimonial
├── archive-pricing_plan.php    # Pricing archive
├── single-pricing_plan.php     # Single pricing plan
├── assets/
│   ├── js/
│   │   └── main.js            # JavaScript (testimonial slider)
│   └── css/
└── template-parts/
   ├── content.php
   └── content-none.php
```


### Browser Support
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

### Performance Optimizations
- **Lazy Loading:** Product images use `loading="lazy"` attribute
- **Optimized Image Sizes:** WooCommerce thumbnail size (300x300px)
- **Minimal Dependencies:** jQuery (WordPress core), Font Awesome CDN
- **Optimized CSS:** No bloat, efficient selectors, CSS Grid for layouts
- **Efficient JavaScript:** Event delegation, minimal DOM manipulation
- **SVG Graphics:** Inline SVG for decorative elements (no HTTP requests)
- **CSS Custom Properties:** Fast theme customization without recompilation

### ACF Field Registration (Programmatic)
All ACF field groups are registered programmatically in `functions.php`:
- **Front Page Fields:** Hero section, About section
- **Service Fields:** Short Description, Icon Class
- **Testimonial Fields:** Client Company, Rating
- **Pricing Plan Fields:** Price, Features (textarea), Highlight Plan

**Benefits:**
- No manual field group creation needed
- Version controlled field definitions
- Consistent across all environments
- Easy to deploy and replicate


##  License

This theme is licensed under the GPL v2 or later.

## Credits

- **Font:** Inter by Rasmus Andersson (Google Fonts)
- **Icons:** Font Awesome 6.5.1 (CDN)
- **Framework:** WordPress
- **Plugins:** Advanced Custom Fields, WooCommerce, WPForms Lite

**Version:** 1.0.0
**Author:** Dominic Ugbana
**Requires WordPress:** 5.0+
**Tested up to:** 6.4
**Requires PHP:** 7.4+
**Required Plugins:** Advanced Custom Fields (free), WooCommerce, WPForms Lite
**Last Updated:** 2026-02-13




