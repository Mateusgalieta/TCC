<?php

namespace App\Http\Controllers;

use AddressOrigin;
use App\Models\User;
use App\Models\Animal;
use App\Models\Organization;
use Illuminate\Http\Request;

class AnimalsController extends Controller
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
     * Show the Animal Index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $organization_id = auth()->user()->organization_id;

        if(isset($data['search']))
            $animal_list = Animal::where('organization_id', $organization_id)->where('name', 'like', '%'. $data['search']. '%')->paginate();
        else
            $animal_list = Animal::paginate();

        return view('animal.index', [
            'animal_list' => $animal_list ?? [],
        ]);
    }

    /**
     * Redirect to Register Animal page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function register()
    {
        return view('animal.register');
    }

    /**
     * Create new Animal on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string',
            'rescuer_name'  => 'required|string',
        ]);

        $data = $request->all();
        $organization_id = auth()->user()->organization_id;


        if($data){
            $animal = Animal::create($data);

            $address = Address::create([
                'origin' => AddressOrigin::RESCUE,
                'cep' => $data['cep'],
                'address' => $data['address'],
                'neighborhood' => $data['neighborhood'],
                'city' => $data['city'],
                'state' => $data['state'],
                'organization_id' => $organization_id,
                'animal_id' => $animal->id,
            ]);

            activity()->log('Animal ID'. $organization->id . ' foi criado.');
            activity()->log('Endereço de resgate ID'. $address->id . ' foi criado.');

            session()->flash('alert-success', 'Criado com sucesso!');
            return redirect()->route('animal.index');
        }

        session()->flash('alert-danger', 'Ocorreu um erro');
        return redirect()->route('animal.index');
    }

     /**
     * edit page Animal on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($animal_id)
    {
        $animal = Animal::findOrFail($animal_id);

        return view('animal.edit', [
            'animal' => $animal ?? null,
        ]);
    }

    /**
     * Update Animal on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $animal_id)
    {
        $data = $request->all();

        $animal = Animal::findOrFail($animal_id);
        $animal->update($data);

        activity()->log('Animal ID'. $animal->id . ' foi atualizado.');

        session()->flash('alert-success', 'Atualizado com sucesso!');
        return redirect()->route('organization.index');
    }

    /**
     * Delete Animal on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($organization_id)
    {
        $organization = Animal::findOrFail($organization_id);
        $organization->delete();

        activity()->log('Organização ID'. $organization->id . ' foi deletado.');

        session()->flash('alert-success', 'Deletado com sucesso!');
        return redirect()->back();
    }

}

