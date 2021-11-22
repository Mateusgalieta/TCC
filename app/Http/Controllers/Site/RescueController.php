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

     /**
     * Create new Rescue on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {
        $data = $request->all();

        if($data){
            $animal = Animal::create($data);

            activity()->log('Animal ID'. $animal->id . ' foi criado.');

            session()->flash('alert-success', 'Criado com sucesso!');
            return redirect()->route('address.register', [$animal->id]);
        }

        session()->flash('alert-danger', 'Ocorreu um erro');
        return redirect()->route('animal.index');
    }

}

