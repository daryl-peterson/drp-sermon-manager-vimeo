<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\Core\Exceptions\VimeoException;
use DRPSMVimeo\PostValidation;

use const DRPSMVimeo\PLUGIN_SM_SERMON;

/**
 * Post validation test.
 *
 * @author      Daryl Peterson <@gmail.com>
 * @copyright   Copyright (c) 2024, Daryl Peterson
 * @license     https://www.gnu.org/licenses/gpl-3.0.txt
 */
class PostValidationTest extends BaseTest
{
    public function testIsValidPostTypeException()
    {
        $sermon = $this->getTestSermon();
        $this->expectException(VimeoException::class);
        $sermon->post_type = 'post';
        PostValidation::isValidPostType($sermon, PLUGIN_SM_SERMON, true);
    }

    public function testIsValidPostStatusException()
    {
        $this->expectException(VimeoException::class);
        PostValidation::isValidPostStatus('publish', 'publish', true);
    }

    public function testIsValidPostStatusFalse()
    {
        $result = PostValidation::isValidPostStatus('publish', 'publish');
        $this->assertFalse($result);
    }

    public function testIsValidPostStatusTrue()
    {
        $result = PostValidation::isValidPostStatus('publish', 'future');
        $this->assertTrue($result);
    }

    public function testIsValidPostTypeBool()
    {
        $sermon = $this->getTestSermon();
        $sermon->post_type = 'post';
        $result = PostValidation::isValidPostType($sermon, PLUGIN_SM_SERMON);
        $this->assertFalse($result);
    }
}
