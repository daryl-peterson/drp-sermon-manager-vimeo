<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\App;
use DRPSMVimeo\Channel;
use DRPSMVimeo\Collection;

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
class ChannelTest extends BaseTest
{
    protected Channel $obj;

    public function setup(): void
    {
        $this->obj = App::getChannelInt();
        $this->isReady = $this->obj->isReady();
    }

    public function teardown(): void
    {
        $notice = App::getNoticeInt();
        $notice->delete();
    }

    public function testGetChannels()
    {
        if (!$this->isReady) {
            $this->markTestSkipped('API is not ready');
        }
        $result = $this->obj->getChannels();
        $this->assertInstanceOf(Collection::class, $result);
    }
}
