<?php

namespace Rocketfy\BacketfyHorizon\Tests\Feature\Jobs;

class LegacyJob
{
    public function fire($job, $data)
    {
        $job->delete();
    }
}
