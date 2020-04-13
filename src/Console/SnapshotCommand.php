<?php

namespace Rocketfy\BacketfyHorizon\Console;

use Illuminate\Console\Command;
use Rocketfy\BacketfyHorizon\Contracts\MetricsRepository;
use Rocketfy\BacketfyHorizon\Lock;

class SnapshotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'horizon:snapshot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store a snapshot of the queue metrics';

    /**
     * Execute the console command.
     *
     * @param  \Rocketfy\BacketfyHorizon\Lock  $lock
     * @param  \Rocketfy\BacketfyHorizon\Contracts\MetricsRepository  $metrics
     * @return void
     */
    public function handle(Lock $lock, MetricsRepository $metrics)
    {
        if ($lock->get('metrics:snapshot', 300)) {
            $metrics->snapshot();

            $this->info('Metrics snapshot stored successfully.');
        }
    }
}
