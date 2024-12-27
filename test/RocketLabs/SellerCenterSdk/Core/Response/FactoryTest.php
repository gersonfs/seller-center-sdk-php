<?php

namespace RocketLabs\SellerCenterSdk\Core\Response;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;
use RocketLabs\SellerCenterSdk\Core\Exception\ApiException;

class FactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param HttpResponseInterface $httpResponse
     * @param string $expectedClass
     * @param array $expectedBody
     * @param array $expectedHead
     * @dataProvider providerBuildResponse
     */
    public function testBuildResponse(
        HttpResponseInterface $httpResponse,
        $expectedClass,
        array $expectedBody,
        array $expectedHead
    ) {
        $response = (new Factory())->buildResponse($httpResponse);

        $this->assertInstanceOf($expectedClass, $response);
        $this->assertEquals($expectedBody, $response->getBody());
        $this->assertEquals($expectedHead, $response->getHead());
    }

    /**
     * @param HttpResponseInterface $response
     * @dataProvider providerBuildResponseForNonSuccessfulRequest
     */
    public function testBuildResponseForNonSuccessfulRequest(HttpResponseInterface $response)
    {
		$this->expectException(ApiException::class);
        (new Factory())->buildResponse($response);
    }

    /**
     * @return array
     */
    public static function providerBuildResponse()
    {
        return [
            'error response' => [
                new Response(
                    200,
                    [],
                    json_encode([
                        'ErrorResponse' => [
                            'Head' => [
                                'ErrorMessage' => 'Error 00'
                            ],
                            'Body' => new \stdClass()
                        ]
                    ])
                ),
                ErrorResponse::class,
                [],
                ['ErrorMessage' => 'Error 00'],
            ],
            'generic response' => [
                new Response(
                    200,
                    [],
                    json_encode([
                        'SuccessResponse' => [
                            'Head' => [
                                'Action' => 'DoSomething',
                                'RequestId' => '000-000-r0003-frrw43'
                            ],
                            'Body' => [
                                'SomeData' => 'value'
                            ]
                        ]
                    ])
                ),
                GenericResponse::class,
                [
                    'SomeData' => 'value'
                ],
                [
                    'Action' => 'DoSomething',
                    'RequestId' => '000-000-r0003-frrw43'
                ],
            ]
        ];
    }

    /**
     * @return array
     */
    public static function providerBuildResponseForNonSuccessfulRequest()
    {
        return [
            'redirect response' => [
                new Response(301)
            ],
            'server error response' => [
                new Response(500)
            ],
            'invalid response' => [
                new Response(200, [], 'it-is-not-json-data')
            ]
        ];
    }
}
