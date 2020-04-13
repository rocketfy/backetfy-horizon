<?php

namespace Rocketfy\BacketfyHorizon\Tests\Feature\Jobs;

class BasicJob
{
    public function handle()
    {
        //
    }

    public function tags()
    {
        return ['first', 'second'];
    }
}
