<?php

namespace Rocketfy\BacketfyHorizon\Tests\Feature;

use Rocketfy\BacketfyHorizon\Events\SupervisorLooped;
use Rocketfy\BacketfyHorizon\Listeners\MonitorSupervisorMemory;
use Rocketfy\BacketfyHorizon\Supervisor;
use Rocketfy\BacketfyHorizon\SupervisorOptions;
use Rocketfy\BacketfyHorizon\Tests\IntegrationTest;
use Mockery;

class MonitorSupervisorMemoryTest extends IntegrationTest
{
    public function test_supervisor_is_terminated_when_using_too_much_memory()
    {
        $monitor = new MonitorSupervisorMemory;

        $supervisor = Mockery::mock(Supervisor::class);
        $supervisor->options = new SupervisorOptions('redis', 'default');

        $supervisor->shouldReceive('memoryUsage')->andReturn(192);
        $supervisor->shouldReceive('terminate')->once()->with(12);

        $monitor->handle(new SupervisorLooped($supervisor));
    }

    public function test_supervisor_is_not_terminated_when_using_low_memory()
    {
        $monitor = new MonitorSupervisorMemory;

        $supervisor = Mockery::mock(Supervisor::class);
        $supervisor->options = new SupervisorOptions('redis', 'default');

        $supervisor->shouldReceive('memoryUsage')->andReturn(64);
        $supervisor->shouldReceive('terminate')->never();

        $monitor->handle(new SupervisorLooped($supervisor));
    }
}
