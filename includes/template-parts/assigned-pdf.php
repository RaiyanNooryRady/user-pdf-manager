<div class="upm-assigned-pdf">
    <h2 class="policy-header"><?Php esc_html_e('Policies', 'user-pdf-manager') ?></h2>
    <div class="card shadow-sm">
        <h4 class="text-light text-center py-2 fw-bold"><?Php esc_html_e('Summary', 'user-pdf-manager') ?></h4>
        <div class="summary-fields text-center bg-light rounded-top py-3">
            <h5><?Php esc_html_e('ID Number', 'user-pdf-manager') ?></h5>
            <p><?php echo esc_html($upm_id_number); ?></p>
            <h5><?Php esc_html_e('Full Name', 'user-pdf-manager') ?></h5>
            <p><?php echo esc_html($upm_full_name); ?></p>
            <h5><?Php esc_html_e('Registration Number', 'user-pdf-manager') ?></h5>
            <p><?php echo esc_html($upm_registration_number); ?></p>
        </div>
        <div class="summary-fields text-center bg-light py-3">
            <h5><?Php esc_html_e('Start Date & Time', 'user-pdf-manager') ?></h5>
            <p><?php echo esc_html($start_date_time); ?></p>
            <h5><?Php esc_html_e('End Date & Time', 'user-pdf-manager') ?></h5>
            <p><?php echo esc_html($end_date_time); ?></p>
        </div>
        <div class="summary-fields text-center bg-light rounded-bottom py-3">
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
            <h4 class="text-light text-center py-2"><?Php esc_html_e('Policy Documents', 'user-pdf-manager') ?></h4>
            <div id="pdf-list" class="text-center bg-light rounded py-3">
                <ul>
                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                        ?>
                        <?php if (${"pdf_link$i"} != "#zoom=120&toolbar=0&navpanes=0"): ?>
                            <li class="py-2">

                                <a href="#" class="pdf-link bi bi-file-earmark-pdf-fill"
                                    data-pdf="<?php echo esc_url(${"pdf_link$i"}); ?>">
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
                    <button id="close-modal"><?php echo esc_html('X'); ?></button>
                    <iframe id="pdf-viewer" src="" allowfullscreen></iframe>
                </div>
            </div>

        </div>
    <?php endif; ?>
</div>