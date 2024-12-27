<?php

namespace RocketLabs\SellerCenterSdk\Core;

use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    /**
     * @param string $url
     * @param string $user
     * @dataProvider providerConstructorWithValidConfig
     */
    public function testConstructorWithValidConfig($url, $user)
    {
        $config = new Configuration($url, $user, 'anything');

        $this->assertEquals($url, $config->getUrl());
        $this->assertEquals($user, $config->getUser());
        $this->assertEquals('anything', $config->getKey());
    }

    /**
     * @param string $url
     * @param string $user
     * @param string $expectedMessage
     * @dataProvider providerConstructorWithInvalidConfig
     */
    public function testConstructorWithInvalidConfig($url, $user, $expectedMessage)
    {
        $this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage($expectedMessage);

        new Configuration($url, $user, 'anything');
    }

    /**
     * @return array
     */
    public static function providerConstructorWithValidConfig()
    {
        return [
            'valid data' => [
                'url' => 'https://api.sellercenter.someventure.de/',
                'user' => 'api@someseller.de'
            ]
        ];
    }

    /**
     * @return array
     */
    public static function providerConstructorWithInvalidConfig()
    {
        return [
            'invalid url (not an url)' => [
                'not-an-url',
                'api@someseller.de',
                'Provided url for Seller Center Api "not-an-url" is invalid'
            ],
            'invalid url (url without host)' => [
                'https:///api.php/',
                'api@someseller.de',
                'Provided url for Seller Center Api "https:///api.php/" is invalid'
            ],
            'invalid url (url without schema)' => [
                '//api.sellercenter.someventure.de/',
                'api@someseller.de',
                'Provided url for Seller Center Api "//api.sellercenter.someventure.de/" is invalid'
            ],
            'invalid schema' => [
                'ftp://api.sellercenter.someventure.de',
                'api@someseller.de',
                'The scheme of provided url "ftp://api.sellercenter.someventure.de" is invalid, please use one of following schemas "http", "https"'
            ],
            'invalid user' => [
                'https://api.sellercenter.someventure.de',
                'api.someseller.de',
                'Provided user for Seller Center Api "api.someseller.de" is invalid'
            ],
        ];
    }
}
