<?php

namespace RocketLabs\SellerCenterSdk\Core\Request;

use RocketLabs\SellerCenterSdk\Core\Client;

class GenericRequestTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param GenericRequest $request
     * @param $expected
     *
     * @dataProvider toArrayDataProvider
     */
    public function testToArray(GenericRequest $request, $expected)
    {
        $requestData = $request->toArray();
        $this->assertEquals($expected, $requestData);
    }
    /**
     * @return array
     */
    public static function toArrayDataProvider()
    {
        return [
            'get' => [
                new GenericRequest(
                    Client::GET,
                    'GetProduct',
                    GenericRequest::V1,
                    [],
                    []
                ),
                ['Action' => 'GetProduct', 'Format' => 'JSON', 'Version' => '1.0']
            ],
            'get + query' => [
                new GenericRequest(
                    Client::GET,
                    'GetOrder',
                    GenericRequest::V1,
                    ['orderId' => 123],
                    []
                ),
                ['Action' => 'GetOrder', 'Format' => 'JSON', 'Version' => '1.0', 'orderId' => 123]
            ],
            'post body isn\'t involved' => [
                new GenericRequest(
                    Client::POST,
                    'ProductCreate',
                    GenericRequest::V1,
                    ['param' => 'value', 'Format' => 'XML'],
                    [
                        'Product' => [
                            'Brand' => 'Name',
                            'Description' => 'test product description',
                            'Name' => 'Test product',
                            'Price' => 123,
                            'PrimaryCategory' => '12',
                            'TaxClass' => 'default'
                        ]
                    ]
                ),
                ['Action' => 'ProductCreate', 'Format' => 'JSON', 'Version' => '1.0', 'param' => 'value']
            ]
        ];
    }

    /**
     * @param string $method
     * @param string $action
     * @param string $version
     * @param array $query
     * @param array $body
     * @dataProvider providerConstructor
     */
    public function testConstructor($method, $action, $version, $query, $body)
    {
        $request = new GenericRequest($method, $action, $version, $query, $body);

        $this->assertEquals($method, $request->getMethod());
        $this->assertEquals($action, $request->getAction());
        $this->assertEquals($version, $request->getVersion());
        $this->assertEquals($query['param'], $request->toArray()['param']);
        $this->assertEquals($body, $request->getBodyData());
    }

    public static function providerConstructor()
    {
        return [
            [
                Client::POST,
                'ProductCreate',
                GenericRequest::V1,
                ['param' => 'value'],
                [
                    'Product' => [
                        'Brand' => 'Name',
                        'Description' => 'test product description',
                        'Name' => 'Test product',
                        'Price' => 123,
                        'PrimaryCategory' => '12',
                        'TaxClass' => 'default'
                    ]
                ]
            ]
        ];
    }
}
