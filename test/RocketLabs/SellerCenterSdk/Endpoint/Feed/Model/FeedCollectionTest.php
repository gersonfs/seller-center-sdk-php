<?php

namespace RocketLabs\SellerCenterSdk\Endpoint\Feed\Model;

/**
 * Class FeedCollectionTest
 */
class FeedCollectionTest extends \PHPUnit\Framework\TestCase
{

    public function testClass()
    {
        $this->assertEquals(Feed::class, FeedCollection::ELEMENT_TYPE);
    }
}
