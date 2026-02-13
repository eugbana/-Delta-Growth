<?php
/**
 * Content Setup Script - Run this once to populate the site with initial content
 * 
 * INSTRUCTIONS:
 * 1. Upload this file to your theme directory
 * 2. Visit: yoursite.com/wp-content/themes/delta-growth/setup-content.php
 * 3. Delete this file after running it once
 *
 * @package Delta_Growth
 */

// Load WordPress - try multiple possible paths
$wp_load_paths = array(
	'../../../../../wp-load.php',  // Standard: wp-content/themes/theme-name/
	'../../../../../../wp-load.php', // If in subdirectory
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

// If standard paths don't work, try to find wp-load.php by going up directories
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
	die('ERROR: Could not locate wp-load.php. Please make sure this file is in your theme directory.');
}

// Check if user is admin
if (!current_user_can('manage_options')) {
	wp_die('You do not have permission to access this page.');
}

echo '<h1>Delta Growth - Content Setup</h1>';
echo '<p>Setting up your content...</p>';

// ============================================
// 1. CREATE SERVICES
// ============================================
echo '<h2>Creating Services...</h2>';

$services = array(
	array(
		'title' => 'Digital Strategy',
		'content' => 'We audit, position, and build scalable marketing frameworks that align with your business goals.',
		'short_description' => 'We audit, position, and build scalable marketing frameworks that align with your business goals.',
		'icon_class' => 'fas fa-chart-line',
		'features' => array('Market research', 'Funnel design', 'Customer journey mapping', 'Conversion optimisation'),
	),
	array(
		'title' => 'Paid Media & Advertising',
		'content' => 'ROI-focused advertising campaigns across Google, Meta, LinkedIn, and TikTok.',
		'short_description' => 'ROI-focused advertising campaigns across Google, Meta, LinkedIn, and TikTok.',
		'icon_class' => 'fas fa-bullhorn',
		'features' => array('PPC Campaign Management', 'Retargeting Systems', 'Creative Ad Testing', 'Budget Optimisation'),
	),
	array(
		'title' => 'Website Design & Development',
		'content' => 'High-performance websites built to convert visitors into clients.',
		'short_description' => 'High-performance websites built to convert visitors into clients.',
		'icon_class' => 'fas fa-laptop-code',
		'features' => array('UX/UI Design', 'WordPress Development', 'Landing Pages', 'Speed & SEO Optimisation'),
	),
	array(
		'title' => 'Content & Creative',
		'content' => 'Strategic content that builds brand authority and drives engagement.',
		'short_description' => 'Strategic content that builds brand authority and drives engagement.',
		'icon_class' => 'fas fa-pen-fancy',
		'features' => array('Social Media Strategy', 'Email Campaigns', 'Video Ads', 'Conversion Copywriting'),
	),
);

foreach ($services as $index => $service) {
	// Build full content with features
	$full_content = $service['content'] . "\n\n<h3>What's Included:</h3>\n<ul>";
	foreach ($service['features'] as $feature) {
		$full_content .= "\n<li>" . $feature . "</li>";
	}
	$full_content .= "\n</ul>";

	$post_id = wp_insert_post(array(
		'post_title'   => $service['title'],
		'post_content' => $full_content,
		'post_type'    => 'service',
		'post_status'  => 'publish',
		'menu_order'   => $index + 1,
	));

	if ($post_id && function_exists('update_field')) {
		update_field('short_description', $service['short_description'], $post_id);
		update_field('icon_class', $service['icon_class'], $post_id);
		echo "✓ Created service: {$service['title']}<br>";
	} else {
		echo "✗ Failed to create service: {$service['title']}<br>";
	}
}

// ============================================
// 2. CREATE TESTIMONIALS
// ============================================
echo '<h2>Creating Testimonials...</h2>';

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

	if ($post_id && function_exists('update_field')) {
		update_field('client_company', $testimonial['company'], $post_id);
		update_field('rating', $testimonial['rating'], $post_id);
		echo "✓ Created testimonial: {$testimonial['client_name']}<br>";
	} else {
		echo "✗ Failed to create testimonial: {$testimonial['client_name']}<br>";
	}
}

// ============================================
// 3. CREATE PRICING PLANS
// ============================================
echo '<h2>Creating Pricing Plans...</h2>';

$pricing_plans = array(
	array(
		'title' => 'Growth Starter',
		'content' => 'Ideal for early-stage brands ready to scale.',
		'price' => '£1,200 / month',
		'features' => array(
			'Strategy session',
			'Website optimisation',
			'1 ad platform management',
			'Monthly reporting',
			'Email support',
		),
		'highlight' => false,
		'menu_order' => 1,
	),
	array(
		'title' => 'Growth Accelerator',
		'content' => 'For scaling businesses seeking aggressive growth.',
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
		'menu_order' => 2,
	),
);

foreach ($pricing_plans as $plan) {
	$post_id = wp_insert_post(array(
		'post_title'   => $plan['title'],
		'post_content' => $plan['content'],
		'post_type'    => 'pricing_plan',
		'post_status'  => 'publish',
		'menu_order'   => $plan['menu_order'],
	));

	if ($post_id && function_exists('update_field')) {
		update_field('price', $plan['price'], $post_id);
		update_field('highlight_plan', $plan['highlight'], $post_id);

		// Add features as repeater
		$features_data = array();
		foreach ($plan['features'] as $feature) {
			$features_data[] = array('feature_text' => $feature);
		}
		update_field('features', $features_data, $post_id);

		echo "✓ Created pricing plan: {$plan['title']}<br>";
	} else {
		echo "✗ Failed to create pricing plan: {$plan['title']}<br>";
	}
}

// ============================================
// 4. UPDATE FRONT PAGE ACF FIELDS
// ============================================
echo '<h2>Updating Front Page...</h2>';

// Get or create front page
$front_page_id = get_option('page_on_front');

if (!$front_page_id) {
	// Create a front page
	$front_page_id = wp_insert_post(array(
		'post_title'   => 'Home',
		'post_content' => '',
		'post_type'    => 'page',
		'post_status'  => 'publish',
	));

	// Set as front page
	update_option('show_on_front', 'page');
	update_option('page_on_front', $front_page_id);

	echo "✓ Created and set front page<br>";
}

if ($front_page_id && function_exists('update_field')) {
	// Hero Section
	update_field('hero_headline', 'Accelerate Your Business Growth', $front_page_id);
	update_field('hero_subtext', 'We help businesses scale with data-driven strategies and innovative solutions.', $front_page_id);
	update_field('hero_cta_text', 'Get Started', $front_page_id);
	update_field('hero_cta_link', '#contact', $front_page_id);

	// About Section
	update_field('about_title', 'Why Choose Delta Growth', $front_page_id);
	$about_content = '<p>At Delta Growth, we believe growth isn\'t accidental — it\'s engineered.</p>
<p>We partner with forward-thinking brands to design digital experiences that attract, convert, and scale.</p>
<p>Our team blends creative excellence with data-backed strategy to deliver consistent, measurable results.</p>';
	update_field('about_content', $about_content, $front_page_id);

	echo "✓ Updated front page ACF fields<br>";
}

echo '<hr>';
echo '<h2 style="color: green;">✓ Setup Complete!</h2>';
echo '<p><strong>Next Steps:</strong></p>';
echo '<ol>';
echo '<li>Visit your <a href="' . home_url() . '" target="_blank">homepage</a> to see the results</li>';
echo '<li>Go to <strong>Services</strong> in WordPress admin to edit services</li>';
echo '<li>Go to <strong>Testimonials</strong> to edit testimonials</li>';
echo '<li>Go to <strong>Pricing Plans</strong> to edit pricing</li>';
echo '<li><strong>DELETE THIS FILE</strong> (setup-content.php) for security</li>';
echo '</ol>';
echo '<hr>';
echo '<p><a href="' . admin_url() . '">← Back to WordPress Admin</a></p>';
?>
