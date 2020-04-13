<?php

namespace Rocketfy\BacketfyHorizon\Http\Controllers;

use Rocketfy\BacketfyHorizon\Jobs\RetryFailedJob;

class RetryController extends Controller
{
    /**
     * Retry a failed job.
     *
     * @param  string  $id
     * @return void
     */
    public function store($id)
    {
        dispatch(new RetryFailedJob($id));
    }
}
