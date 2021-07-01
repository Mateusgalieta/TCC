<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Phone;
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
    public function register($contact_id)
    {
        $contact = Contact::findOrFail($contact_id);
        return view('contact.address.register', [
            'contact' => $contact ?? null,
        ]);
    }

    /**
     * Create new Phone on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request, $contact_id)
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
                'contact_id' => $contact_id
            ]);

            activity()->log('Endereço ID'. $address->id . ' foi criado.');

            session()->flash('alert-success', 'Criado com sucesso!');
            return redirect()->route('address.index', $contact_id);
        }

        session()->flash('alert-danger', 'Ocorreu um erro');
        return redirect()->route('address.index', $contact_id);
    }

     /**
     * edit page Phone on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($contact_id, $address_id)
    {
        $contact = Contact::findOrFail($contact_id);
        $address = Address::findOrFail($address_id);

        return view('contact.address.edit', [
            'address' => $address ?? null,
            'contact' => $contact ?? null,
        ]);
    }

    /**
     * Update Phone on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $contact_id, $address_id)
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
        return redirect()->route('address.index', $contact_id);
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
