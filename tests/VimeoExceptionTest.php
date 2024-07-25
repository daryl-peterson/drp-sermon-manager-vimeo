<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\App;
use DRPSMVimeo\Core\Exceptions\VimeoException;
use DRPSMVimeo\Video;
use DRPSMVimeo\VimeoResponse;

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
class VimeoExceptionTest extends BaseTest
{
    protected Video $vimeo;

    public function setup(): void
    {
        $this->vimeo = App::getVideoInt();
        $this->isReady = $this->vimeo->isReady();
    }

    public function teardown(): void
    {
        $notice = App::getNoticeInt();
        $notice->delete();
    }

    private function getErrorResponse($code)
    {
        return [
            'status' => $code,
        ];
    }

    public function testHasBody()
    {
        $response = $this->getErrorResponse(403);
        $this->expectException(VimeoException::class);
        $response['status'] = 403;
        $response['body']['error_code'] = 403;
        $response['body']['error'] = 'This is a test';
        VimeoResponse::hasError($response);
    }

    public function testException400()
    {
        $response = $this->getErrorResponse(400);
        $this->expectException(VimeoException::class);
        $response['status'] = 400;
        $response['body']['error'] = 'This is a test';
        VimeoResponse::verify($response);
    }

    public function testException401()
    {
        $response = $this->getErrorResponse(401);
        $this->expectException(VimeoException::class);
        $response['status'] = 401;
        VimeoResponse::verify($response);
    }

    public function testException403Code()
    {
        $response = $this->getErrorResponse(403);
        $this->expectException(VimeoException::class);
        $response['status'] = 403;
        $response['body']['error_code'] = 403;
        $response['body']['developer_message'] = 'Test Error';
        $response['headers']['X-Banned-IP'] = '127.0.0.1';
        VimeoResponse::verify($response);
    }

    public function testException403()
    {
        $response = $this->getErrorResponse(403);
        $this->expectException(VimeoException::class);
        VimeoResponse::verify($response);
    }

    public function testException429()
    {
        $response = $this->getErrorResponse(429);
        $this->expectException(VimeoException::class);
        VimeoResponse::verify($response);
    }

    public function testException503()
    {
        $response = $this->getErrorResponse(503);
        $this->expectException(VimeoException::class);
        VimeoResponse::verify($response);
    }

    public function testException600()
    {
        $response = $this->getErrorResponse(600);
        $this->expectException(VimeoException::class);
        VimeoResponse::verify($response);
    }
}
