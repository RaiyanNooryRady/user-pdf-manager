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
	// if ($query->have_posts()) {
	// 	$output = '<div style="margin: 0; padding: 0; height: 100vh; overflow: hidden;">';
	// 	while ($query->have_posts()) {
	// 		$query->the_post();
	// 		$pdf_link = get_post_meta(get_the_ID(), 'pdf_link', true);
	// 		$output .= '<iframe src="' . esc_url($pdf_link) . '" style="width: 100%; height: 70vh; border: none;"></iframe>';
	// 	}
	// 	$output .= '</div>';
	// 	wp_reset_postdata();
	// 	return $output;
	// } else {
	// 	return '';
	// }



	// if ($query->have_posts()) {
	// 	$output = '<div style="position: relative; width: 100%; height: 100vh; background-color: #f4f4f4; overflow: hidden;">';
	// 	while ($query->have_posts()) {
	// 		$query->the_post();
	// 		$pdf_link = get_post_meta(get_the_ID(), 'pdf_link', true);

	// 		// Append PDF viewer parameters
	// 		$pdf_link .= '#zoom=150&toolbar=0&navpanes=0';

	// 		// Add iframe with styled container
	// 		$output .= '<iframe src="' . esc_url($pdf_link) . '"style="width: 95%; height: 95%; margin: 2.5%; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"
	//     	allowfullscreen></iframe>';
	// 	}
	// 	$output .= '</div>';
	// 	wp_reset_postdata();
	// 	return $output;
	// } else {
	// 	return ''; // Return nothing if no PDFs are found
	// }



	// if ($query->have_posts()) {
	// 	$output = '
	// 	<div style="position: relative; width: 100%; height: 100vh; background-color: #f4f4f4; overflow: hidden;">
	// 	';
	// 	while ($query->have_posts()) {
	// 		$query->the_post();
	// 		$pdf_link = get_post_meta(get_the_ID(), 'pdf_link', true);

	// 		// Append PDF viewer parameters
	// 		$pdf_link .= '#zoom=120&toolbar=0&navpanes=0';

	// 		// Add iframe with styled container
	// 		$output .= '
	// 			<iframe src="' . esc_url($pdf_link) . '" 
	// 				style="width: 95%; height: 95%; margin: 2.5%; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" 
	// 				allowfullscreen>
	// 			</iframe>';
	// 	}
	// 	$output .= '</div>';

	// 	// Add media queries for responsiveness
	// 	$output .= '
	// 	<style>
	// 		/* Media Query for Mobile Devices */
	// 		@media (max-width: 768px) {
	// 			iframe {
	// 				width: 100%;
	// 				height: 100%;
	// 				margin: 0;
	// 				border-radius: 0;
	// 			}
	// 		}

	// 		/* Media Query for Smaller Mobile Devices */
	// 		@media (max-width: 480px) {
	// 			iframe {
	// 				width: 100%;
	// 				height: 100%;
	// 				margin: 0;
	// 				border-radius: 0;
	// 				box-shadow: none;
	// 			}
	// 		}
	// 	</style>
	// 	';

	// 	wp_reset_postdata();
	// 	return $output;
	// } else {
	// 	return ''; // Return nothing if no PDFs are found
	// }


	// for device responsive
	// if ($query->have_posts()) {
	// 	$output = '
	// 	<div style="position: relative; width: 100%; height: 100vh; background-color: #f4f4f4; overflow: hidden;">
	// 	';
	// 	while ($query->have_posts()) {
	// 		$query->the_post();
	// 		$pdf_link = get_post_meta(get_the_ID(), 'pdf_link', true);

	// 		// Append PDF viewer parameters
	// 		$pdf_link .= '#zoom=120&toolbar=0&navpanes=0';

	// 		// Add iframe with styled container
	// 		$output .= '
	// 			<iframe src="' . esc_url($pdf_link) . '" 
	// 				style="width: 100vw; height: 100vh; border: none; margin: 0; padding: 0;" 
	// 				allowfullscreen>
	// 			</iframe>';
	// 	}
	// 	$output .= '</div>';

	// 	// Add media queries for responsiveness
	// 	$output .= '
	// 	<style>
	// 		/* Ensure no horizontal overflow on smaller screens */
	// 		body, html {
	// 			margin: 0;
	// 			padding: 0;
	// 			overflow-x: hidden;
	// 			width: 100%;
	// 			height: 100%;
	// 		}

	// 		/* Media Query for smaller mobile devices */
	// 		@media (max-width: 768px) {
	// 			iframe {
	// 				width: 100vw;
	// 				height: 100vh;
	// 				margin: 0;
	// 				padding: 0;
	// 			}
	// 		}

	// 		/* Prevent Horizontal Scroll */
	// 		@media (max-width: 480px) {
	// 			iframe {
	// 				width: 100vw;
	// 				height: 100vh;
	// 				margin: 0;
	// 				padding: 0;
	// 			}
	// 		}
	// 	</style>
	// 	';

	// 	wp_reset_postdata();
	// 	return $output;
	// } else {
	// 	return ''; // Return nothing if no PDFs are found
	// }



	// if ($query->have_posts()) {
	// 	$output = '
	// 	<div style="position: relative; width: 100%; height: 100vh; background-color: #f4f4f4; overflow: hidden;">
	// 	';
	// 	while ($query->have_posts()) {
	// 		$query->the_post();
	// 		$pdf_link = get_post_meta(get_the_ID(), 'pdf_link', true);

	// 		// Adjust zoom based on device width
	// 		if (isset($_SERVER['HTTP_USER_AGENT'])) {
	// 			$user_agent = $_SERVER['HTTP_USER_AGENT'];

	// 			// Check if the device is mobile
	// 			if (preg_match('/(iPhone|iPod|Android|BlackBerry|IEMobile)/i', $user_agent)) {
	// 				$zoom = 80; // Zoom level for mobile devices
	// 			} else {
	// 				$zoom = 120; // Zoom level for desktop devices
	// 			}
	// 		} else {
	// 			$zoom = 120; // Default zoom for desktop if no user-agent is found
	// 		}

	// 		// Append PDF viewer parameters with dynamic zoom
	// 		$pdf_link .= '#zoom=' . $zoom . '&toolbar=0&navpanes=0';

	// 		// Add iframe with styled container
	// 		$output .= '
	// 			<iframe src="' . esc_url($pdf_link) . '" 
	// 				style="width: 100vw; height: 100vh; border: none; margin: 0; padding: 0;" 
	// 				allowfullscreen>
	// 			</iframe>';
	// 	}
	// 	$output .= '</div>';

	// 	// Add media queries for responsiveness (optional, if needed)
	// 	$output .= '
	// 	<style>
	// 		/* Ensure no horizontal overflow on smaller screens */
	// 		body, html {
	// 			margin: 0;
	// 			padding: 0;
	// 			overflow-x: hidden;
	// 			width: 100%;
	// 			height: 100%;
	// 		}

	// 		/* Media Query for mobile devices */
	// 		@media (max-width: 768px) {
	// 			iframe {
	// 				width: 100vw;
	// 				height: 100vh;
	// 				margin: 0;
	// 				padding: 0;
	// 			}
	// 		}

	// 		/* Prevent Horizontal Scroll */
	// 		@media (max-width: 480px) {
	// 			iframe {
	// 				width: 100vw;
	// 				height: 100vh;
	// 				margin: 0;
	// 				padding: 0;
	// 			}
	// 		}
	// 	</style>
	// 	';

	// 	wp_reset_postdata();
	// 	return $output;
	// } else {
	// 	return ''; // Return nothing if no PDFs are found
	// }



	// if ($query->have_posts()) {
	// 	$output = '
	// 	<div id="pdf-container" style="position: relative; width: 100%; height: 100vh; background-color: #f4f4f4; overflow: hidden;">
	// 	';
	// 	while ($query->have_posts()) {
	// 		$query->the_post();
	// 		$pdf_link = get_post_meta(get_the_ID(), 'pdf_link', true);

	// 		// Append basic PDF viewer parameters (no zoom initially)
	// 		$pdf_link .= '#toolbar=0&navpanes=0';

	// 		// Add iframe with styled container
	// 		$output .= '
	// 			<iframe id="pdf-iframe" src="' . esc_url($pdf_link) . '" 
	// 				style="width: 100vw; height: 100vh; border: none; margin: 0; padding: 0;" 
	// 				allowfullscreen>
	// 			</iframe>';
	// 	}
	// 	$output .= '</div>';

	// 	// Add JavaScript to adjust zoom dynamically based on viewport width
	// 	$output .= '
	// 	<script>
	// 		function adjustPdfZoom() {
	// 			var iframe = document.getElementById("pdf-iframe");
	// 			var width = window.innerWidth; // Get the viewport width

	// 			// Define zoom levels based on viewport width
	// 			var zoomLevel;
	// 			if (width > 1600) {
	// 				zoomLevel = 150; // For large screens, higher zoom
	// 			} else if (width > 1200) {
	// 				zoomLevel = 120; // For medium screens, moderate zoom
	// 			} else if (width > 800) {
	// 				zoomLevel = 100; // For tablets, standard zoom
	// 			} else {
	// 				zoomLevel = 80; // For smaller screens, reduce zoom
	// 			}

	// 			// Set the iframe src with the dynamic zoom level
	// 			var src = iframe.src.split("#")[0]; // Remove existing zoom parameter
	// 			iframe.src = src + "#zoom=" + zoomLevel + "&toolbar=0&navpanes=0";
	// 		}

	// 		// Adjust zoom when the page loads and when the window is resized
	// 		window.onload = adjustPdfZoom;
	// 		window.onresize = adjustPdfZoom;
	// 	</script>
	// 	';

	// 	wp_reset_postdata();
	// 	return $output;
	// } else {
	// 	return ''; // Return nothing if no PDFs are found
	// }

	// if ($query->have_posts()) {
	// 	$output = '
	// 	<div id="pdf-container" style="position: relative; width: 100%; height: 100vh; background-color: #f4f4f4; overflow: hidden;">
	// 	';
	// 	while ($query->have_posts()) {
	// 		$query->the_post();
	// 		$pdf_link = get_post_meta(get_the_ID(), 'pdf_link', true);

	// 		// Append PDF viewer parameters
	// 		$pdf_link .= '#zoom=120&toolbar=0&navpanes=0';

	// 		// Add iframe with styled container
	// 		$output .= '
	// 			<iframe id="pdf-iframe" src="' . esc_url($pdf_link) . '" 
	// 				style="width: 95%; height: 95%; margin: 2.5%; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" 
	// 				allowfullscreen>
	// 			</iframe>';
	// 	}
	// 	$output .= '</div>';

	// 	// Add JavaScript to adjust zoom dynamically based on viewport width
	// 	$output .= '
	// 	<script>
	// 		function adjustPdfZoom() {
	// 			var iframe = document.getElementById("pdf-iframe");
	// 			var width = window.innerWidth; // Get the viewport width

	// 			// Define zoom levels based on viewport width
	// 			var zoomLevel;
	// 			if (width > 1600) {
	// 				zoomLevel = 150; // For large screens, higher zoom
	// 			} else if (width > 1200) {
	// 				zoomLevel = 120; // For medium screens, moderate zoom
	// 			} else if (width > 800) {
	// 				zoomLevel = 100; // For tablets, standard zoom
	// 			} else {
	// 				zoomLevel = 80; // For smaller screens, reduce zoom
	// 			}

	// 			// Set the iframe src with the dynamic zoom level
	// 			var src = iframe.src.split("#")[0]; // Remove existing zoom parameter
	// 			iframe.src = src + "#zoom=" + zoomLevel + "&toolbar=0&navpanes=0";
	// 		}

	// 		// Adjust zoom when the page loads and when the window is resized
	// 		window.onload = adjustPdfZoom;
	// 		window.onresize = adjustPdfZoom;
	// 	</script>
	// 	';

	// 	wp_reset_postdata();
	// 	return $output;
	// } else {
	// 	return ''; // Return nothing if no PDFs are found
	// }



	// if ($query->have_posts()) {
	// 	$output = '
	// 	<div id="pdf-container" style="position: relative; width: 100%; height: 100vh; background-color: #f4f4f4; overflow: hidden;">
	// 	';
	// 	while ($query->have_posts()) {
	// 		$query->the_post();
	// 		$pdf_link = get_post_meta(get_the_ID(), 'pdf_link', true);

	// 		// Append PDF viewer parameters
	// 		$pdf_link .= '#zoom=120&toolbar=0&navpanes=0';

	// 		// Add iframe with styled container
	// 		$output .= '
	// 			<iframe id="pdf-iframe" src="' . esc_url($pdf_link) . '" 
	// 				style="width: 100%; height: 100vh; border: none; margin: 0; padding: 0;" 
	// 				allowfullscreen>
	// 			</iframe>';
	// 	}
	// 	$output .= '</div>';

	// 	// Add JavaScript to adjust zoom dynamically based on viewport width
	// 	$output .= '
	// 	<script>
	// 		function adjustPdfZoom() {
	// 			var iframe = document.getElementById("pdf-iframe");
	// 			var width = window.innerWidth; // Get the viewport width

	// 			// Define zoom levels based on viewport width
	// 			var zoomLevel;
	// 			if (width > 1600) {
	// 				zoomLevel = 150; // For large screens, higher zoom
	// 			} else if (width > 1200) {
	// 				zoomLevel = 120; // For medium screens, moderate zoom
	// 			} else if (width > 800) {
	// 				zoomLevel = 100; // For tablets, standard zoom
	// 			} else {
	// 				zoomLevel = 80; // For smaller screens, reduce zoom
	// 			}

	// 			// Set the iframe src with the dynamic zoom level
	// 			var src = iframe.src.split("#")[0]; // Remove existing zoom parameter
	// 			iframe.src = src + "#zoom=" + zoomLevel + "&toolbar=0&navpanes=0";
	// 		}

	// 		// Adjust zoom when the page loads and when the window is resized
	// 		window.onload = adjustPdfZoom;
	// 		window.onresize = adjustPdfZoom;
	// 	</script>
	// 	';

	// 	wp_reset_postdata();
	// 	return $output;
	// } else {
	// 	return ''; // Return nothing if no PDFs are found
	// }


	// if ($query->have_posts()) {
	// 	$output = '<div style="margin: 0; padding: 0; height: 100vh; overflow: hidden;">'; // Container with 100vh height
	// 	while ($query->have_posts()) {
	// 		$query->the_post();
	// 		$pdf_link = get_post_meta(get_the_ID(), 'pdf_link', true);

	// 		// Append PDF viewer parameters
	// 		$pdf_link .= '#zoom=120&toolbar=0&navpanes=0';

	// 		// Add iframe with full-width and 70vh height for the PDF viewer
	// 		$output .= '<iframe src="' . esc_url($pdf_link) . '" 
	// 			style="width: 100%; height: 70vh; border: none; margin: 0; padding: 0;" 
	// 			allowfullscreen>
	// 		</iframe>';
	// 	}
	// 	$output .= '</div>';

	// 	// Add JavaScript to adjust zoom dynamically based on viewport width
	// 	$output .= '
	// 	<script>
	// 		function adjustPdfZoom() {
	// 			var iframe = document.querySelector("iframe");
	// 			var width = window.innerWidth; // Get the viewport width

	// 			// Define zoom levels based on viewport width
	// 			var zoomLevel;
	// 			if (width > 1600) {
	// 				zoomLevel = 150; // For large screens, higher zoom
	// 			} else if (width > 1200) {
	// 				zoomLevel = 120; // For medium screens, moderate zoom
	// 			} else if (width > 800) {
	// 				zoomLevel = 100; // For tablets, standard zoom
	// 			} else {
	// 				zoomLevel = 80; // For smaller screens, reduce zoom
	// 			}

	// 			// Set the iframe src with the dynamic zoom level
	// 			var src = iframe.src.split("#")[0]; // Remove existing zoom parameter
	// 			iframe.src = src + "#zoom=" + zoomLevel + "&toolbar=0&navpanes=0";
	// 		}

	// 		// Adjust zoom when the page loads and when the window is resized
	// 		window.onload = adjustPdfZoom;
	// 		window.onresize = adjustPdfZoom;
	// 	</script>
	// 	';

	// 	wp_reset_postdata();
	// 	return $output;
	// } else {
	// 	return ''; // Return nothing if no PDFs are found
	// }



	// if ($query->have_posts()) {
	// 	$output = '<div style="margin: 0; padding: 0; height: 100vh; overflow: hidden; background-color: #f4f4f4;">'; // Container with 100vh height
	// 	while ($query->have_posts()) {
	// 		$query->the_post();
	// 		$pdf_link = get_post_meta(get_the_ID(), 'pdf_link', true);

	// 		// Append PDF viewer parameters
	// 		$pdf_link .= '#zoom=120&toolbar=0&navpanes=0';

	// 		// Add iframe with styled container (border radius, box shadow, padding)
	// 		$output .= '<iframe src="' . esc_url($pdf_link) . '" 
	// 			style="width: 100%; height: 70vh; border: none; margin: 0; padding: 0; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);" 
	// 			allowfullscreen>
	// 		</iframe>';
	// 	}
	// 	$output .= '</div>';

	// 	// Add JavaScript to adjust zoom dynamically based on viewport width
	// 	$output .= '
	// 	<script>
	// 		function adjustPdfZoom() {
	// 			var iframe = document.querySelector("iframe");
	// 			var width = window.innerWidth; // Get the viewport width

	// 			// Define zoom levels based on viewport width
	// 			var zoomLevel;
	// 			if (width > 1600) {
	// 				zoomLevel = 150; // For large screens, higher zoom
	// 			} else if (width > 1200) {
	// 				zoomLevel = 120; // For medium screens, moderate zoom
	// 			} else if (width > 800) {
	// 				zoomLevel = 100; // For tablets, standard zoom
	// 			} else {
	// 				zoomLevel = 80; // For smaller screens, reduce zoom
	// 			}

	// 			// Set the iframe src with the dynamic zoom level
	// 			var src = iframe.src.split("#")[0]; // Remove existing zoom parameter
	// 			iframe.src = src + "#zoom=" + zoomLevel + "&toolbar=0&navpanes=0";
	// 		}

	// 		// Adjust zoom when the page loads and when the window is resized
	// 		window.onload = adjustPdfZoom;
	// 		window.onresize = adjustPdfZoom;
	// 	</script>
	// 	';

	// 	wp_reset_postdata();
	// 	return $output;
	// } else {
	// 	return ''; // Return nothing if no PDFs are found
	// }



	if ($query->have_posts()) {
		$output = '<div style="margin: 0; padding: 0; height: 95vh; overflow: hidden; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center;">'; // Container with 100vh height and center alignment
		while ($query->have_posts()) {
			$query->the_post();
			$pdf_link = get_post_meta(get_the_ID(), 'pdf_link', true);
			$pdf_link2= get_post_meta(get_the_ID(),'pdf_link2', true);

			// Append PDF viewer parameters
			$pdf_link .= '#zoom=120&toolbar=0&navpanes=0';
			$pdf_link2 .= '#zoom=120&toolbar=0&navpanes=0';
			// Add iframe with styled container (border radius, box shadow, padding)
			$output .= '<iframe src="' . esc_url($pdf_link) . '" 
				style="width: 100%; height: 100vh; border: none; margin: 0; padding: 0; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);" 
				allowfullscreen>
			</iframe>';
		}
		$output .= '</div>';

		// Add JavaScript to adjust zoom dynamically based on viewport width
		$output .= '
		<script>
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
		';

		wp_reset_postdata();
		return $output;
	} else {
		return ''; // Return nothing if no PDFs are found
	}





});
