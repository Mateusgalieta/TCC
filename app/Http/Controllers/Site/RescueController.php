<?php

namespace App\Http\Controllers\Site;

use AddressOrigin;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RescueController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the Animal Index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $organizations = Organization::all();

        return view('rescue', [
            'organizations' => $organizations ?? [],
        ]);
    }

}

