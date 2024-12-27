<?php

namespace RocketLabs\SellerCenterSdk\Core\Response;

class ErrorResponseTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @param array $responseData
     * @param string $expectedMessage
     * @param array $expectedDetails
     * @dataProvider providerConstructor
     */
    public function testConstructor(array $responseData, $expectedMessage, array $expectedDetails)
    {
        $response = new ErrorResponse($responseData);

        $this->assertEquals($expectedMessage, $response->getMessage());
        $this->assertEquals($expectedDetails, $response->getDetails());
    }

    /**
     * @return array
     */
    public static function providerConstructor()
    {
        return [
            'with body and message' => [
                [
                    'Head' => ['ErrorMessage' => 'Error 01'],
                    'Body' => ['PostedData' => ['SomeData' => 1]]
                ],
                'Error 01',
                ['PostedData' => ['SomeData' => 1]],
            ],
            'with message' => [
                [
                    'Head' => ['ErrorMessage' => 'Error 01']
                ],
                'Error 01',
                [],
            ],
            'with body' => [
                [
                    'Head' => [],
                    'Body' => ['PostedData' => ['SomeData' => 1]]
                ],
                '',
                ['PostedData' => ['SomeData' => 1]],
            ],
            'empty' => [
                [],
                '',
                [],
            ]
        ];
    }
}
