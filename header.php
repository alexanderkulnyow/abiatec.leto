<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package LETO_STUDIO
 */

?>
    <!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <title>dlksfjsdlkf</title>
		<?php wp_head(); ?>
    </head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text"
           href="#primary"><?php esc_html_e( 'Skip to content', 'leto_studio' ); ?></a>
        <header id="masthead" class="site-header">
            <nav id="site-navigation" class="navbar navbar-expand-lg navbar-light bg-white justify-content-between">
                <div class="container">
                    <div class="row">
                        <div class="col-2 site-branding"><?php the_custom_logo(); ?></div>
                        <div class="col-8 col-lg-10 col-xl-7 offset-xl-3 navbar__contacts">
                            <div class="site_social row w-100">
                                <div class="col-3 schedule_container d-none d-lg-block p-0">
                                    <span>График работы:</span> <br>
                                    <p class="schedule"> <?php echo nl2br( esc_html( get_theme_mod( 'schedule', 'текст по умолчанию' ) ) ); ?></p>
                                </div>
                                <div class="col-5 timetable d-none d-lg-block">
                                    <span class="adress_1"><?php echo nl2br( esc_html( get_theme_mod( 'adress_1', 'текст по умолчанию' ) ) ); ?></span>
                                    <br>
                                    <span class="adress_2"><?php echo nl2br( esc_html( get_theme_mod( 'adress_2', 'текст по умолчанию' ) ) ); ?></span>
                                </div>
                                <div class="col-12 col-lg-4 timetable footer__phones">
                                    <a class="phone_1"
                                       href="tel:<?php echo nl2br( esc_html( get_theme_mod( 'phone_1', 'текст по умолчанию' ) ) ); ?>"><?php echo nl2br( esc_html( get_theme_mod( 'phone_1', 'текст по умолчанию' ) ) ); ?>
                                        <span>MTS</span>
                                        </a>
                                        <br>
                                    <a class="phone_2"
                                       href="tel:<?php echo nl2br( esc_html( get_theme_mod( 'phone_2', 'текст по умолчанию' ) ) ); ?>"><?php echo nl2br( esc_html( get_theme_mod( 'phone_2', 'текст по умолчанию' ) ) ); ?>
                                        <span>Velcom</span>
                                        </a>
                                    <div class="d-flex justify-content-start footer__social">

                                        <a href="<?php echo nl2br( esc_html( get_theme_mod( 'facebook', 'текст по умолчанию' ) ) ); ?>">
                                            <img width="20" height="20"
                                                 src="<?php echo get_template_directory_uri() ?>/img/icons/i_fb.svg"
                                                 alt="">
                                        </a>

                                        <a href="<?php echo nl2br( esc_html( get_theme_mod( 'instagram', 'текст по умолчанию' ) ) ); ?>">
                                            <img src="<?php echo get_template_directory_uri() ?>/img/icons/i_inst.svg"
                                                 width="20" height="20" alt="">
                                        </a>
                                        <a href="<?php echo nl2br( esc_html( get_theme_mod( 'pinterest', 'текст по умолчанию' ) ) ); ?>">
                                            <img width="20" height="20"
                                                 src="<?php echo get_template_directory_uri() ?>/img/icons/i_pinterest.svg"
                                                 alt="">
                                         </a>
                                        <a href="<?php echo nl2br( esc_html( get_theme_mod( 'WhatsApp', 'текст по умолчанию' ) ) ); ?>">
                                            <img width="20" height="20"
                                                 src="<?php echo get_template_directory_uri() ?>/img/icons/i_WhatsApp.svg"
                                                 alt="">
                                     </a>
                                    </div>
                                </div>
                            </div>
                        <div>
							<?php
							wp_nav_menu( [
								'theme_location'  => 'Primary',
								'menu'            => 'Primary',
								'container'       => 'div',
								'container_class' => 'collapse navbar-collapse text-right ',
								'container_id'    => 'navbarsExample07',
								'menu_class'      => 'navbar-nav mr-0 w-100 ml-0 justify-content-end',
								'menu_id'         => '',
								'echo'            => true,
								'fallback_cb'     => 'wp_page_menu',
								'before'          => '',
								'after'           => '',
								'link_before'     => '',
								'link_after'      => '',
								'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth'           => 0,
								'walker'          => new Bts_Walker_Nav_Menu(),
							] );
							?>
                        </div>

                        <div class="col-2 d-lg-none">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarsExample07"
                                    aria-controls="navbarsExample07" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>

                    </div>
                    </div>


                </div>


    </nav>

    </header>
<?php
if ( is_front_page() ) {


	$query = new WP_Query( array(
		'category_name' => 'competitions'
	) );
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			?>
            <div class="jumbotron border__none">
                <style>
                    .jumbotron {
                        background-image: url(<?php echo the_post_thumbnail_url( 'full' ); ?>) !important;
                    }
                </style>
                <div class="container px-0">
                    <div class="row">
                        <div class="col-12 col-md-6 offset-md-6 px-0">
                            <h1 class="banner_h1">
								<?php the_title(); ?>
                            </h1>
							<?php the_excerpt(); ?>
                            <!--todo разобраться с кнопкой-->
                            <a href="<?php the_permalink(); ?>">
                                <button class="btn btn-primary" type="button">Учавствовать</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

			<?php
		}
	}
}
wp_reset_postdata(); // сбрасываем переменную $post

