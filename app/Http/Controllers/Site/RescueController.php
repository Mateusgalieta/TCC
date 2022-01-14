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
            $address = Address::create([
                'address' => $data['address'],
                'cep' => $data['cep'],
                'neighborhood' => $data['neighborhood'],
                'city' => $data['city'],
                'state' => $data['state'],
                'origin' => 2,
            ]);

            $rescue = Rescue::create([
                'reporter' => $data['reporter'],
                'animal_name' => $data['name'],
                'organization_id' => $data['organization_id'],
                'address_id' => $address->id,
                'status' => 'AGUARDANDO',
                'observations' => $data['observations']
            ]);

            activity()->log('Resgate ID'. $rescue->id . ' foi criado.');

            return redirect()->route('site.rescue.index')->with('success', 'Resgate Criado com sucesso!');
        }

        return redirect()->route('site.rescue.index')->with('error', 'Ocorreu um erro');
    }

}

