<?php
/**
 * Testimonials Diagnostic Test
 * 
 * This file helps diagnose testimonial display issues
 * Visit: yoursite.com/wp-content/themes/delta-growth/test-testimonials.php
 * 
 * @package Delta_Growth
 */

// Load WordPress
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

echo '<style>
body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; padding: 40px; background: #f0f0f1; }
.container { max-width: 1000px; margin: 0 auto; background: white; padding: 40px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
h1 { color: #0F172A; border-bottom: 3px solid #38BDF8; padding-bottom: 10px; }
h2 { color: #38BDF8; margin-top: 30px; }
.success { color: #059669; }
.error { color: #DC2626; }
.warning { color: #D97706; }
.info { background: #EFF6FF; padding: 15px; margin: 10px 0; border-left: 4px solid #3B82F6; }
.test-item { background: #f8fafc; padding: 15px; margin: 10px 0; border-left: 4px solid #38BDF8; }
table { width: 100%; border-collapse: collapse; margin: 20px 0; }
th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb; }
th { background: #f9fafb; font-weight: 600; }
.star { color: #f59e0b; }
</style>';

echo '<div class="container">';
echo '<h1>🔍 Testimonials Diagnostic Test</h1>';
echo '<p>This page tests if testimonials are set up correctly.</p>';
echo '<hr>';

// Test 1: Check if testimonial post type exists
echo '<h2>Test 1: Testimonial Post Type</h2>';
if (post_type_exists('testimonial')) {
	echo '<div class="test-item success">✓ Testimonial post type exists</div>';
} else {
	echo '<div class="test-item error">✗ Testimonial post type does NOT exist</div>';
}

// Test 2: Check if ACF is active
echo '<h2>Test 2: ACF Plugin</h2>';
if (function_exists('get_field')) {
	echo '<div class="test-item success">✓ ACF plugin is active</div>';
} else {
	echo '<div class="test-item error">✗ ACF plugin is NOT active</div>';
}

// Test 3: Count testimonials
echo '<h2>Test 3: Testimonial Posts</h2>';
$testimonials_query = new WP_Query(array(
	'post_type' => 'testimonial',
	'posts_per_page' => -1,
	'post_status' => 'publish',
));

$count = $testimonials_query->found_posts;
if ($count > 0) {
	echo '<div class="test-item success">✓ Found ' . $count . ' published testimonial(s)</div>';
} else {
	echo '<div class="test-item warning">⚠ No published testimonials found</div>';
	echo '<div class="info">Run the create-content-only.php script to create testimonials.</div>';
}

// Test 4: Display testimonial data
if ($count > 0) {
	echo '<h2>Test 4: Testimonial Data</h2>';
	echo '<table>';
	echo '<thead><tr><th>Title</th><th>Content</th><th>Company</th><th>Rating</th><th>Status</th></tr></thead>';
	echo '<tbody>';
	
	while ($testimonials_query->have_posts()) {
		$testimonials_query->the_post();
		$company = delta_growth_get_testimonial_company();
		$rating = delta_growth_get_testimonial_rating();
		$content = get_the_content();
		
		echo '<tr>';
		echo '<td><strong>' . get_the_title() . '</strong></td>';
		echo '<td>' . wp_trim_words($content, 10) . '</td>';
		echo '<td>' . ($company ? esc_html($company) : '<span class="error">Missing</span>') . '</td>';
		echo '<td>';
		for ($i = 1; $i <= 5; $i++) {
			if ($i <= $rating) {
				echo '<span class="star">★</span>';
			} else {
				echo '<span>☆</span>';
			}
		}
		echo ' (' . $rating . '/5)</td>';
		echo '<td class="success">✓ OK</td>';
		echo '</tr>';
	}
	
	echo '</tbody></table>';
	wp_reset_postdata();
}

// Test 5: Check helper functions
echo '<h2>Test 5: Helper Functions</h2>';
if (function_exists('delta_growth_get_testimonial_company')) {
	echo '<div class="test-item success">✓ delta_growth_get_testimonial_company() exists</div>';
} else {
	echo '<div class="test-item error">✗ delta_growth_get_testimonial_company() missing</div>';
}

if (function_exists('delta_growth_get_testimonial_rating')) {
	echo '<div class="test-item success">✓ delta_growth_get_testimonial_rating() exists</div>';
} else {
	echo '<div class="test-item error">✗ delta_growth_get_testimonial_rating() missing</div>';
}

echo '<hr>';
echo '<h2>✅ Diagnostic Complete</h2>';
echo '<div class="info">';
echo '<h3>Next Steps:</h3>';
echo '<ul>';
echo '<li><a href="' . home_url() . '" target="_blank">View your homepage</a> to see testimonials slider</li>';
echo '<li><a href="' . admin_url('edit.php?post_type=testimonial') . '" target="_blank">Edit testimonials</a> in WordPress admin</li>';
echo '<li><a href="' . get_post_type_archive_link('testimonial') . '" target="_blank">View testimonials archive</a></li>';
echo '<li><strong>DELETE THIS FILE</strong> (test-testimonials.php) after testing</li>';
echo '</ul>';
echo '</div>';

echo '</div>';
?>

