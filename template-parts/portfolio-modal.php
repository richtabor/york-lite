<?php
/**
 * The template used for displaying page content
 *
 * @package York
 */ 

if ( get_theme_mod( 'york_portfolio_modal' ) ) : ?>

    <div id="modal" class="modal">
        <div id="modal-content" class="modal-content"></div>
        
        <div id="close-button" class="button--close">
            <span></span>
            <span></span>
        </div>

        <div id="modal-close" class="nav-close-overlay"></div>
    </div>

    <div id="loading" class="loading"></div>
    <div id="loading-body" class="loading loading--body"></div>

<?php endif;