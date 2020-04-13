<?php

namespace Rocketfy\BacketfyHorizon\Tests\Unit\Fixtures;

class FakeEventWithModel
{
    public $model;

    public function __construct($id)
    {
        $this->model = new FakeModel;
        $this->model->id = $id;
    }
}
