<?php

namespace RocketLabs\SellerCenterSdk\Core\Response;

class AbstractResponseTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @param array $responseData
     * @param array $expectedHead
     * @param array $expectedBody
     * @dataProvider providerConstructor()
     */
    public function testConstructor(array $responseData, array $expectedHead, array $expectedBody)
    {
        $response = new AbstractResponse($responseData);

        $this->assertEquals($expectedHead, $response->getHead());
        $this->assertEquals($expectedBody, $response->getBody());
    }

    /**
     * @return array
     */
    public static function providerConstructor()
    {
        return [
            'complete response' => [
                [
                    'Head' => [
                        'Action' => 'DoSomething',
                        'RequestId' => '000-000-r0003-frrw43'
                    ],
                    'Body' => [
                        'SomeData' => 'value'
                    ]
                ],
                [
                    'Action' => 'DoSomething',
                    'RequestId' => '000-000-r0003-frrw43'
                ],
                ['SomeData' => 'value']
            ],
            'response without body' => [
                [
                    'Head' => [
                        'Action' => 'DoSomething',
                        'RequestId' => '000-000-r0003-frrw43'
                    ]
                ],
                [
                    'Action' => 'DoSomething',
                    'RequestId' => '000-000-r0003-frrw43'
                ],
                []
            ],
            'response without head' => [
                [
                    'Body' => [
                        'SomeData' => 'value'
                    ]
                ],
                [],
                ['SomeData' => 'value']
            ],
            'empty response' => [
                [],
                [],
                []
            ],
        ];
    }

}
