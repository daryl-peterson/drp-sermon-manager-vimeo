<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\App;
use DRPSMVimeo\Logger;
use DRPSMVimeo\User;
use DRPSMVimeo\UserData;

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
class UserTest extends BaseTest
{
    protected User $obj;

    public function setup(): void
    {
        $this->obj = App::getUserInt();
        $this->isReady = $this->obj->isReady();
    }

    public function teardown(): void
    {
        $notice = App::getNoticeInt();
        $notice->delete();
    }

    public function testGetUser()
    {
        if (!$this->isReady) {
            Logger::debug('SKIPPING TEST');
            $this->markTestSkipped('API is not ready');
        }
        Logger::debug('STARTING TEST');
        $result = $this->obj->getUser();
        $this->assertInstanceOf(UserData::class, $result);
    }

    public function testGetUserFromCache()
    {
        $result = $this->obj->getUser(true);
        $this->assertInstanceOf(UserData::class, $result);
    }

    public function testGetUserById()
    {
        $result = $this->obj->getUser();
        $result = $this->obj->getUserById($result->id);
        Logger::debug($result);
        $this->assertInstanceOf(UserData::class, $result);
    }
}
