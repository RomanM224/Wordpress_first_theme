<?php

add_action('wp_enqueue_scripts', 'style_theme');
add_action('wp_footer', 'scripts_theme');
add_action('after_setup_theme', 'theme_register_nav_menu');
add_action('widgets_init', 'register_my_widgets');
add_action('init', 'register_my_post_type');
add_action( 'init', 'create_taxonomy' );

add_action('wp_ajax_send_mail', 'send_mail');
add_action('wp_ajax_nopriv_send_mail', 'send_mail');

function send_mail(){
    $contactName = $_POST['contactName'];
    $contactEmail = $_POST['contactEmail'];
    $contactSubject = $_POST['contactSubject'];
    $contactMessage = $_POST['contactMessage'];

    // подразумевается что $to, $subject, $message уже определены...
    //$to = get_option('admin_email');
    $to = $contactEmail;
    
// удалим фильтры, которые могут изменять заголовок $headers
// remove_all_filters( 'wp_mail_from' );
// remove_all_filters( 'wp_mail_from_name' );

$headers = array(
	'From: Me Myself <me@example.net>',
	'content-type: text/html',
	'Cc: John Q Codex <jqc@wordpress.org>',
	'Cc: iluvwp@wordpress.org', // тут можно использовать только простой email адрес
);

wp_mail( $to, $contactSubject, $contactMessage, $headers );
wp_die();
}

function create_taxonomy(){

	// список параметров: wp-kama.ru/function/get_taxonomy_labels
	register_taxonomy( 'skills', [ 'portfolio' ], [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Skills',
			'singular_name'     => 'Skill',
			'search_items'      => 'Search Skill',
			'all_items'         => 'All Skills',
			'view_item '        => 'View Skill',
			'parent_item'       => 'Parent Skill',
			'parent_item_colon' => 'Parent Skill:',
			'edit_item'         => 'Edit Skill',
			'update_item'       => 'Update Skill',
			'add_new_item'      => 'Add New Skill',
			'new_item_name'     => 'New Skill Name',
			'menu_name'         => 'Skills',
		],
        'description'           => '', // описание таксономии
		'public'                => true,
		// 'publicly_queryable'    => null, // равен аргументу public
		// 'show_in_nav_menus'     => true, // равен аргументу public
		// 'show_ui'               => true, // равен аргументу public
		// 'show_in_menu'          => true, // равен аргументу show_ui
		// 'show_tagcloud'         => true, // равен аргументу show_ui
		// 'show_in_quick_edit'    => null, // равен аргументу show_ui
		'hierarchical'          => false,

		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => true, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	] );
}

function register_my_post_type(){
	register_post_type('portfolio', array(
		'labels'             => array(
			'name'               => 'Portfolio', // Основное название типа записи
			'singular_name'      => 'Portfolio', // отдельное название записи типа Book
			'add_new'            => 'Add Portfolio',
			'add_new_item'       => 'Add Portfolio',
			'edit_item'          => 'Edit Portfolio',
			'new_item'           => 'New Portfolio',
			'view_item'          => 'Watch Portfolio',
			'search_items'       => 'Search Portfolio',
			'not_found'          => 'Not Found',
			'not_found_in_trash' => 'Not Found in trash',
			'parent_item_colon'  => '',
			'menu_name'          => 'Portfolio'

		  ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_in_nav_menus'  => true,
        'show_in_rest'       => true,
        'rest_base'          => null,
		'menu_position'      => 4,
		'hierarchical'       => false,
		'supports'           => array('title','editor', 'author', 'thumbnail', 'excerpt', 'post-formats'),
        'taxonomies'         => array('skills'),
		'has_archive'        => false,
		'rewrite'            => true,
		'query_var'          => true,
        'menu_icon'          => 'dashicons-format-gallery',
	) );
}
function theme_register_nav_menu()
{
    add_theme_support( 'post-formats', array( 'video', 'aside' ) );
    register_nav_menu('top', 'Upper Menu');
    register_nav_menu('footer', 'Lower menu');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails', array('post', 'portfolio'));
    add_image_size('post_thumb', 1300, 500, true);
    add_filter( 'excerpt_more', 'new_excerpt_more' );
    add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
    new_excerpt_more();
    my_navigation_template();
    // выводим пагинацию
    the_posts_pagination( array(
        'end_size' => 2,
    ) ); 
    add_filter('document_title_separator', 'my_sep');
    add_filter('the_content', 'test_content');
}
function test_content($content){
    return $content . ' Thank You';
}
function my_sep(){
    return ' | ';
}
function my_navigation_template(){

    return '
    <nav class="navigation %1$s" role="navigation">
        <div class="nav-links">%3$s</div>
    </nav>    
    ';
}
function new_excerpt_more(){
    global $post;
    return '<a href="'. get_permalink($post) . '">Читать дальше ...</a>';
}
function style_theme()
{
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('default', get_template_directory_uri() . '/assets/css/default.css');
    wp_enqueue_style('layout', get_template_directory_uri() . '/assets/css/layout.css');
    wp_enqueue_style('media-queries', get_template_directory_uri() . '/assets/css/media-queries.css');
    wp_enqueue_script('modernizr', get_template_directory_uri() . '/assets/js/modernizr.js');
}

function scripts_theme()
{
    wp_enqueue_script('init', get_template_directory_uri() . '/assets/js/init.js');
    wp_enqueue_script('jquery-migrate-1.2.1', get_template_directory_uri() . '/assets/js/jquery-migrate-1.2.1.min.js');
    wp_enqueue_script('jquery.flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider.js');
    wp_enqueue_script('doubletaptogo', get_template_directory_uri() . '/assets/js/doubletaptogo.js');
    wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
    wp_enqueue_script('jquery');
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', ['jquery']);
}

function register_my_widgets()
{
    register_sidebar(array(
        'name'          => 'Left Sidebar',
        'id'            => "left_sidebar",
        'description'   => 'Sidebar Description',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widgettitle">',
        'after_title' => '</h5>',
    ));
    register_sidebar(array(
        'name'          => 'Top Sidebar',
        'id'            => "top_sidebar",
        'description'   => 'Upper Sidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widgettitle">',
        'after_title' => '</h5>',
    ));
}

add_action('my_action', 'my_action_function');
function my_action_function(){
    echo ' <br>I am here ';
}
add_shortcode('my_short', 'my_short_function');
function my_short_function(){
    return 'I am shortcode ';
}
function iframe($atts){
    $atts = shortcode_atts(array(
        'href' => 'https://vk.com',
        'height' => '550px',
        'width' => '600px',
    ), $atts);
    return '<iframe src="' . $atts['href'] . '" width="' . $atts['width'] . '"height="' . $atts['height'] 
    . '"> <p>Your Browser does not support Iframes. </p></iframe>';
}
add_shortcode('iframe', 'iframe');
//[iframe href="http://www.example.com" height="480" width="640"]

