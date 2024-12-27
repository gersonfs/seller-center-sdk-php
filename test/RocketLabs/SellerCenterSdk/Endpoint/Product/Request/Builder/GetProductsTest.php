<?php

namespace RocketLabs\SellerCenterSdk\Endpoint\Product\Request\Builder;

use RocketLabs\SellerCenterSdk\Core\Exception\InvalidFieldEnumValue;
use RocketLabs\SellerCenterSdk\Endpoint\Product\Request\GetProducts as GetProductsRequest;

/**
 * Class GetProductsTest
 */
class GetProductsTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider correctSetupProvider
     * @param array $data
     * @param array $expected
     */
    public function testCorrectSetup(array $data, array $expected)
    {
        $builder = new GetProducts();
        $getProductsRequest = $builder->setFilter($data['filter'])
            ->setGlobalIdentifier($data['globalIdentifier'])
            ->setSearch($data['search'])
            ->build();

        $this->assertInstanceOf(GetProductsRequest::class, $getProductsRequest);

        $request = $getProductsRequest->toArray();

        foreach ($expected as $item => $value) {
            $this->assertEquals($value, $request[$item]);
        }
    }

    public function testIncorrectSetup()
    {

        $this->expectException(InvalidFieldEnumValue::class);

        (new GetProducts)->setFilter('nope');
    }

    /**
     * @return array
     */
    public static function correctSetupProvider()
    {
        return [
            'valid request of GetProducts' => [
                [
                    'filter' => 'all',
                    'globalIdentifier' => 1,
                    'search' => 'dummy'
                ],
                [
                    'Filter' => 'all',
                    'GlobalIdentifier' => 1,
                    'Search' => 'dummy'
                ]
            ]
        ];
    }
}
