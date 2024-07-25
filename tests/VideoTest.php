<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\App;
use DRPSMVimeo\Collection;
use DRPSMVimeo\Logger;
use DRPSMVimeo\Video;
use DRPSMVimeo\VideoData;

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
class VideoTest extends BaseTest
{
    protected Video $video;

    public function setup(): void
    {
        $this->video = App::getVideoInt();
        $this->isReady = $this->video->isReady();

        if (!$this->isReady) {
            $this->markTestIncomplete('Check your vimeo credentials.');
        }

        $result = $this->video->getCount();
        if ($result === 0) {
            $this->markTestIncomplete('No Videos defined. Check Vimeo');
        }
    }

    public function teardown(): void
    {
        $notice = App::getNoticeInt();
        $notice->delete();
    }

    public function testGetVideoCount()
    {
        $result = $this->video->getCount();
        $this->assertIsInt($result);
    }

    public function testGetVideos()
    {
        if (!$this->isReady) {
            Logger::debug('SKIPPING TEST');
            $this->markTestSkipped('API is not ready');
        }

        Logger::debug('STARTING TEST');
        $result = $this->video->getRecent();

        $this->assertInstanceOf(VideoData::class, $result);
        $video = $result;

        if (!isset($video)) {
            return;
        }

        $result = $this->video->getByName($video->name);
        $this->assertInstanceOf(VideoData::class, $result);

        $result = $this->video->getByName('blah-blah');
        $this->assertNull($result);

        $result = $this->video->getVideos();
        $this->assertInstanceOf(Collection::class, $result);

        $result = $this->video->getAll();
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testIsReady()
    {
        $this->isReady = $this->video->isReady(true);
        $this->assertTrue($this->isReady);
    }
}
