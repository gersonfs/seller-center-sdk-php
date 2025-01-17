<?php

namespace RocketLabs\SellerCenterSdk\Endpoint\Feed\Request;

use RocketLabs\SellerCenterSdk\Endpoint\Feed\Response\FeedList as FeedListResponse;

/**
 * Class FeedListTest
 */
class FeedListTest extends \PHPUnit\Framework\TestCase
{

    public function testConstructor()
    {
        $this->assertEquals(FeedListResponse::class, (new FeedList())->getResponseClassName());
    }

}
