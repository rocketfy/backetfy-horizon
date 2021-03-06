<?php

namespace Rocketfy\BacketfyHorizon\Repositories;

use Illuminate\Contracts\Queue\Factory as QueueFactory;
use Illuminate\Support\Str;
use Rocketfy\BacketfyHorizon\Contracts\MasterSupervisorRepository;
use Rocketfy\BacketfyHorizon\Contracts\SupervisorRepository;
use Rocketfy\BacketfyHorizon\Contracts\WorkloadRepository;
use Rocketfy\BacketfyHorizon\WaitTimeCalculator;

class RedisWorkloadRepository implements WorkloadRepository
{
    /**
     * The queue factory implementation.
     *
     * @var \Illuminate\Contracts\Queue\Factory
     */
    public $queue;

    /**
     * The wait time calculator instance.
     *
     * @var \Rocketfy\BacketfyHorizon\WaitTimeCalculator
     */
    public $waitTime;

    /**
     * The master supervisor repository implementation.
     *
     * @var \Rocketfy\BacketfyHorizon\Contracts\MasterSupervisorRepository
     */
    private $masters;

    /**
     * The supervisor repository implementation.
     *
     * @var \Rocketfy\BacketfyHorizon\Contracts\SupervisorRepository
     */
    private $supervisors;

    /**
     * Create a new repository instance.
     *
     * @param  \Illuminate\Contracts\Queue\Factory  $queue
     * @param  \Rocketfy\BacketfyHorizon\WaitTimeCalculator  $waitTime
     * @param  \Rocketfy\BacketfyHorizon\Contracts\MasterSupervisorRepository  $masters
     * @param  \Rocketfy\BacketfyHorizon\Contracts\SupervisorRepository  $supervisors
     * @return void
     */
    public function __construct(QueueFactory $queue, WaitTimeCalculator $waitTime,
                                MasterSupervisorRepository $masters, SupervisorRepository $supervisors)
    {
        $this->queue = $queue;
        $this->masters = $masters;
        $this->waitTime = $waitTime;
        $this->supervisors = $supervisors;
    }

    /**
     * Get the current workload of each queue.
     *
     * @return array
     */
    public function get()
    {
        $processes = $this->processes();

        return collect($this->waitTime->calculate())
            ->map(function ($waitTime, $queue) use ($processes) {
                [$connection, $queueName] = explode(':', $queue, 2);

                $length = ! Str::contains($queue, ',')
                    ? $this->queue->connection($connection)->readyNow($queueName)
                    : collect(explode(',', $queueName))->sum(function ($queueName) use ($connection) {
                        return $this->queue->connection($connection)->readyNow($queueName);
                    });

                return [
                    'name' => $queueName,
                    'length' => $length,
                    'wait' => $waitTime,
                    'processes' => $processes[$queue] ?? 0,
                ];
            })->values()->toArray();
    }

    /**
     * Get the number of processes of each queue.
     *
     * @return array
     */
    private function processes()
    {
        return collect($this->supervisors->all())->pluck('processes')->reduce(function ($final, $queues) {
            foreach ($queues as $queue => $processes) {
                $final[$queue] = isset($final[$queue]) ? $final[$queue] + $processes : $processes;
            }

            return $final;
        }, []);
    }
}
