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
        self::styles_cdn();
        self::styles_local();
        self::scripts_cdn();
        self::scripts_local();
    }

    /**
     * Styles from CDN
     */
    private static function styles_cdn(): void
    {
        // 
    }

    /**
     * Local styles
     */
    private static function styles_local(): void
    {
        wp_enqueue_style('main', get_stylesheet_directory_uri() . '/style.css', []);
    }

    /**
     * Sripts from CDN
     */
    private static function scripts_cdn(): void
    {
        wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js', [], false, true);
    }

    /**
     * Local scripts
     */
    private static function scripts_local(): void
    {
        wp_enqueue_script('main', get_stylesheet_directory_uri() . '/assets/js/scripts.js', ['bootstrap'], false, true);

        wp_localize_script('main', 'foozAjax', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('fooz_books'),
            'action'  => 'fooz_get_related_books'
        ]);
    }
}
