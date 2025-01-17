<?php

namespace RocketLabs\SellerCenterSdk\Endpoint\Order\Request\Builder;

use RocketLabs\SellerCenterSdk\Core\Exception\InvalidFieldEnumValue;
use RocketLabs\SellerCenterSdk\Core\Exception\InvalidSortingDirection;
use RocketLabs\SellerCenterSdk\Core\Exception\InvalidSortingField;
use RocketLabs\SellerCenterSdk\Endpoint\Order\Request\GetOrders as GetOrdersRequest;

class GetOrdersTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider providerBuild
     * @param array $methods
     * @param GetOrdersRequest $expectedRequest
     */
    public function testBuild(array $methods, GetOrdersRequest $expectedRequest)
    {
        $builder = new GetOrders();
        foreach ($methods as list($method, $values)) {
            call_user_func_array([$builder, $method], $values);
        }

        $this->assertEquals($expectedRequest, $builder->build());
    }

    /**
     * @return array
     */
    public static function providerBuild()
    {
        return [
            'only sorting' => [
                [
                    ['setSorting', ['updated_at', 'ASC']],
                ],
                new GetOrdersRequest(
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    'updated_at',
                    'ASC'
                ),
            ],
            'limit and offset' => [
                [
                    ['setLimit', [100]],
                    ['setOffset', [300]],
                ],
                new GetOrdersRequest(
                    null,
                    null,
                    null,
                    null,
                    null,
                    100,
                    300
                ),
            ],
            'filters' => [
                [
                    ['setStatus', ['delivered']],
                    ['setCreatedAfter', [new \DateTime('2016-04-01')]],
                    ['setCreatedBefore', [new \DateTime('2016-05-01')]],
                    ['setUpdatedAfter', [new \DateTime('2016-05-01')]],
                    ['setUpdatedBefore', [new \DateTime('2016-06-01')]],
                ],
                new GetOrdersRequest(
                    new \DateTime('2016-04-01'),
                    new \DateTime('2016-05-01'),
                    new \DateTime('2016-05-01'),
                    new \DateTime('2016-06-01'),
                    'delivered'
                ),
            ],
        ];
    }

    /**
     * @dataProvider providerSetSorting
     * @param string $sortBy
     * @param $sortDirection
     * @param string $exceptionExpected
     */
    public function testSetSorting($sortBy, $sortDirection, $exceptionExpected)
    {
        if ($exceptionExpected) {
            $this->expectException($exceptionExpected);
        } else {
			$this->assertTrue(true);
		}

        (new GetOrders())->setSorting($sortBy, $sortDirection);
    }

    /**
     * @return array
     */
    public static function providerSetSorting()
    {
        return [
            'valid both values' => [
                'created_at',
                'DESC',
                false,
            ],
            'invalid sortBy value' => [
                'price',
                'ASC',
                InvalidSortingField::class,
            ],
            'invalid sortDirection value' => [
                'updated_at',
                'ASCA',
                InvalidSortingDirection::class,
            ]
        ];
    }

    /**
     * @dataProvider providerSetStatus
     * @param string $status
     * @param string $exceptionExpected
     */
    public function testSetStatus($status, $exceptionExpected)
    {
        if ($exceptionExpected) {
            $this->expectException($exceptionExpected);
        } else {
			$this->assertTrue(true);
		}

        (new GetOrders())->setStatus($status);
    }

    /**
     * @return array
     */
    public static function providerSetStatus()
    {
        return [
            'valid value' => [
                'ready_to_ship',
                false,
            ],
            'invalid value' => [
                'not_ready_to_ship',
                InvalidFieldEnumValue::class,
            ]
        ];
    }
}
