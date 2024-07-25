<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\Album;
use DRPSMVimeo\App;
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
class AlbumTest extends BaseTest
{
    protected Album $obj;

    public function setup(): void
    {
        $this->obj = App::getAlbumInt();
        $this->isReady = $this->obj->isReady();
    }

    public function teardown(): void
    {
        $notice = App::getNoticeInt();
        $notice->delete();
    }

    public function testGetAlbums()
    {
        if (!$this->isReady) {
            $this->markTestSkipped('API is not ready');
        }

        $result = $this->obj->getAlbums();
        $this->assertInstanceOf(Collection::class, $result);

        $result = $this->obj->getAlbums(true);
        $this->assertInstanceOf(Collection::class, $result);
    }
}
