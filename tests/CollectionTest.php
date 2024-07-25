<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\Collection;
use DRPSMVimeo\Core\Exceptions\VimeoException;
use DRPSMVimeo\Logger;

class CollectionTest extends BaseTest
{
    public function tester()
    {
        $items = ['item1' => ['name' => 'banna'], 'item2' => ['name' => 'fred']];
        $obj = new Collection($items);

        $result = $obj->has('item1');
        $this->assertTrue($result);

        $obj->put('item3', ['name' => 'aaron']);
        $result = $obj->get('item3');
        $this->assertIsArray($result);

        $result = $obj->get('item4');
        $this->assertNull($result);

        $obj->put(null, ['name' => 'mike']);

        $result = $obj->item3;
        Logger::debug(['RESULT' => $result]);
        $this->assertNotNull($result);

        $result = $obj->count();
        $this->assertIsInt($result);

        $result = $obj->all();
        $this->assertNotNull($result);
        Logger::debug($result);

        $result = $obj->limit(2);
        $this->assertIsInt($result);
    }

    public function testIsCollectionWithException()
    {
        $this->expectException(VimeoException::class);
        $result = Collection::isCollection(null, true);
    }

    public function testIsCollectionTrue()
    {
        $obj = new Collection(['name' => 'tester']);
        $result = Collection::isCollection($obj);
        $this->assertTrue($result);
    }

    public function testIsCollectionFalse()
    {
        $result = Collection::isCollection(null);
        $this->assertFalse($result);
    }
}
