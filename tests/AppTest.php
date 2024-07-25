<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\App;
use DRPSMVimeo\AppConfig;

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
class AppTest extends BaseTest
{
    public function testGetApp()
    {
        $app = App::getInstance()->init();
        $this->assertInstanceOf(App::class, $app);
    }

    public function testGetVimeoSettiongs()
    {
        $app = App::getInstance();
        $this->assertNotNull($app);

        $result = AppConfig::getVimeoSettings(true);
        $this->assertIsArray($result);
    }
}
