<?php

namespace NavigaAdClient\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            \NavigaAdClient\ServiceProvider::class,
        ];
    }

    public function defineEnvironment($app)
    {
        $app['config']->set('naviga-ad.options', [
            'guzzle'  => [],
            'retry'   => [2, 5],
            'timeout' => 10,
            'headers' => [],
        ]);
        $app['config']->set('naviga-ad.credentials', [
            'username' => 'test_user',
            'password' => 'test_secret',
        ]);
        $app['config']->set('naviga-ad.base_url', 'https://test.request');
    }
}
