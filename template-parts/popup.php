<div class="popup_overlay">
    <div class="modal" id="popUp">
        <figure class="popup_header">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/popup_header.png" alt="popup_header">
        </figure>

        <div class="popup_details">
            <?php
            // Insertion du formulaire de contact
            echo do_shortcode('[contact-form-7 id="fb3ee62" title="Formulaire de contact"]');
            ?>
        </div>
    </div>
</div>