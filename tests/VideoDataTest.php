<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\Core\Exceptions\VimeoException;
use DRPSMVimeo\VideoData;

/**
 * Video data test.
 *
 * @author      Daryl Peterson <@gmail.com>
 * @copyright   Copyright (c) 2024, Daryl Peterson
 * @license     https://www.gnu.org/licenses/gpl-3.0.txt
 */
class VideoDataTest extends BaseTest
{
    public function testIsVideoException()
    {
        $this->expectException(VimeoException::class);
        VideoData::isVideo(null, true);
    }

    public function testIsVideoBool()
    {
        $result = VideoData::isVideo(null);
        $this->assertFalse($result);
    }
}
