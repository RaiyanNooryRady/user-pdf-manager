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
			?>

			<div class="before-pdf-header text-light text-center py-3 mb-3">As a tempcover member enjoy a discount on policies lasting
				one day or more</div>

			<div class="view-documents-container">
				<button id="view-documents-btn">
					VIEW DOCUMENTS
				</button>
			</div>

			<div id="pdf-list">
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

			<script>
				document.addEventListener('DOMContentLoaded', () => {
					const viewDocumentsBtn = document.getElementById('view-documents-btn');
					const pdfList = document.getElementById('pdf-list');
					const pdfLinks = document.querySelectorAll('.pdf-link');
					const modal = document.getElementById('pdf-modal');
					const pdfViewer = document.getElementById('pdf-viewer');
					const closeModal = document.getElementById('close-modal');

					// Toggle PDF list visibility
					viewDocumentsBtn.addEventListener('click', () => {
						pdfList.style.display = pdfList.style.display === 'none' ? 'block' : 'none';
					});

					// Show modal with PDF
					pdfLinks.forEach(link => {
						link.addEventListener('click', (event) => {
							event.preventDefault();
							const pdfUrl = event.target.getAttribute('data-pdf');
							pdfViewer.src = pdfUrl;
							modal.style.display = 'flex';
						});
					});

					// Close modal
					closeModal.addEventListener('click', () => {
						modal.style.display = 'none';
						pdfViewer.src = ''; // Clear the iframe source
					});

					// Close modal when clicking outside the iframe
					modal.addEventListener('click', (event) => {
						if (event.target === modal) {
							modal.style.display = 'none';
							pdfViewer.src = '';
						}
					});
				});
			</script>
			<?php
		}

		wp_reset_postdata();
	} else {
		return '<p>No PDFs found.</p>';
	}
});


