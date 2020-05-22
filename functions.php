<?php
/**
 * LETO_STUDIO functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package LETO_STUDIO
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'leto_studio_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function leto_studio_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on LETO_STUDIO, use a find and replace
		 * to change 'leto_studio' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'leto_studio', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'leto_studio' ),
				'menu-2' => esc_html__( 'Footer', 'leto_studio' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'leto_studio_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 160,
				'width'       => 160,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'leto_studio_setup' );

/**
 * Register Custom Navigation Walker
 */
function register_navwalker() {
	require_once get_template_directory() . '/inc/Bts_Walker_Nav_Menu.php';
}

add_action( 'after_setup_theme', 'register_navwalker' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function leto_studio_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'leto_studio_content_width', 640 );
}

add_action( 'after_setup_theme', 'leto_studio_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function leto_studio_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'leto_studio' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'leto_studio' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'leto_studio_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function leto_studio_scripts() {
	wp_enqueue_style( 'leto_studio-fonts', 'https://fonts.googleapis.com/css2?family=Arsenal:wght@400;700&amp;display=swap', _S_VERSION );
	wp_enqueue_style( 'leto_studio-bootstrap', get_template_directory_uri() . '/libs/bootstrap-4.5.0-dist/css/bootstrap.min.css', _S_VERSION );
	wp_enqueue_style( 'leto_studio-slick', get_template_directory_uri() . '/libs/slick-1.8.1/slick/slick.css', _S_VERSION );
	wp_enqueue_style( 'leto_studio-slick-theme', get_template_directory_uri() . '/libs/slick-1.8.1/slick/slick-theme.css', _S_VERSION );
	wp_enqueue_style( 'leto_studio-style', get_stylesheet_uri(), array(), _S_VERSION );

	wp_style_add_data( 'leto_studio-style', 'rtl', 'replace' );

	wp_enqueue_script('jquery');
	wp_enqueue_script( 'leto_studio-bootstrap', get_template_directory_uri() . '/libs/bootstrap-4.5.0-dist/js/bootstrap.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'leto_studio-slick', get_template_directory_uri() . '/libs/slick-1.8.1/slick/slick.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'leto_studio-slick-custom', get_template_directory_uri() . '/js/slick_custom.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'leto_studio-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'leto_studio-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'leto_studio_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

require_once get_template_directory() . '/inc/metaboxes.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_filter( 'init', 'post_type_courses_register' );
function post_type_courses_register() {
	$labels = array(
		'name'               => 'Курсы',
		'singular_name'      => 'Курс', // админ панель Добавить->Функцию
		'add_new'            => 'Добавить курс',
		'add_new_item'       => 'Добавить новый курс', // заголовок тега <title>
		'edit_item'          => 'Редактировать курс',
		'new_item'           => 'Новый курс',
		'all_items'          => 'Курсы',
		'view_item'          => 'Просмотр курсы на сайте',
		'search_items'       => 'Искать курс',
		'not_found'          => 'Курс не найдено.',
		'not_found_in_trash' => 'В корзине нет курсов',
		'menu_name'          => 'Курсы' // ссылка в меню в админке
	);
	$args   = array(
		'labels'            => $labels,
		'rewrite'           => array( 'slug' => 'courses' ),
		'public'            => true, // благодаря этому некоторые параметры можно пропустить
		'show_in_nav_menus' => true,
		'show_in_rest'      => true,
		'rest_base'         => null,
		'menu_icon'         => 'dashicons-welcome-learn-more',
		'menu_position'     => 5,
		'has_archive'       => true,
		'supports'          => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'taxonomies'        => array( '' )
	);
	register_post_type( 'courses', $args );
}

class MetaBoxes {
	function __construct($options) {
		$this->options = $options;
		$this->prefix = $this->options['id'] .'_';
		add_action( 'add_meta_boxes', array( &$this, 'create' ) );
		add_action( 'save_post', array( &$this, 'save' ), 1, 2 );
	}
	function create() {
		foreach ($this->options['post'] as $post_type) {
			if (current_user_can( $this->options['cap'])) {
				add_meta_box($this->options['id'], $this->options['name'], array(&$this, 'fill'), $post_type, $this->options['pos'], $this->options['pri']);
			}
		}
	}
	function fill(){
		global $post; $p_i_d = $post->ID;
		wp_nonce_field( $this->options['id'], $this->options['id'].'_wpnonce', false, true );
		?>
        <table class="form-table"><tbody><?php
		foreach ( $this->options['args'] as $param ) {
			if (current_user_can( $param['cap'])) {
				?><tr><?php
				if(!$value = get_post_meta($post->ID, $this->prefix .$param['id'] , true)) $value = $param['std'];
				switch ( $param['type'] ) {
					case 'text':{ ?>
                        <th scope="row"><label for="<?php echo $this->prefix .$param['id'] ?>"><?php echo $param['title'] ?></label></th>
                        <td>
                            <input name="<?php echo $this->prefix .$param['id'] ?>" type="<?php echo $param['type'] ?>" id="<?php echo $this->prefix .$param['id'] ?>" value="<?php echo $value ?>" placeholder="<?php echo $param['placeholder'] ?>" class="regular-text" /><br />
                            <span class="description"><?php echo $param['desc'] ?></span>
                        </td>
						<?php
						break;
					}
					case 'textarea':{ ?>
                        <th scope="row"><label for="<?php echo $this->prefix .$param['id'] ?>"><?php echo $param['title'] ?></label></th>
                        <td>
                            <textarea name="<?php echo $this->prefix .$param['id'] ?>" type="<?php echo $param['type'] ?>" id="<?php echo $this->prefix .$param['id'] ?>" value="<?php echo $value ?>" placeholder="<?php echo $param['placeholder'] ?>" class="large-text" /><?php echo $value ?></textarea><br />
                            <span class="description"><?php echo $param['desc'] ?></span>
                        </td>
						<?php
						break;
					}
					case 'checkbox':{ ?>
                        <th scope="row"><label for="<?php echo $this->prefix .$param['id'] ?>"><?php echo $param['title'] ?></label></th>
                        <td>
                            <label for="<?php echo $this->prefix .$param['id'] ?>"><input name="<?php echo $this->prefix .$param['id'] ?>" type="<?php echo $param['type'] ?>" id="<?php echo $this->prefix .$param['id'] ?>"<?php echo ($value=='on') ? ' checked="checked"' : '' ?> />
								<?php echo $param['desc'] ?></label>
                        </td>
						<?php
						break;
					}
					case 'select':{ ?>
                        <th scope="row"><label for="<?php echo $this->prefix .$param['id'] ?>"><?php echo $param['title'] ?></label></th>
                        <td>
                            <label for="<?php echo $this->prefix .$param['id'] ?>">
                                <select name="<?php echo $this->prefix .$param['id'] ?>" id="<?php echo $this->prefix .$param['id'] ?>"><?php
									foreach($param['args'] as $val=>$name){
										?><option value="<?php echo $val ?>"<?php echo ( $value == $val ) ? ' selected="selected"' : '' ?>><?php echo $name ?></option><?php
									}
									?></select></label><br />
                            <span class="description"><?php echo $param['desc'] ?></span>
                        </td>
						<?php
						break;
					}
				}
				?></tr><?php
			}
		}
		?></tbody></table><?php
	}
	function save($post_id, $post){
		if ( !wp_verify_nonce( $_POST[ $this->options['id'].'_wpnonce' ], $this->options['id'] ) ) return;
		if ( !current_user_can( 'edit_post', $post_id ) ) return;
		if ( !in_array($post->post_type, $this->options['post'])) return;
		foreach ( $this->options['args'] as $param ) {
			if ( current_user_can( $param['cap'] ) ) {
				if ( isset( $_POST[ $this->prefix . $param['id'] ] ) && trim( $_POST[ $this->prefix . $param['id'] ] ) ) {
					update_post_meta( $post_id, $this->prefix . $param['id'], trim($_POST[ $this->prefix . $param['id'] ]) );
				} else {
					delete_post_meta( $post_id, $this->prefix . $param['id'] );
				}
			}
		}
	}
}

$options = array(
	array( // первый метабокс
		'id'	=>	'meta', // ID метабокса, а также префикс названия произвольного поля
		'name'	=>	'Настройка вывода заголовка', // заголовок метабокса
		'post'	=>	array('courses'), // типы постов для которых нужно отобразить метабокс
		'pos'	=>	'normal', // расположение, параметр $context функции add_meta_box()
		'pri'	=>	'high', // приоритет, параметр $priority функции add_meta_box()
		'cap'	=>	'edit_posts', // какие права должны быть у пользователя
		'args'	=>	array(


			array(
				'id'			=>	'select',
				'title'			=>	'Расположение заголовка',
				'type'			=>	'select', // выпадающий список
				'desc'			=>	'',
				'cap'			=>	'edit_posts',
				'args'			=>	array('top__left' => 'top__left', 'top__right' => 'top__right', 'bottom__left' => 'bottom__left', 'bottom__right' => 'bottom__right')
			)
		)
	),

);

foreach ($options as $option) {
	$metaboxes = new MetaBoxes($option);
}



function leto_studio_pages() {
	$new_page_title = 'О школе';
	$new_page = array(
		'ID' => 999,
		'post_type' => 'page',
		'post_title' => $new_page_title,
		'post_status' => 'publish',
		'post_author' => 1,
	);
	wp_insert_post($new_page);
}
add_action('init', 'leto_studio_pages');


require_once( ABSPATH . '/wp-admin/includes/taxonomy.php' );

$cat_staff = array(
	'cat_name'             => 'Наши преподаватели',
	'category_description' => '',
	'category_nicename'    => 'staff'
);

$cat_concerts     = array(
	'cat_name'             => 'Наши концерты',
	'category_description' => '',
	'category_nicename'    => 'concerts'
);
$cat_competitions = array(
	'cat_name'             => 'Наши конкурсы',
	'category_description' => '',
	'category_nicename'    => 'competitions'
);

$cat_gallery = array(
	'cat_name'             => 'Галерея',
	'category_description' => '',
	'category_nicename'    => 'gallery'
);
$cat_results = array(
	'cat_name'             => 'Итоги конкурсов',
	'category_description' => '',
	'category_nicename'    => 'results'
);

wp_insert_category( $cat_staff );
wp_insert_category( $cat_concerts );
wp_insert_category( $cat_competitions );
wp_insert_category( $cat_gallery );
wp_insert_category( $cat_results );
