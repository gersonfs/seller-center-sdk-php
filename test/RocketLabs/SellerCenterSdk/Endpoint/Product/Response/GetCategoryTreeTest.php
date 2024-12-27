<?php

namespace RocketLabs\SellerCenterSdk\Endpoint\Product\Response;

use RocketLabs\SellerCenterSdk\Endpoint\Product\Model\Category;
use RocketLabs\SellerCenterSdk\Endpoint\Product\Model\CategoryCollection;

/**
 * Class GetCategoryTreeTest
 */
class GetCategoryTreeTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider constructProvider
     * @param int $count
     * @param array $data
     */
    public function testConstruct($count, array $data)
    {
        $response = new GetCategoryTree($data);

        $this->assertInstanceOf(CategoryCollection::class, $response->getCategories());
        $this->assertSame($count, $response->getCategories()->count());
    }

    /**
     * @return array
     */
    public static function constructProvider()
    {
        return [
            'valid data with 2+ categories' => [
                2,
                [
                    'Head' => [],
                    'Body' => [
                        'Categories' => [
                            'Category' => [
                                [
                                    Category::NAME => 'First Category',
                                    Category::CATEGORY_ID => 1,
                                    Category::GLOBAL_IDENTIFIER => '123G1',
                                ],
                                [
                                    Category::NAME => 'Second Category',
                                    Category::CATEGORY_ID => 2,
                                    Category::GLOBAL_IDENTIFIER => '123G221'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'valid data with 1 category' => [
                1,
                [
                    'Head' => [],
                    'Body' => [
                        'Categories' => [
                            'Category' => [
                                [
                                    Category::NAME => 'First Category',
                                    Category::CATEGORY_ID => 1,
                                    Category::GLOBAL_IDENTIFIER => '123G1',
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'empty brand' => [
                0,
                [
                    'Head' => [],
                    'Body' => []
                ]
            ],
        ];
    }

}
