<?php

namespace Rocketfy\BacketfyHorizon\Tests\Feature;

use Laravel\Facades\Config;
use Rocketfy\BacketfyHorizon\Horizon;
use Rocketfy\BacketfyHorizon\Tests\IntegrationTest;

class RedisPrefixTest extends IntegrationTest
{
    public function test_prefix_can_be_configured()
    {
        config(['horizon.prefix' => 'custom:']);

        Horizon::use('default');

        $this->assertEquals('custom:', config('database.redis.horizon.options.prefix'));
    }
}
