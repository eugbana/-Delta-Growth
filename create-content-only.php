<?php
/**
 * Content Creation Script - Creates ONLY content (assumes ACF fields already exist)
 * 
 * INSTRUCTIONS:
 * 1. Make sure ACF plugin is installed and activated
 * 2. Make sure you can see ACF fields when editing Services/Testimonials/Pricing Plans
 * 3. Visit: yoursite.com/wp-content/themes/delta-growth/create-content-only.php
 * 4. Delete this file after running
 *
 * @package Delta_Growth
 */

// Load WordPress - try multiple possible paths
$wp_load_paths = array(
	'../../../../../wp-load.php',
	'../../../../../../wp-load.php',
	dirname(__FILE__) . '/../../../../../wp-load.php',
);

$wp_loaded = false;
foreach ($wp_load_paths as $path) {
	if (file_exists($path)) {
		require_once($path);
		$wp_loaded = true;
		break;
	}
}

if (!$wp_loaded) {
	$dir = dirname(__FILE__);
	for ($i = 0; $i < 10; $i++) {
		$dir = dirname($dir);
		if (file_exists($dir . '/wp-load.php')) {
			require_once($dir . '/wp-load.php');
			$wp_loaded = true;
			break;
		}
	}
}

if (!$wp_loaded) {
	die('ERROR: Could not locate wp-load.php.');
}

if (!current_user_can('manage_options')) {
	wp_die('You do not have permission to access this page.');
}

if (!function_exists('update_field')) {
	wp_die('ERROR: Advanced Custom Fields plugin is not installed or activated.');
}

echo '<style>
body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; padding: 40px; background: #f0f0f1; }
.container { max-width: 800px; margin: 0 auto; background: white; padding: 40px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
h1 { color: #0F172A; border-bottom: 3px solid #38BDF8; padding-bottom: 10px; }
h2 { color: #38BDF8; margin-top: 30px; }
.success { color: #059669; }
.error { color: #DC2626; }
.step { background: #f8fafc; padding: 15px; margin: 10px 0; border-left: 4px solid #38BDF8; }
</style>';

echo '<div class="container">';
echo '<h1>🚀 Delta Growth - Content Creation</h1>';
echo '<p>Creating all content with your exact specifications...</p>';
echo '<hr>';

// ============================================
// STEP 1: CREATE SERVICES
// ============================================
echo '<h2>Step 1: Creating Services</h2>';

$services = array(
	array(
		'title' => 'Digital Strategy',
		'content' => '<p>We audit, position, and build scalable marketing frameworks that align with your business goals.</p>

<h3>What\'s Included:</h3>
<ul>
<li>Market research</li>
<li>Funnel design</li>
<li>Customer journey mapping</li>
<li>Conversion optimisation</li>
</ul>',
		'short_description' => 'We audit, position, and build scalable marketing frameworks that align with your business goals.',
		'icon_class' => 'fas fa-chart-line',
		'order' => 1,
	),
	array(
		'title' => 'Paid Media & Advertising',
		'content' => '<p>ROI-focused advertising campaigns across Google, Meta, LinkedIn, and TikTok.</p>

<h3>What\'s Included:</h3>
<ul>
<li>PPC Campaign Management</li>
<li>Retargeting Systems</li>
<li>Creative Ad Testing</li>
<li>Budget Optimisation</li>
</ul>',
		'short_description' => 'ROI-focused advertising campaigns across Google, Meta, LinkedIn, and TikTok.',
		'icon_class' => 'fas fa-bullhorn',
		'order' => 2,
	),
	array(
		'title' => 'Website Design & Development',
		'content' => '<p>High-performance websites built to convert visitors into clients.</p>

<h3>What\'s Included:</h3>
<ul>
<li>UX/UI Design</li>
<li>WordPress Development</li>
<li>Landing Pages</li>
<li>Speed & SEO Optimisation</li>
</ul>',
		'short_description' => 'High-performance websites built to convert visitors into clients.',
		'icon_class' => 'fas fa-laptop-code',
		'order' => 3,
	),
	array(
		'title' => 'Content & Creative',
		'content' => '<p>Strategic content that builds brand authority and drives engagement.</p>

<h3>What\'s Included:</h3>
<ul>
<li>Social Media Strategy</li>
<li>Email Campaigns</li>
<li>Video Ads</li>
<li>Conversion Copywriting</li>
</ul>',
		'short_description' => 'Strategic content that builds brand authority and drives engagement.',
		'icon_class' => 'fas fa-pen-fancy',
		'order' => 4,
	),
);

foreach ($services as $service) {
	$post_id = wp_insert_post(array(
		'post_title'   => $service['title'],
		'post_content' => $service['content'],
		'post_type'    => 'service',
		'post_status'  => 'publish',
		'menu_order'   => $service['order'],
	));

	if ($post_id && !is_wp_error($post_id)) {
		update_field('short_description', $service['short_description'], $post_id);
		update_field('icon_class', $service['icon_class'], $post_id);
		echo '<div class="step success">✓ Created service: ' . $service['title'] . '</div>';
	} else {
		echo '<div class="step error">✗ Failed to create service: ' . $service['title'] . '</div>';
	}
}

// ============================================
// STEP 2: CREATE TESTIMONIALS
// ============================================
echo '<h2>Step 2: Creating Testimonials</h2>';

$testimonials = array(
	array(
		'client_name' => 'Sarah Mitchell',
		'content' => 'Delta Growth transformed our online presence. Within 90 days, we increased qualified leads by 63% and reduced ad spend waste significantly.',
		'company' => 'CEO, Elevate Finance',
		'rating' => 5,
	),
	array(
		'client_name' => 'James Thornton',
		'content' => 'Their strategy-first approach changed how we think about digital marketing. The ROI speaks for itself.',
		'company' => 'Founder, NovaTech Solutions',
		'rating' => 5,
	),
	array(
		'client_name' => 'Amina Yusuf',
		'content' => 'Professional, analytical, and creative — the perfect growth partner.',
		'company' => 'Marketing Director, BrightPath',
		'rating' => 5,
	),
);

foreach ($testimonials as $testimonial) {
	$post_id = wp_insert_post(array(
		'post_title'   => $testimonial['client_name'],
		'post_content' => $testimonial['content'],
		'post_type'    => 'testimonial',
		'post_status'  => 'publish',
	));

	if ($post_id && !is_wp_error($post_id)) {
		update_field('client_company', $testimonial['company'], $post_id);
		update_field('rating', $testimonial['rating'], $post_id);
		echo '<div class="step success">✓ Created testimonial: ' . $testimonial['client_name'] . '</div>';
	} else {
		echo '<div class="step error">✗ Failed to create testimonial: ' . $testimonial['client_name'] . '</div>';
	}
}

// ============================================
// STEP 3: CREATE PRICING PLANS
// ============================================
echo '<h2>Step 3: Creating Pricing Plans</h2>';

$pricing_plans = array(
	array(
		'title' => 'Growth Starter',
		'content' => '<p>Ideal for early-stage brands ready to scale.</p>',
		'price' => '£1,200 / month',
		'features' => array(
			'Strategy session',
			'Website optimisation',
			'1 ad platform management',
			'Monthly reporting',
			'Email support',
		),
		'highlight' => false,
		'order' => 1,
	),
	array(
		'title' => 'Growth Accelerator',
		'content' => '<p>For scaling businesses seeking aggressive growth.</p>',
		'price' => '£2,800 / month',
		'features' => array(
			'Full funnel strategy',
			'Multi-platform ad management',
			'Creative production',
			'Landing page design',
			'Bi-weekly reporting',
			'Priority support',
		),
		'highlight' => true,
		'order' => 2,
	),
);

foreach ($pricing_plans as $plan) {
	$post_id = wp_insert_post(array(
		'post_title'   => $plan['title'],
		'post_content' => $plan['content'],
		'post_type'    => 'pricing_plan',
		'post_status'  => 'publish',
		'menu_order'   => $plan['order'],
	));

	if ($post_id && !is_wp_error($post_id)) {
		update_field('price', $plan['price'], $post_id);
		update_field('highlight_plan', $plan['highlight'], $post_id);

		// Add features as textarea (one per line)
		$features_text = implode("\n", $plan['features']);
		update_field('features', $features_text, $post_id);

		echo '<div class="step success">✓ Created pricing plan: ' . $plan['title'] . '</div>';
	} else {
		echo '<div class="step error">✗ Failed to create pricing plan: ' . $plan['title'] . '</div>';
	}
}

// ============================================
// STEP 4: SETUP FRONT PAGE
// ============================================
echo '<h2>Step 4: Setting Up Front Page</h2>';

$front_page_id = get_option('page_on_front');

if (!$front_page_id) {
	$front_page_id = wp_insert_post(array(
		'post_title'   => 'Home',
		'post_content' => '',
		'post_type'    => 'page',
		'post_status'  => 'publish',
	));

	if ($front_page_id && !is_wp_error($front_page_id)) {
		update_option('show_on_front', 'page');
		update_option('page_on_front', $front_page_id);
		echo '<div class="step success">✓ Created and set front page</div>';
	}
} else {
	echo '<div class="step success">✓ Front page already exists</div>';
}

if ($front_page_id) {
	update_field('hero_headline', 'Accelerate Your Business Growth', $front_page_id);
	update_field('hero_subtext', 'We help businesses scale with data-driven strategies and innovative solutions.', $front_page_id);
	update_field('hero_cta_text', 'Get Started', $front_page_id);
	update_field('hero_cta_link', '#contact', $front_page_id);
	echo '<div class="step success">✓ Updated Hero section</div>';

	$about_content = '<p>At Delta Growth, we believe growth isn\'t accidental — it\'s engineered.</p>
<p>We partner with forward-thinking brands to design digital experiences that attract, convert, and scale.</p>
<p>Our team blends creative excellence with data-backed strategy to deliver consistent, measurable results.</p>';
	update_field('about_title', 'Why Choose Delta Growth', $front_page_id);
	update_field('about_content', $about_content, $front_page_id);
	echo '<div class="step success">✓ Updated About section</div>';
}

echo '<hr>';
echo '<h2 style="color: #059669;">🎉 All Content Created!</h2>';
echo '<div style="background: #D1FAE5; padding: 20px; border-radius: 8px; margin: 20px 0;">';
echo '<h3>✅ What Was Created:</h3>';
echo '<ul>';
echo '<li><strong>4 Services</strong> with icons and descriptions</li>';
echo '<li><strong>3 Testimonials</strong> with ratings</li>';
echo '<li><strong>2 Pricing Plans</strong> with features</li>';
echo '<li><strong>Front Page</strong> Hero and About sections</li>';
echo '</ul>';
echo '</div>';

echo '<div style="background: #FEF3C7; padding: 20px; border-radius: 8px;">';
echo '<h3>📋 Next Steps:</h3>';
echo '<ol>';
echo '<li><a href="' . home_url() . '" target="_blank"><strong>View your homepage</strong></a></li>';
echo '<li>Edit content in WordPress admin</li>';
echo '<li>Add featured images to services and testimonials</li>';
echo '<li><strong>⚠️ DELETE THIS FILE</strong> (create-content-only.php)</li>';
echo '</ol>';
echo '</div>';

echo '<hr>';
echo '<p style="text-align: center;">';
echo '<a href="' . admin_url() . '" style="display: inline-block; background: #38BDF8; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: 600; margin: 5px;">← WordPress Admin</a> ';
echo '<a href="' . home_url() . '" style="display: inline-block; background: #0F172A; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: 600; margin: 5px;">View Site →</a>';
echo '</p>';
echo '</div>';
?>

