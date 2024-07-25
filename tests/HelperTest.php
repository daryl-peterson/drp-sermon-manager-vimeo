<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\Helper;

use const DRPSMVimeo\KEY_PREFIX;

class HelperTest extends BaseTest
{
    public function testMisc()
    {
        $result = Helper::getKeyName('blah');
        $this->assertIsString($result);

        $key = Helper::getKeyName('_blah');
        $result = Helper::getKeyName(KEY_PREFIX.'_blah');
        $this->assertIsString($result);
        $this->assertEquals($key, $result);

        $result = Helper::getPluginDir();
        $this->assertIsString($result);

        $result = Helper::getUrl();
        $this->assertIsString($result);

        $result = Helper::getSlug();
        $this->assertIsString($result);

        $result = Helper::isCompatible();
        $this->assertIsBool($result);

        $result = Helper::isPluginActive('blah');
        $this->assertFalse($result);

        $result = Helper::getActivePlugins();
        $this->assertIsArray($result);
    }
}
