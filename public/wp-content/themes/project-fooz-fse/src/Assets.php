<?php

namespace Fooz;

class Assets
{
    public static function register(): void
    {
        add_action('wp_enqueue_scripts', [self::class, 'enqueue']);
    }

    public static function enqueue(): void
    {
        self::enqueue_cdn_styles();
        self::enqueue_local_styles();
        self::enqueue_cdn_scripts();
        self::enqueue_local_scripts();
    }

    private static function enqueue_cdn_styles(): void
    {
        // 
    }

    private static function enqueue_local_styles(): void
    {
        wp_enqueue_style('main', get_stylesheet_directory_uri() . '/style.css', []);
    }

    private static function enqueue_cdn_scripts(): void
    {
        wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js', [], false, true);
    }

    private static function enqueue_local_scripts(): void
    {
        wp_enqueue_script('main', get_stylesheet_directory_uri() . '/assets/js/scripts.js', ['bootstrap'], false, true);
        
        wp_localize_script('main', 'foozAjax', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('fooz_books'),
            'action'  => 'fooz_get_related_books'
        ]);
    }
}
