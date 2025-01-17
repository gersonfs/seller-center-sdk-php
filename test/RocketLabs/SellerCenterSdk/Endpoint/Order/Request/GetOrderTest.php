<?php

namespace RocketLabs\SellerCenterSdk\Endpoint\Order\Request;

use RocketLabs\SellerCenterSdk\Core\Client;
use RocketLabs\SellerCenterSdk\Endpoint\Order\Response\GetOrder as GetOrderResponse;

/**
 * Class GetOrderTest
 */
class GetOrderTest extends \PHPUnit\Framework\TestCase
{
    public function testGetMethod()
    {
        $this->assertEquals(Client::GET, (new GetOrder(10))->getMethod());
    }

    public function testResponseType()
    {
        $req = new GetOrder(3);
        $this->assertEquals(GetOrderResponse::class, $req->getResponseClassName());
    }

    /**
     * @dataProvider providerToArray
     * @param int $id
     * @param array $expectedArray
     */
    public function testToArray($id, array $expectedArray)
    {
        $this->assertEquals($expectedArray, (new GetOrder($id))->toArray());
    }

    /**
     * @return array
     */
    public static function providerToArray()
    {
        return [
            [
                11,
                [
                    'Action' => 'GetOrder',
                    'Format' => 'JSON',
                    'Version' => '1.0',
                    'OrderId' => 11
                ]
            ]
        ];
    }

}

