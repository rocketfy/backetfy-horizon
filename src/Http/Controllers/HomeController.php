<?php

namespace Rocketfy\BacketfyHorizon\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Rocketfy\BacketfyHorizon\Horizon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->menu = [];
        $this->active_item = 'horizon';
        $this->active_item_config = '';
    }
    /**
     * Single page application catch-all route.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('horizon::layout', [
            'cssFile' => Horizon::$useDarkTheme ? 'app-dark.css' : 'app.css',
            'horizonScriptVariables' => Horizon::scriptVariables(),
            'assetsAreCurrent' => Horizon::assetsAreCurrent(),
            'active_item' => 'horizon',
            'nocard' => 1,
        ]);
    }
}
