<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\App;
use DRPSMVimeo\SermonVideo;

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
class SermonVideoTest extends BaseTest
{
    public function testConstructor()
    {
        $video = App::getVideoInt();
        $options = App::getOptionsInt();

        $obj = new SermonVideo($video, $options);
        $this->assertInstanceOf(SermonVideo::class, $obj);
    }
}
