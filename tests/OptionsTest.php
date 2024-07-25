<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\App;

class OptionsTest extends BaseTest
{
    public function testers()
    {
        $obj = App::getOptionsInt();
        $key = 'temp_key';
        $result = $obj->set($key, true);
        $this->assertTrue($result);

        $result = $obj->set($key, true);
        $this->assertTrue($result);

        $result = $obj->set($key, false);
        $this->assertTrue($result);

        $result = $obj->delete($key);
    }
}
