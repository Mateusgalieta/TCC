<?php

namespace App\Http\Controllers;

use App\Enums\AddressOrigin;
use App\Models\User;
use App\Models\Phone;
use App\Models\Animal;
use App\Models\Address;
use App\Models\Contact;
use Illuminate\Http\Request;

class AddressesController extends Controller
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
     * Show the Phone Index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $contact_id)
    {
        $data = $request->all();
        $contact = Contact::findOrFail($contact_id);

        if(isset($data['search']))
            $addresses_list = Address::where('contact_id', $contact_id)->where('address', 'like', '%'. $data['search']. '%')->paginate();
        else
            $addresses_list = Address::where('contact_id', $contact_id)->paginate();

        return view('contact.address.index', [
            'addresses_list' => $addresses_list ?? [],
            'contact' => $contact ?? null,
        ]);
    }

    /**
     * Redirect to Register Phone page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function register($animal_id)
    {
        $animal = Animal::findOrFail($animal_id);
        return view('animal.address.register', [
            'animal' => $animal ?? null,
        ]);
    }

    /**
     * Create new Phone on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'address' => 'required|string',
            'cep'  => 'required|string',
            'neighborhood'  => 'required|string',
            'city'  => 'required|string',
            'state'  => 'required|string',
        ]);

        $data = $request->all();

        if($data){
            $address = Address::create([
                'address' => $data['address'],
                'cep' => $data['cep'],
                'neighborhood' => $data['neighborhood'],
                'city' => $data['city'],
                'state' => $data['state'],
                'animal_id' => $data['animal_id'],
                'origin' => 2,
            ]);

            activity()->log('Endereço de Resgate ID'. $address->id . ' foi criado.');

            $animal = Animal::findOrFail($data['animal_id']);
            $animal->update(['address_id' => $address->id]);

            session()->flash('alert-success', 'Criado com sucesso!');
            return redirect()->route('animal.index');
        }

        session()->flash('alert-danger', 'Ocorreu um erro');
        return redirect()->route('animal.index');

    }

     /**
     * edit page Phone on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($address_id)
    {
        $address = Address::findOrFail($address_id);

        return view('animal.address.edit', [
            'address' => $address ?? null,
        ]);
    }

    /**
     * Update Phone on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $address_id)
    {
        $data = $request->all();

        $request->validate([
            'address' => 'required|string',
            'cep'  => 'required|string',
            'neighborhood'  => 'required|string',
            'city'  => 'required|string',
            'state'  => 'required|string',
        ]);

        //Deixei o validate sem mensagem propositalmente para mostrar a validação do backend.

        $address = Address::findOrFail($address_id);
        $address->update($data);

        activity()->log('Endereço ID'. $address->id . ' foi editado.');

        session()->flash('alert-success', 'Atualizado com sucesso!');
        return redirect()->route('animal.index');
    }

    /**
     * Delete Phone on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($contact_id, $address_id)
    {
        $address = Address::findOrFail($address_id);
        $address->delete();

        activity()->log('Endereço ID'. $address->id . ' foi deletado.');

        session()->flash('alert-success', 'Deletado com sucesso!');
        return redirect()->back();
    }

}
