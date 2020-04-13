<?php

namespace Rocketfy\BacketfyHorizon\Listeners;

use Rocketfy\BacketfyHorizon\Contracts\TagRepository;
use Rocketfy\BacketfyHorizon\Events\JobPushed;

class StoreMonitoredTags
{
    /**
     * The tag repository implementation.
     *
     * @var \Rocketfy\BacketfyHorizon\Contracts\TagRepository
     */
    public $tags;

    /**
     * Create a new listener instance.
     *
     * @param  \Rocketfy\BacketfyHorizon\Contracts\TagRepository  $tags
     * @return void
     */
    public function __construct(TagRepository $tags)
    {
        $this->tags = $tags;
    }

    /**
     * Handle the event.
     *
     * @param  \Rocketfy\BacketfyHorizon\Events\JobPushed  $event
     * @return void
     */
    public function handle(JobPushed $event)
    {
        $monitoring = $this->tags->monitored($event->payload->tags());

        if (! empty($monitoring)) {
            $this->tags->add($event->payload->id(), $monitoring);
        }
    }
}
