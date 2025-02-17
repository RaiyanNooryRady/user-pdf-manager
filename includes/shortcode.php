<?php

add_shortcode('user_pdfs', function () {
	if (!is_user_logged_in()) {
		@include plugin_dir_path(__FILE__) . 'template-parts/not-assigned-pdf.php' ?: 'Template file not found!';
		return '<h4 class="text-center py-2 fw-bold">You must be logged in to view your PDFs.</h4>';
	}

	$current_user = wp_get_current_user();
	$args = [
		'post_type' => 'user_pdfs',
		'meta_query' => [
			[
				'key' => 'username',
				'value' => $current_user->user_login,
				'compare' => '='
			]
		]
	];
	$query = new WP_Query($args);

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();

			for ($i = 1; $i <= 10; $i++) {
				${"pdf_link$i"} = get_post_meta(get_the_ID(), "pdf_link$i", true);
				${"pdf_link$i"} .= '#zoom=120&toolbar=0&navpanes=0';
			}
			$policy_status = get_post_meta(get_the_ID(), 'policy_status', true);
			$upm_id_number = get_post_meta(get_the_ID(), 'upm_id_number', true);
			$upm_full_name = get_post_meta(get_the_ID(), 'upm_full_name', true);
			$upm_registration_number = get_post_meta(get_the_ID(), 'upm_registration_number', true);

			$start_date_time = get_post_meta(get_the_ID(), 'start_date_time', true);

			// Convert to DateTime object
			$date = new DateTime($start_date_time);

			// Format to desired output
			$start_date_time = $date->format('d-m-Y h:i A');

			$end_date_time = get_post_meta(get_the_ID(), 'end_date_time', true);
			// Convert to DateTime object
			$date = new DateTime($end_date_time);

			// Format to desired output
			$end_date_time = $date->format('d-m-Y h:i A');

			@include plugin_dir_path(__FILE__) . 'template-parts/hello-author.php' ?: 'Template file not found!';

			$check_not_assigned = $pdf_link1 == "#zoom=120&toolbar=0&navpanes=0" && $pdf_link2 == "#zoom=120&toolbar=0&navpanes=0" && $pdf_link3 == "#zoom=120&toolbar=0&navpanes=0" && $pdf_link4 == "#zoom=120&toolbar=0&navpanes=0" && $pdf_link5 == "#zoom=120&toolbar=0&navpanes=0" && $pdf_link6 == "#zoom=120&toolbar=0&navpanes=0" && $pdf_link7 == "#zoom=120&toolbar=0&navpanes=0" && $pdf_link8 == "#zoom=120&toolbar=0&navpanes=0" && $pdf_link9 == "#zoom=120&toolbar=0&navpanes=0" && $pdf_link10 == "#zoom=120&toolbar=0&navpanes=0";

			if ($check_not_assigned) {
				@include plugin_dir_path(__FILE__) . 'template-parts/not-assigned-pdf.php' ?: 'Template file not found!';
			} else {
				@include plugin_dir_path(__FILE__) . 'template-parts/assigned-pdf.php' ?: 'Template file not found!';
			}
		}

		wp_reset_postdata();
	} else {

		@include plugin_dir_path(__FILE__) . 'template-parts/hello-author.php' ?: 'Template file not found!';
		@include plugin_dir_path(__FILE__) . 'template-parts/not-assigned-pdf.php' ?: 'Template file not found!';

	}
});


