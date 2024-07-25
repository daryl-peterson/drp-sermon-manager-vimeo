<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\App;
use DRPSMVimeo\SermonPost;

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
class SermonPostTest extends BaseTest
{
    public function testConstructor()
    {
        $video = App::getSermonVideoInt();
        $obj = new SermonPost($video);
        $this->assertInstanceOf(SermonPost::class, $obj);
        $obj->init();
    }

    public function testSavePost()
    {
        $sermon = $this->getTestSermon();
        $obj = App::getSermonPostInt();
        $this->assertNotNull($obj);
        $obj->video()->setMatching('name');
        $result = $obj->savePost($sermon->ID, $sermon, true);
        $this->assertTrue($result);

        $obj->video()->setMatching('date');
        $result = $obj->video()->getMatching();
        $this->assertEquals('date', $result);
    }

    public function testPublishName()
    {
        $sermon = $this->getTestSermon();
        $obj = App::getSermonPostInt();
        $this->assertNotNull($obj);
        $obj->video()->setMatching('name');

        if (isset($sermon)) {
            $result = $obj->publishSermon('publish', 'future', $sermon);
            $this->assertIsBool($result);
        }

        /*
         * Include SavePost test here to force false
         */
        $obj->video()->setMatching('name');
        $result = $obj->savePost($sermon->ID, $sermon, true);
        $this->assertFalse($result);
    }

    public function testGetVideo()
    {
        $obj = App::getSermonPostInt();
        $sermon = $this->getTestSermon(false);
        $sermon->post_title = 'This is the first day of the rest of your life !';
        $result = $obj->video()->getVideo($sermon);
        $this->assertFalse($result);
    }

    public function testPublishNameChanged()
    {
        $sermon = $this->getTestSermon();
        $obj = App::getSermonPostInt();
        $this->assertNotNull($obj);
        $obj->video()->setMatching('name');

        if (isset($sermon)) {
            $result = $obj->publishSermon('publish', 'future', $sermon);
            $this->assertTrue($result);
        }
    }

    public function testPublisDate()
    {
        $sermon = $this->getTestSermon();
        $obj = App::getSermonPostInt();
        $this->assertNotNull($obj);
        $obj->video()->setMatching('date');

        if (isset($sermon)) {
            $result = $obj->publishSermon('publish', 'scheduled', $sermon);
            $this->assertNotNull($result);
        }
    }

    public function testPublishStatus()
    {
        $sermon = $this->getTestSermon();
        $obj = App::getSermonPostInt();
        $this->assertNotNull($obj);
        $obj->video()->setMatching('name');

        if (isset($sermon)) {
            $result = $obj->publishSermon('publish', 'publish', $sermon);
            $this->assertFalse($result);
        }
    }

    public function testPublishPostType()
    {
        $sermon = $this->getTestSermon();
        $obj = App::getSermonPostInt();
        $this->assertNotNull($obj);
        $obj->video()->setMatching('name');
        $sermon->post_type = 'post';

        if (isset($sermon)) {
            $result = $obj->publishSermon('publish', 'publish', $sermon);
            $this->assertFalse($result);
        }
    }

    public function testPublishDelete()
    {
        $sermon = $this->getTestSermon(false);
        $obj = App::getSermonPostInt();
        $this->assertNotNull($obj);
        $obj->video()->setMatching('name');

        if (isset($sermon)) {
            $result = $obj->publishSermon('publish', 'scheduled', $sermon);
            $this->assertTrue($result);
        }

        $result = $obj->publishSermon('publish', 'future', $sermon);
        $this->assertFalse($result);
    }

    public function testPostID()
    {
        $sermon = $this->getTestSermon(false);
        $obj = App::getSermonPostInt();
        $this->assertNotNull($obj);
        $obj->video()->setMatching('name');

        if (isset($sermon)) {
            $sermon->ID = 0;
            $result = $obj->publishSermon('publish', 'future', $sermon);
            $this->assertFalse($result);
        }
    }
}
