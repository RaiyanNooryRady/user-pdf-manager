<?php

add_shortcode('user_pdfs', function () {
	if (!is_user_logged_in()) {
		return '<p>You must be logged in to view your PDFs.</p>';
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

			?>

			<div class="before-pdf-header text-light text-center py-3 mb-3">As a tempcover member enjoy a discount on policies
				lasting
				one day or more</div>
			<div class="text-light text-center py-3 mb-3">
				<a href="#" class="p-3 btn-get-quote text-decoration-none">Get a quote</a>
			</div>

			<h2 class="upm-author">Hello <?php echo esc_html($current_user->display_name) ?></h2>
			<h4 class="policy-header">My Tempcover policies</h4>
			<?php if(empty($pdf_link1 && $pdf_link2 && $pdf_link3 && $pdf_link4 && $pdf_link5 && $pdf_link6 && $pdf_link7 && $pdf_link8 && $pdf_link9 && $pdf_link10 )){ ?>
			<div class="upm-not-assigned-pdf my-3">
				<div class="card shadow">
					<h5 class="policy-header">Current & Upcoming</h5>
					<div class="no-policy text-center py-5 rounded-4">
						<img src="<?php echo plugin_dir_url(__FILE__) . '../assets/images/no-policy.svg'; ?>" class="img-no-policy"
							alt="">
						<h4 class="text-light">You have no active temporary policies</h4>
						<div class="text-light text-center py-3">
							<a href="#" class="p-3 btn-get-quote text-decoration-none">Get a quote</a>
						</div>
					</div>
					<h5 class="policy-header">Past policies</h5>
				</div>

			</div>
			<?php  } else { ?>
			<div class="upm-assigned-pdf">
				<h2 class="policy-header">Policy</h2>
				<div class="card shadow">
					<h4 class="text-light text-center">Summary</h4>
					<div class="summary-fields text-center bg-light rounded-top">
						<h5>Start Date & Time</h4>
							<p><?php echo esc_html($start_date_time); ?></p>
							<h5>End Date & Time</h5>
							<p><?php echo esc_html($end_date_time); ?></p>
					</div>
					<div class="summary-fields text-center bg-light rounded-bottom">
						<h5>Policy Status</h4>
							<?php if (!empty($policy_status) && $policy_status == 'Expired'): ?>
								<p class="policy-expired"><?php echo esc_html($policy_status); ?></p>
							<?php else: ?>
								<p class="policy-active"><?php echo esc_html($policy_status); ?></p>
							<?php endif; ?>
					</div>

				</div>

				<div class="view-documents-container mt-3">
					<button id="view-documents-btn">
						VIEW DOCUMENTS
					</button>
				</div>

				<div id="pdf-list-container" class="card shadow">
					<h4 class="text-light text-center">Policy Documents</h4>
					<div id="pdf-list" class="text-center bg-light rounded">
						<ul>
							<?php
							for ($i = 1; $i <= 10; $i++) {
								?>
								<li>
									<a href="#" class="pdf-link" data-pdf="<?php echo esc_url(${"pdf_link$i"}); ?>">
										Document <?php echo $i; ?>
									</a>
								</li>
								<?php
							}
							?>
						</ul>
					</div>

					<!-- Modal -->
					<div id="pdf-modal">
						<div class="pdf-viewer-container">
							<button id="close-modal">X</button>
							<iframe id="pdf-viewer" src="" allowfullscreen></iframe>
						</div>
					</div>

				</div>


			</div>
		<?php  } 
		}

		wp_reset_postdata();
	} else {
		return '<p>No PDFs found.</p>';
	}
});


