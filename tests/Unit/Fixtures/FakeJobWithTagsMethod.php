<?php

namespace Rocketfy\BacketfyHorizon\Tests\Unit\Fixtures;

class FakeJobWithTagsMethod
{
    public function tags()
    {
        return [
            'first',
            'second',
        ];
    }
}
