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

			for($i=1;$i<=10;$i++){
				//$pdf_link1 = get_post_meta(get_the_ID(), 'pdf_link1', true);
				// Append PDF viewer parameters
				//$pdf_link1 .= '#zoom=120&toolbar=0&navpanes=0';
				${"pdf_link$i"}= get_post_meta(get_the_ID(),"pdf_link$i", true);
				${"pdf_link$i"}.='#zoom=120&toolbar=0&navpanes=0';
			}

			
			?>
			<h2 class="text-center text-danger">Hello Check</h2>
			<div style="text-align: center; margin-bottom: 20px;">
				<button id="view-documents-btn"
					style="padding: 10px 20px; font-size: 16px; background-color: transparent; font-weight:600px; color: #264694; border: 2px solid #264694; border-radius: 8px; cursor: pointer;">
					VIEW DOCUMENTS
				</button>
			</div>

			<div id="pdf-list" style="display: none; text-align: center; margin-bottom: 20px;">
				<ul style="list-style-type: none; padding: 0;">

				<?php

				for($i= 1;$i<= 10;$i++){
					
					?>
					
					<li>
						<a href="#" class="pdf-link" data-pdf="<?php echo esc_url(${"pdf_link$i"}); ?>"
							style="text-decoration: none; color: #264694;; font-size: 16px;">
							Document <?php echo $i; ?>
						</a>
					</li>
					
					<?php
				}

				?>
				</ul>
			</div>

			<div style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
				<iframe id="pdf-viewer" src=""
					style="width: 100%; height: 100vh; border: none; margin: 0; padding: 0; border-radius: 12px;" allowfullscreen>
				</iframe>
			</div>

			<script>
				// Get DOM elements
				const viewDocumentsBtn = document.getElementById('view-documents-btn');
				const pdfList = document.getElementById('pdf-list');
				const pdfLinks = document.querySelectorAll('.pdf-link');
				const pdfViewer = document.getElementById('pdf-viewer');
				pdfViewer.style.display="none";
				// Toggle PDF list visibility on button click
				viewDocumentsBtn.addEventListener('click', () => {
					pdfList.style.display = pdfList.style.display === 'none' ? 'block' : 'none';
				});

				// Update iframe source when a PDF link is clicked
				pdfLinks.forEach(link => {
					link.addEventListener('click', (event) => {
						event.preventDefault(); // Prevent default link behavior
						const pdfUrl = event.target.getAttribute('data-pdf');
						pdfViewer.style.display="block";
						pdfViewer.src = pdfUrl; // Update iframe src
					});
				});
				function adjustPdfZoom() {
					var iframe = document.querySelector("iframe");
					var width = window.innerWidth; // Get the viewport width

					// Define zoom levels based on viewport width
					var zoomLevel;
					if (width > 1600) {
						zoomLevel = 150; // For large screens, higher zoom
					} else if (width > 1200) {
						zoomLevel = 120; // For medium screens, moderate zoom
					} else if (width > 800) {
						zoomLevel = 100; // For tablets, standard zoom
					} else {
						zoomLevel = 80; // For smaller screens, reduce zoom
					}

					// Set the iframe src with the dynamic zoom level
					var src = iframe.src.split("#")[0]; // Remove existing zoom parameter
					iframe.src = src + "#zoom=" + zoomLevel + "&toolbar=0&navpanes=0";
				}

				// Adjust zoom when the page loads and when the window is resized
				window.onload = adjustPdfZoom;
				window.onresize = adjustPdfZoom;
			</script>



			<?php

		}

		// Add JavaScript to adjust zoom dynamically based on viewport width

		wp_reset_postdata();
	} else {
		return ''; // Return nothing if no PDFs are found
	}





});
