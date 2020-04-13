<?php

namespace Rocketfy\BacketfyHorizon\Listeners;

use Rocketfy\BacketfyHorizon\Contracts\TagRepository;
use Rocketfy\BacketfyHorizon\Events\JobFailed;

class StoreTagsForFailedJob
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
     * @param  \Rocketfy\BacketfyHorizon\Events\JobFailed  $event
     * @return void
     */
    public function handle(JobFailed $event)
    {
        $tags = collect($event->payload->tags())->map(function ($tag) {
            return 'failed:'.$tag;
        })->all();

        $this->tags->addTemporary(
            2880, $event->payload->id(), $tags
        );
    }
}
