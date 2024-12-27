<?php

namespace RocketLabs\SellerCenterSdk\Endpoint\Order\Request;

use RocketLabs\SellerCenterSdk\Core\Client;

class SetStatusToReadyToShipTest extends \PHPUnit\Framework\TestCase
{

    public function testGetMethod()
    {
        $this->assertEquals(
            Client::POST,
            (new SetStatusToReadyToShip([10, 11], 'dropship', 'DHL', 'D12345667KJE'))->getMethod()
        );
    }

    /**
     * @param int[] $ids
     * @param string $deliveryType
     * @param string $shippingProvider
     * @param string $trackingNumber
     * @param array $expectedArray
     *
     * @dataProvider providerToArray
     */
    public function testToArray(array $ids, $deliveryType, $shippingProvider, $trackingNumber, array $expectedArray)
    {
        $this->assertEquals(
            $expectedArray,
            (new SetStatusToReadyToShip($ids, $deliveryType, $shippingProvider, $trackingNumber))->toArray()
        );
    }

    public static function providerToArray()
    {
        return [
            [
                [10,11],
                'dropship',
                'DHL',
                'D4263456346345',
                [
                    'Action' => 'SetStatusToReadyToShip',
                    'Format' => 'JSON',
                    'Version' => '1.0',
                    'OrderItemIds' => '10,11',
                    'DeliveryType' => 'dropship',
                    'ShippingProvider' => 'DHL',
                    'TrackingNumber' => 'D4263456346345'
                ]
            ]
        ];
    }
}
