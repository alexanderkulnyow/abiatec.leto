<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package LETO_STUDIO
 */

?>

<footer id="colophon" class="container-fluid bg__footer site-footer">
    <div class="container site-info">
        <div class="row">
            <div class="col-6 col-md-2">
                <div class="site-branding"><?php the_custom_logo(); ?></div>
            </div>
            <div class="col-6 col-md-2">
				<?php
				wp_nav_menu( [
					'theme_location'  => 'Primary',
					'menu'            => 'Primary',
					'container'       => 'div',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'list__none',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 0,
					'walker'          => '',
				] );
				?>
            </div>

            <div class="col-6 col-md-2">
                <div class="schedule_container">
                    <span>График работы:</span> <br>
                    <p class="schedule"> <?php echo nl2br( esc_html( get_theme_mod( 'schedule', 'текст по умолчанию' ) ) ); ?></p>
                </div>

            </div>
            <div class="col-6 col-md-3">
                <div class="timetable">
                    <span class="adress_1"><?php echo nl2br( esc_html( get_theme_mod( 'adress_1', 'текст по умолчанию' ) ) ); ?></span>
                    <br>
                    <span class="adress_2"><?php echo nl2br( esc_html( get_theme_mod( 'adress_2', 'текст по умолчанию' ) ) ); ?></span>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="timetable">
                    <div class="footer__phones">
                        <a class="phone_1"
                           href="tel:<?php echo nl2br( esc_html( get_theme_mod( 'phone_1', 'текст по умолчанию' ) ) ); ?>"><?php echo nl2br( esc_html( get_theme_mod( 'phone_1', 'текст по умолчанию' ) ) ); ?>
                            <span>MTS</span></a><br>
                        <a class="phone_2"
                           href="tel:<?php echo nl2br( esc_html( get_theme_mod( 'phone_2', 'текст по умолчанию' ) ) ); ?>"><?php echo nl2br( esc_html( get_theme_mod( 'phone_2', 'текст по умолчанию' ) ) ); ?>
                            <span>Velcom</span></a>
                    </div>
                    <div class="d-flex justify-content-start footer__social">
                        <a href="<?php echo nl2br( esc_html( get_theme_mod( 'facebook', 'текст по умолчанию' ) ) ); ?>">
                            <img width="20" height="20"
                                 src="<?php echo get_template_directory_uri() ?>/img/icons/i_fb.svg" alt="">
                        </a>
                        <a href="<?php echo nl2br( esc_html( get_theme_mod( 'instagram', 'текст по умолчанию' ) ) ); ?>">
                            <img width="20" height="20"
                                 src="<?php echo get_template_directory_uri() ?>/img/icons/i_inst.svg" alt="">
                        </a>
                        <a href="<?php echo nl2br( esc_html( get_theme_mod( 'pinterest', 'текст по умолчанию' ) ) ); ?>">
                            <img width="20" height="20"
                                 src="<?php echo get_template_directory_uri() ?>/img/icons/i_pinterest.svg"
                                 alt=""></a>
                        <a href="<?php echo nl2br( esc_html( get_theme_mod( 'WhatsApp', 'текст по умолчанию' ) ) ); ?>">
                            <img width="20" height="20"
                                 src="<?php echo get_template_directory_uri() ?>/img/icons/i_WhatsApp.svg"
                                 alt=""></a>
                    </div>
                </div>
            </div>
            <div class="navbar__contacts">
                <div class="site_social d-flex">


                </div>
            </div>
        </div>

    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
