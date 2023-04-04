<div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="login-modal" aria-hidden="true">

    <div class="modal-dialog">

        <div class="login-section modal-section">
            <?php get_template_part( 'partials/members/login' ); ?>
        </div>
        <!-- .login-section -->

        <div class="password-section modal-section">
            <?php get_template_part( 'partials/members/reset-password' ); ?>
        </div>
        <!-- .password-reset-section -->

        <?php
        if( get_option( 'users_can_register' ) ) :
            ?>
            <div class="register-section modal-section">
                <?php get_template_part( 'partials/members/register' ); ?>
            </div>
            <!-- .register-section -->
            <?php
        endif;
        ?>

    </div>
    <!-- .modal-dialog -->

</div><!-- .modal -->

<script>
    (function ($) {
        "use strict";

        /**
         * Modal dialog for Login and Register
         */
        var loginModal = $('#login-modal'),
            modalSections = loginModal.find('.modal-section');

        $('.activate-section').on('click', function (event) {
            var targetSection = $(this).data('section');
            modalSections.slideUp();
            loginModal.find('.' + targetSection).slideDown();
            event.preventDefault();
        });

    })(jQuery);
</script>