<?php

namespace App\Http\Controllers\Site;

use AddressOrigin;
use App\Models\Animal;
use App\Models\Rescue;
use App\Models\Address;
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
            $animal = Animal::create([
                'name' => $data['name'],
                'rescuer_name' => $data['reporter'],
                'organization_id' => $data['organization_id']
            ]);

            $address = Address::create([
                'address' => $data['address'],
                'cep' => $data['cep'],
                'neighborhood' => $data['neighborhood'],
                'city' => $data['city'],
                'state' => $data['state'],
                'animal_id' => $animal->id,
                'origin' => 2,
            ]);

            $animal->update(['address_id' => $address->id]);

            $rescue = Rescue::create([
                'reporter' => $data['reporter'],
                'animal_name' => $data['name'],
                'organization_id' => $data['organization_id'],
                'address_id' => $address->id,
                'animal_id' => $animal->id,
            ]);

            activity()->log('Resgate ID'. $rescue->id . ' foi criado.');

            return redirect()->back()->with('success', 'Resgate Criado com sucesso!');
        }

        return redirect()->back()->with('error', 'Ocorreu um erro');
    }

}

