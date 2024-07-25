<?php

namespace DRPSMVimeo;

use DRPSMVimeo\Core\Interfaces\LogFormatterInterface;
use DRPSMVimeo\Core\Interfaces\NoticeInterface;
use DRPSMVimeo\Core\Interfaces\OptionsInterface;
use DRPSMVimeo\Core\Interfaces\PluginInterface;
use DRPSMVimeo\Core\Interfaces\RequirementsInterface;
use DRPSMVimeo\Core\Interfaces\SermonPostsInterface;
use DRPSMVimeo\Core\Interfaces\SermonVideoInterface;
use DRPSMVimeo\Core\Interfaces\VideoInterface;

/**
 * App configuration.
 *
 * @author      Daryl Peterson <@gmail.com>
 * @copyright   Copyright (c) 2024, Daryl Peterson
 * @license     https://www.gnu.org/licenses/gpl-3.0.txt
 */
class AppConfig
{
    public static array $vimeo;

    public static function get(): array
    {
        self::$vimeo = self::getVimeoSettings();

        return [
            LogFormatterInterface::class => function () {
                return new LogFormatter();
            },

            NoticeInterface::class => function () {
                return Notice::getInstance();
            },

            OptionsInterface::class => function () {
                return Options::getInstance();
            },

            PluginInterface::class => function () {
                return new Plugin();
            },

            RequirementsInterface::class => function (NoticeInterface $notice) {
                return new Requirements($notice);
            },

            SermonPostsInterface::class => function (SermonVideoInterface $video) {
                return new SermonPost($video);
            },

            SermonVideoInterface::class => function (VideoInterface $video, OptionsInterface $options) {
                return new SermonVideo($video, $options);
            },

            VideoInterface::class => function () {
                return new Video(...self::$vimeo);
            },

            AdminPage::class => function () {
                return new AdminPage();
            },

            Album::class => function () {
                return new Album(...self::$vimeo);
            },

            Channel::class => function () {
                return new Channel(...self::$vimeo);
            },

            User::class => function () {
                return new User(...self::$vimeo);
            },
        ];
    }

    public static function getVimeoSettings(bool $force = false)
    {
        if (!$force) {
            if (isset(self::$vimeo)) {
                return self::$vimeo;
            }
        }

        $options = Options::getInstance();
        $settings = $options->get('settings');

        if (!isset($settings)) {
            // @codeCoverageIgnoreStart
            $settings = [
                'client_id' => 'Client ID',
                'client_secret' => 'Client Secret',
                'access_token' => 'Access Token',
                'match' => '',
            ];
            // @codeCoverageIgnoreEnd
        }

        return $settings;
    }
}
