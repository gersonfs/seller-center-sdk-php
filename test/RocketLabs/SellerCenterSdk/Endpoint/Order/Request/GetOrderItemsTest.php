<?php

namespace RocketLabs\SellerCenterSdk\Endpoint\Order\Request;

use RocketLabs\SellerCenterSdk\Core\Client;
use RocketLabs\SellerCenterSdk\Endpoint\Order\Response\GetOrderItems as Response;

class GetOrderItemsTest extends \PHPUnit\Framework\TestCase
{

    public function testGetMethod()
    {
        $this->assertEquals(Client::GET, (new GetOrderItems(10))->getMethod());
    }

    /**
     * @param array $expected
     * @param array $data
     *
     * @dataProvider toArrayDataProvider
     */
    public function testToArray($expected, $data)
    {
        $request = new GetOrderItems($data['OrderId']);
        $this->assertEquals($expected, $request->toArray());
    }

    public function testGetResponseClassName()
    {
        $request = new GetOrderItems(10);
        $this->assertEquals(Response::class, $request->getResponseClassName());
    }

    public static function toArrayDataProvider()
    {
        return [
            'single test' => [
                [
                    'OrderId' => '4',
                    'Version' => '1.0',
                    'Action' => 'GetOrderItems',
                    'Format' => 'JSON',
                ],
                [
                    'OrderId' => 4
                ]
            ]
        ];
    }
}
