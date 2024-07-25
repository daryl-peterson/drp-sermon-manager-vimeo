<?php

namespace DRPSMVimeo;

use DI\Container;
use DRPSMVimeo\Core\Interfaces\LogFormatterInterface;
use DRPSMVimeo\Core\Interfaces\NoticeInterface;
use DRPSMVimeo\Core\Interfaces\OptionsInterface;
use DRPSMVimeo\Core\Interfaces\PluginInterface;
use DRPSMVimeo\Core\Interfaces\RequirementsInterface;
use DRPSMVimeo\Core\Interfaces\SermonPostsInterface;
use DRPSMVimeo\Core\Interfaces\SermonVideoInterface;
use DRPSMVimeo\Core\Interfaces\VideoInterface;
use DRPSMVimeo\Core\Traits\SingletonTrait;

/**
 * App service container.
 *
 * @author      Daryl Peterson <@gmail.com>
 * @copyright   Copyright (c) 2024, Daryl Peterson
 * @license     https://www.gnu.org/licenses/gpl-3.0.txt
 *
 * @since       1.0.0
 */
class App
{
    use SingletonTrait;
    public Container $container;

    public function init(): App
    {
        if (!isset($this->container) || defined('PHPUNIT_TESTING')) {
            $config = AppConfig::get();
            $this->container = new Container($config);
        }

        return $this;
    }

    public static function getContainer(): Container
    {
        $obj = App::getInstance()->init();

        return $obj->container;
    }

    public static function getObject(string $object): mixed
    {
        $obj = App::getInstance()->init();

        return $obj->container->get($object);
    }

    /**
     * Get admin page.
     */
    public static function getAdminPage(): AdminPage
    {
        return self::getObject(AdminPage::class);
    }

    public static function getAlbumInt(): Album
    {
        return self::getObject(Album::class);
    }

    public static function getChannelInt(): Channel
    {
        return self::getObject(Channel::class);
    }

    public static function getLogFormatterInt(): LogFormatterInterface
    {
        return self::getObject(LogFormatterInterface::class);
    }

    /**
     * Get notice interface.
     */
    public static function getNoticeInt(): NoticeInterface
    {
        return self::getObject(NoticeInterface::class);
    }

    public static function getOptionsInt(): OptionsInterface
    {
        return self::getObject(OptionsInterface::class);
    }

    /**
     * Get Plugin interface.
     */
    public static function getPluginInt(): PluginInterface
    {
        return self::getObject(PluginInterface::class);
    }

    /**
     * Get requirements interface.
     */
    public static function getRequirementsInt(): RequirementsInterface
    {
        return self::getObject(RequirementsInterface::class);
    }

    /**
     * Get sermon post interface.
     */
    public static function getSermonPostInt(): SermonPostsInterface
    {
        return self::getObject(SermonPostsInterface::class);
    }

    public static function getSermonVideoInt(): SermonVideoInterface
    {
        return self::getObject(SermonVideoInterface::class);
    }

    public static function getUserInt(): User
    {
        return self::getObject(User::class);
    }

    public static function getVideoInt(): Video
    {
        return self::getObject(VideoInterface::class);
    }
}
