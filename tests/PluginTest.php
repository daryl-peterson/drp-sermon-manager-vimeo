<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\App;
use DRPSMVimeo\Plugin;

class PluginTest extends BaseTest
{
    public function testConstructor()
    {
        $obj = new Plugin();
        $this->assertInstanceOf(Plugin::class, $obj);
    }

    public function testMisc()
    {
        $obj = App::getPluginInt();
        $this->assertNotNull($obj);

        if (!defined('WP_ADMIN')) {
            define('WP_ADMIN', true);
        }

        $obj->init(true);

        $obj->activate();
        $obj->deactivate();

        $obj->showNotice();

        $result = $obj->shutdown();
        $this->assertNull($result);
    }
}
