<?php

namespace RocketLabs\SellerCenterSdk\Endpoint\Product\Response;

/**
 * Class FeedIdResponseTest
 */
class FeedIdResponseTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider providerGetFeedId
     * @param $responseData
     * @param $expectedFeedId
     */
    public function testGetFeedId($responseData, $expectedFeedId)
    {
        $response = new FeedIdResponse($responseData);

        $this->assertEquals($expectedFeedId, $response->getFeedId());
    }

    /**
     * @return array
     */
    public static function providerGetFeedId()
    {
        return [
            [
                [
                    'Head' => [
                        'Action' => 'Image',
                        'RequestId' => '000-000-r0003-frrw43'
                    ],
                    'Body' => []
                ],
                '000-000-r0003-frrw43'
            ]
        ];
    }


}
