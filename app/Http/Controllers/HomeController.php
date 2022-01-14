<?php

namespace App\Http\Controllers;

use App\Models\Rescue;
use App\Models\Transfer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $organization_id = auth()->user()->organization_id;
        $rescues_list = Rescue::where('organization_id', auth()->user()->organization_id)
            ->where('status', 'AGUARDANDO')
            ->paginate();

        $transfers_list = Transfer::where('toOrganization', $organization_id)
            ->where('status', 'AGUARDANDO')
            ->paginate();

        return view('home', [
            'rescues_list' => $rescues_list,
            'transfers_list' => $transfers_list
        ]);
    }
}
