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
			} else { ?>
				<div class="upm-assigned-pdf">
					<h2 class="policy-header">Policy</h2>
					<div class="card shadow">
						<h4 class="text-light text-center py-2 fw-bold">Summary</h4>
						<div class="summary-fields text-center bg-light rounded-top py-3">
							<h5>Start Date & Time</h4>
								<p><?php echo esc_html($start_date_time); ?></p>
								<h5>End Date & Time</h5>
								<p><?php echo esc_html($end_date_time); ?></p>
						</div>
						<div class="summary-fields text-center bg-light rounded-bottom py-3">
							<h5>Policy Status</h4>
								<?php if (!empty($policy_status) && $policy_status == 'Expired'): ?>
									<p class="policy-expired"><?php echo esc_html($policy_status); ?></p>
								<?php else: ?>
									<p class="policy-active"><?php echo esc_html($policy_status); ?></p>
								<?php endif; ?>
						</div>

					</div>
					<?php if ($policy_status != 'Expired'): ?>
						<div class="view-documents-container mt-3">
							<button id="view-documents-btn">
								VIEW DOCUMENTS
							</button>
						</div>

						<div id="pdf-list-container" class="card shadow">
							<h4 class="text-light text-center py-2">Policy Documents</h4>
							<div id="pdf-list" class="text-center bg-light rounded py-3">
								<ul>
									<?php
									for ($i = 1; $i <= 10; $i++) {
										?>
										<?php if(${"pdf_link$i"}!="#zoom=120&toolbar=0&navpanes=0"): ?>
										<li class="py-2">
											
											<a href="#" class="pdf-link bi bi-file-earmark-pdf-fill" data-pdf="<?php echo esc_url(${"pdf_link$i"}); ?>">
												<?php
												$document_text = basename(${"pdf_link$i"});
												$document_text = explode('#', $document_text)[0];
												echo $document_text;

												?>
											</a>
										</li>
										<?php
										endif;
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
					<?php endif; ?>
				</div>
			<?php }
		}

		wp_reset_postdata();
	} else {

		@include plugin_dir_path(__FILE__) . 'template-parts/hello-author.php' ?: 'Template file not found!';
		@include plugin_dir_path(__FILE__) . 'template-parts/not-assigned-pdf.php' ?: 'Template file not found!';

	}
});


