<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\Logger;
use PHPUnit\Framework\TestCase;

use const DRPSMVimeo\PLUGIN_SM_SERMON;

/**
 * Class description.
 *
 * @category
 *
 * @author      Daryl Peterson <@gmail.com>
 * @copyright   Copyright (c) 2024, Daryl Peterson
 * @license     https://www.gnu.org/licenses/gpl-3.0.txt
 *
 * @since       1.0.0
 */
class BaseTest extends TestCase
{
    protected bool $isReady;
    protected $user;

    public function __construct(string $name)
    {
        parent::__construct($name);
        if (!defined('PHPUNIT_TESTING')) {
            define('PHPUNIT_TESTING', true);
        }
    }

    /**
     * Get test sermon.
     *
     * @param bool $delete Delete post meta
     */
    public function getTestSermon(bool $delete = true): ?\WP_Post
    {
        $args = [
            'numberposts' => 5,
            'post_type' => PLUGIN_SM_SERMON,
            'order' => 'DESC',
            'orderby' => 'date',
          ];
        $posts = get_posts($args);
        Logger::debug($posts);

        foreach ($posts as $post) {
            if ($post->post_status !== 'publish') {
                continue;
            }

            break;
        }

        // delete_metadata(PLUGIN_SM_SERMON, $posts[0]->ID, 'sermon_video_link');
        if ($delete) {
            $result = delete_post_meta($post->ID, 'sermon_video_link');
        }
        Logger::debug([
            'DELETE FLAG' => $delete,
            'DELETE' => $result,
            'RETURN' => $post,
        ]);

        return $post;
    }
}
