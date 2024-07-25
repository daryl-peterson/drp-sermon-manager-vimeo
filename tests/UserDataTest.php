<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\Core\Exceptions\VimeoException;
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
class UserDataTest extends BaseTest
{
    public function testIsUserException()
    {
        $this->expectException(VimeoException::class);
        $result = UserData::isUser(null, true);
    }

    public function testIsUserFalse()
    {
        $result = UserData::isUser(null);
        $this->assertFalse($result);
    }

    public function testIsUserTrue()
    {
        $data = [
            'uri' => '/users/115610625',
            'name' => 'Sample Name',
            'link' => 'https://vimeo.com/samplename',
            'account' => 'live_premium',
        ];
        $user = new UserData($data);
        $result = UserData::isUser($user);
        $this->assertTrue($result);
    }
}
