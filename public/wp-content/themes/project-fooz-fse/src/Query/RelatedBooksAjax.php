<?php

namespace Fooz\Query;

use Fooz\PostType\PostTypes;
use Fooz\Taxonomy\Taxonomies;

final class RelatedBooksAjax
{
    private const POSTS_PER_PAGE = 20;

    public function register(): void
    {
        add_action('wp_ajax_fooz_get_related_books', [$this, 'handle']);
        add_action('wp_ajax_nopriv_fooz_get_related_books', [$this, 'handle']);
    }

    public function handle(): void
    {
        check_ajax_referer('fooz_books', 'nonce');

        $id_current = $this->get_post_id();

        $data = $this->get_related_books($id_current);

        wp_send_json_success($data);
    }

    private function get_post_id(): int
    {
        return intval($_POST['post_id'] ?? 0);
    }

    private function get_related_books(int $id_excluded): array
    {
        $query = new \WP_Query([
            'post_type'      => PostTypes::BOOKS,
            'posts_per_page' => self::POSTS_PER_PAGE,
            'post__not_in'   => [$id_excluded],
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
                    get_the_terms(get_the_ID(), Taxonomies::GENRE) ?: [],
                    'name'
                ),
            ];
        }

        wp_reset_postdata();

        return $data;
    }
}
