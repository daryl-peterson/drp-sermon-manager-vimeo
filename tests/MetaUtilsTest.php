<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\Logger;
use DRPSMVimeo\MetaUtils;

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
class MetaUtilsTest extends BaseTest
{
    public function testGetAllMeta()
    {
        $sermon = $this->getTestSermon(false);
        $result = MetaUtils::getAllPostMeta($sermon->ID);
        $this->assertIsArray($result);

        $result = MetaUtils::getAllPostMeta(0);
        $this->assertIsArray($result);
    }

    public function testGetRawMeta()
    {
        $sermon = $this->getTestSermon(false);
        $key = 'sermon_video_link';
        $result = MetaUtils::getRawMeta($sermon->ID, $key);
        if (is_object($result)) {
            $this->assertIsObject($result);
        } else {
            $this->assertNull($result);
        }

        Logger::debug(['GET RAW META' => $result]);

        $result = MetaUtils::getRawMeta(0, $key);
        $this->assertNull($result);
    }
}
