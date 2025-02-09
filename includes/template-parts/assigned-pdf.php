<div class="upm-assigned-pdf">
    <h2 class="policy-header"><?Php esc_html_e('Policies', 'user-pdf-manager') ?></h2>
    <img src="<?php echo plugins_url('user-pdf-manager/assets/images/insurance-policy.png', dirname(__DIR__, 2)); ?>" class="upm-policy-img pe-3" alt="">
    <div class="card shadow-sm">
        <h4 class="text-light text-md-center p-3 fw-bold"><?Php esc_html_e('Summary', 'user-pdf-manager') ?></h4>
        <div class="summary-fields text-md-center bg-light rounded-top p-3">
            <h5 class="text-dark"><?php echo esc_html($upm_id_number); ?></h5>
            <h5 class="fw-normal"><?php echo esc_html($upm_full_name); ?></h5>
            <div class="d-flex flex-row justify-content-md-center align-items-center">
                <h5><?Php esc_html_e('Reg:&nbsp;', 'user-pdf-manager') ?></h5>
                <h5 class="fw-normal text-dark"><?php echo esc_html($upm_registration_number); ?></h5>
            </div>
        </div>
        <div class="summary-fields text-md-center bg-light p-3">
            <h5><?Php esc_html_e('Start Date & Time', 'user-pdf-manager') ?></h5>
            <p><?php echo esc_html($start_date_time); ?></p>
            <h5><?Php esc_html_e('End Date & Time', 'user-pdf-manager') ?></h5>
            <p><?php echo esc_html($end_date_time); ?></p>
        </div>
        <div class="summary-fields text-md-center bg-light rounded-bottom p-3">
            <h5><?Php esc_html_e('Policy Status', 'user-pdf-manager') ?></h4>
                <?php if (!empty($policy_status) && $policy_status == 'Expired'): ?>
                    <h5 class="policy-expired"><?php echo esc_html($policy_status); ?></h5>
                <?php else: ?>
                    <h5 class="policy-active"><?php echo esc_html($policy_status); ?></h5>
                <?php endif; ?>
        </div>

    </div>
    <?php if ($policy_status != 'Expired'): ?>
        <div class="view-documents-container mt-3">
            <button id="view-documents-btn">
                <?Php esc_html_e('VIEW DOCUMENTS', 'user-pdf-manager') ?>
            </button>
        </div>

        <div id="pdf-list-container" class="card shadow-sm">
            <h4 class="text-light text-md-center p-3"><?Php esc_html_e('Policy Documents', 'user-pdf-manager') ?></h4>
            <div id="pdf-list" class="text-md-center bg-light rounded p-3">
                <ul>
                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                        ?>
                        <?php if ($pdf_links[$i] != ""): ?>
                            <li class="py-2">

                                <a href="#" class="pdf-link bi bi-file-earmark-pdf-fill"
                                    data-pdf="<?php echo esc_url($pdf_links[$i]); ?>">
                                    <?php
                                    $document_text = basename($pdf_links[$i]);
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
                    <button id="close-modal"><?php echo esc_html('X'); ?></button>
                    <iframe id="pdf-viewer" src="" allowfullscreen></iframe>
                </div>
            </div>

        </div>
    <?php endif; ?>
</div>