<?php

namespace DRPSMVimeo\Tests;

use DI\Container;
use DRPSMVimeo\App;
use DRPSMVimeo\Core\Interfaces\NoticeInterface;
use DRPSMVimeo\Logger;

class NoticeTest extends BaseTest
{
    public function tester()
    {
        $title = 'This is the tile';
        $message = 'This is the message';

        $result = App::getContainer();
        $this->assertInstanceOf(Container::class, $result);

        $obj = App::getNoticeInt(NoticeInterface::class);
        $obj->setSuccess($title, $message);
        $obj->setWarning($title, $message);
        $obj->setInfo($title, $message);
        $obj->setError($title, $message);

        ob_start();
        $obj->showNotice();
        $result = ob_get_clean();
        Logger::debug($result);
        $this->assertIsString($result);

        $obj->delete();

        $obj->showNotice();
    }
}
