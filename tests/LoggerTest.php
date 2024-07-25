<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\App;
use DRPSMVimeo\Logger;

class LoggerTest extends BaseTest
{
    public function testLogger()
    {
        $result = Logger::Info(['TEST' => 'INFO']);
        $this->assertTrue($result);

        $obj = new \WP_Error('BAD', 'MESSAGE');

        $result = Logger::error($obj);

        $result = App::getLogFormatterInt();
        $this->assertNotNull($result);
    }

    public function testLoggingFilter()
    {
        $video = App::getVideoInt();
        $result = $video->getAll();
        $this->assertNotNull($result);
    }
}
