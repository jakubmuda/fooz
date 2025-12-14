<?php
/**
 * Theme functions and definitions
 *
 * @package Project-Fooz
 */


/**
 * CONST
 */

// POST TYPES
const POST_TYPE_BOOKS       = 'books';
const POST_TYPE_POST        = 'post';

// TAXONOMIES
const TAXONOMY_GENRE        = 'genre';
const TAXONOMY_POST         = 'category';

// GETTEXT
const TEXT_DOMAIN_THEME     = 'fooz-theme';



/**
 * Theme setup
 */
function fooz_setup_theme() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails', [
        POST_TYPE_BOOKS,
        POST_TYPE_POST,
    ]);

}
add_action('after_setup_theme', 'fooz_setup_theme');



/**
 * App init
 */
function fooz_app_init() {

    // REGISTER POST TYPES
    register_post_type(POST_TYPE_BOOKS, [
        'public'                => true,
        'label'                 => __('Books', TEXT_DOMAIN_THEME),
        'menu_icon'             => 'dashicons-book',
        'supports'              => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest'          => true,
        'rewrite'               => ['slug' => 'library'],
        'labels'                => [
            'name'          => __('Books', TEXT_DOMAIN_THEME),
            'singular_name' => __('Book', TEXT_DOMAIN_THEME),
            'menu_name'     => __('Books', TEXT_DOMAIN_THEME),
            'add_new'       => __('Add New', TEXT_DOMAIN_THEME),
            'add_new_item'  => __('Add New Book', TEXT_DOMAIN_THEME),
            'edit_item'     => __('Edit Book', TEXT_DOMAIN_THEME),
            'new_item'      => __('New Book', TEXT_DOMAIN_THEME),
            'view_item'     => __('View Book', TEXT_DOMAIN_THEME),
            'search_items'  => __('Search Books', TEXT_DOMAIN_THEME),
            'not_found'     => __('No books found', TEXT_DOMAIN_THEME),
        ],
    ]);

    
    // REGISTER TAXONOMIES
    register_taxonomy(TAXONOMY_GENRE, [POST_TYPE_BOOKS], [
		'label'         => 'Kategorie',
		'public'        => true,
        'hierarchical'  => true,
        'show_in_rest'  => true,
        'rewrite'       => ['slug' => 'book-genre'],
        'labels'        => [
            'name'              => __('Genres', TEXT_DOMAIN_THEME),
            'singular_name'     => __('Genre', TEXT_DOMAIN_THEME),
            'search_items'      => __('Search Genres', TEXT_DOMAIN_THEME),
            'all_items'         => __('All Genres', TEXT_DOMAIN_THEME),
            'edit_item'         => __('Edit Genre', TEXT_DOMAIN_THEME),
            'update_item'       => __('Update Genre', TEXT_DOMAIN_THEME),
            'add_new_item'      => __('Add New Genre', TEXT_DOMAIN_THEME),
            'new_item_name'     => __('New Genre Name', TEXT_DOMAIN_THEME),
            'menu_name'         => __('Genre', TEXT_DOMAIN_THEME),
        ],
	]);


    // REGISTER BLOCKS
    register_block_type(__DIR__ . '/blocks/faq');
    register_block_type(__DIR__ . '/blocks/faq-item');

}
add_action('init', 'fooz_app_init');



/**
 * Register styles and scripts
 */
function fooz_enqueue_librairies() {

    /**********************************
     *              CDN
     **********************************/

    // STYLE

    // SCRIPT
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js', [], false, true);


    /**********************************
     *              LOCAL
     **********************************/

    // STYLE
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/style.css', []);

    // SCRIPT
    wp_enqueue_script('main', get_stylesheet_directory_uri() . '/assets/js/scripts.js', ['bootstrap'], time(), true);

    wp_localize_script('main', 'foozAjax', [
        'ajaxUrl'   => admin_url('admin-ajax.php'),
        'nonce'     => wp_create_nonce('fooz_books'),
        'action'    => 'fooz_get_related_books',
    ]);

}
add_action('wp_enqueue_scripts', 'fooz_enqueue_librairies');



/**
 * Process ajax for related books
 */
function fooz_get_related_books() {
    check_ajax_referer('fooz_books', 'nonce');

    $id_current = intval($_POST['post_id'] ?? 0);

    $query = new WP_Query([
        'post_type'      => POST_TYPE_BOOKS,
        'posts_per_page' => 20,
        'post__not_in'   => [$id_current],
    ]);

    $data = [];

    while ($query->have_posts()) {
        $query->the_post();

        $data[] = [
            'title'   => get_the_title(),
            'url'     => get_permalink(),
            'date'    => get_the_date(),
            'excerpt' => get_the_excerpt(),
            'genres'  => wp_list_pluck(
                get_the_terms(get_the_ID(), TAXONOMY_GENRE) ?: [],
                'name'
            ),
        ];
    }
    wp_reset_postdata();

    wp_send_json_success($data);
}
add_action('wp_ajax_fooz_get_related_books', 'fooz_get_related_books');
add_action('wp_ajax_nopriv_fooz_get_related_books', 'fooz_get_related_books');



/**
 * Add shortcode [fooz_related_books]
 */
add_shortcode('fooz_related_books', function () {
    return sprintf(
        '<div id="fooz-related-books" data-post-id="%d">Loading related books...</div>',
        get_the_ID()
    );
});



add_action('pre_get_posts', function (WP_Query $query) {

    if (
        !is_admin() &&
        $query->is_main_query() &&
        is_tax(TAXONOMY_GENRE)
    ) {
        $query->set('posts_per_page', 5);
    }

});

