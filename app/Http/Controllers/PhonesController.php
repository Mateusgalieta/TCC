<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Phone;
use App\Models\Contact;
use Illuminate\Http\Request;

class PhonesController extends Controller
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
            $phones_list = Phone::where('contact_id', $contact_id)->where('phone', 'like', '%'. $data['search']. '%')->paginate();
        else
            $phones_list = Phone::where('contact_id', $contact_id)->paginate();

        return view('contact.phone.index', [
            'phones_list' => $phones_list ?? [],
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
        return view('contact.phone.register', [
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
            'phone' => 'required|string',
            'type'  => 'required|integer',
        ]);

        $data = $request->all();

        if($data){
            $phone = Phone::create([
                'type' => $data['type'],
                'phone' => $data['phone'],
                'contact_id' => $contact_id
            ]);

            activity()->log('Telefone/Celular ID'. $phone->id . ' foi criado.');

            session()->flash('alert-success', 'Criado com sucesso!');
            return redirect()->route('phone.index', $contact_id);
        }

        session()->flash('alert-danger', 'Ocorreu um erro');
        return redirect()->route('phone.index', $contact_id);
    }

     /**
     * edit page Phone on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($contact_id, $phone_id)
    {
        $contact = Contact::findOrFail($contact_id);
        $phone = Phone::findOrFail($phone_id);

        return view('contact.phone.edit', [
            'phone' => $phone ?? null,
            'contact' => $contact ?? null,
        ]);
    }

    /**
     * Update Phone on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $contact_id, $phone_id)
    {
        $data = $request->all();

        $request->validate([
            'type' => 'required|integer',
            'phone' => 'required|integer',
        ]);

        //Deixei o validate sem mensagem propositalmente para mostra a validação do backend.

        $phone = Phone::findOrFail($phone_id);
        $phone->update($data);

        activity()->log('Telefone/Celular ID'. $phone->id . ' foi atualizado.');

        session()->flash('alert-success', 'Atualizado com sucesso!');
        return redirect()->route('phone.index', $contact_id);
    }

    /**
     * Delete Phone on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($contact_id, $phone_id)
    {
        $phone = Phone::findOrFail($phone_id);
        $phone->delete();

        activity()->log('Telefone/Celular ID'. $phone->id . ' foi deletado.');

        session()->flash('alert-success', 'Deletado com sucesso!');
        return redirect()->back();
    }

}
