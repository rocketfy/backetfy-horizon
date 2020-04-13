<?php

namespace Rocketfy\BacketfyHorizon\Tests\Feature;

use Cake\Chronos\Chronos;
use Illuminate\Support\Facades\Event;
use Rocketfy\BacketfyHorizon\Events\UnableToLaunchProcess;
use Rocketfy\BacketfyHorizon\Events\WorkerProcessRestarting;
use Rocketfy\BacketfyHorizon\Tests\IntegrationTest;
use Rocketfy\BacketfyHorizon\WorkerProcess;
use Symfony\Component\Process\Process;

class WorkerProcessTest extends IntegrationTest
{
    public function test_worker_process_fires_event_if_stopped_process_cant_be_restarted()
    {
        Event::fake();

        $process = new Process(['exit', 1]);
        $workerProcess = new WorkerProcess($process);
        $workerProcess->start(function () {
        });
        sleep(1);
        $workerProcess->monitor();

        Event::assertDispatched(WorkerProcessRestarting::class);
        Event::assertDispatched(UnableToLaunchProcess::class);
    }

    public function test_process_is_not_restarted_during_cooldown_period()
    {
        Event::fake();

        $process = new Process(['exit', 1]);
        $workerProcess = new WorkerProcess($process);
        $workerProcess->start(function () {
        });
        sleep(1);
        $workerProcess->monitor();
        $workerProcess->monitor();

        Event::assertDispatched(WorkerProcessRestarting::class);
        $this->assertCount(1, Event::dispatched(WorkerProcessRestarting::class));
    }

    public function test_process_is_restarted_after_cooldown_period()
    {
        Event::fake();

        $process = new Process(['exit', 1]);
        $workerProcess = new WorkerProcess($process);
        $workerProcess->start(function () {
        });

        // Give process time to start...
        sleep(1);

        // Should fail and set cooldown timestamp...
        $workerProcess->monitor();
        $this->assertTrue($workerProcess->coolingDown());

        // Travel to the future...
        sleep(1);
        Chronos::setTestNow(Chronos::now()->addMinutes(3));
        $this->assertFalse($workerProcess->coolingDown());

        // Should try to restart now...
        $workerProcess->monitor();

        Event::assertDispatched(WorkerProcessRestarting::class);
        $this->assertCount(2, Event::dispatched(WorkerProcessRestarting::class));

        Chronos::setTestNow();
    }
}
