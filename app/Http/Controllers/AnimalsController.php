<?php

namespace App\Http\Controllers;

use AddressOrigin;
use App\Models\User;
use App\Models\Animal;
use App\Models\Category;
use App\Models\Transfer;
use Barryvdh\DomPDF\PDF;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Exports\AnimalsExport;
use Maatwebsite\Excel\Facades\Excel;

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
            $animal_list = Animal::where('organization_id', $organization_id)->paginate();

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
        $organization_id = auth()->user()->organization_id;

        return view('animal.register', [
            'category_list' => Category::where('organization_id', $organization_id)->get(),
        ]);
    }

    /**
     * Redirect to Transfer Animal page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function transfers()
    {
        $organization_id = auth()->user()->organization_id;
        $transfers_list = Transfer::where('toOrganization', $organization_id)
            ->orWhere('fromOrganization', $organization_id)
            ->where('status', 'AGUARDANDO')
            ->paginate();

        return view('animal.transfers', [
            'transfers_list' => $transfers_list,
        ]);
    }

    /**
     * Redirect to Transfer Animal page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function transferPage($animal_id)
    {
        $organization_id = auth()->user()->organization_id;
        $animal = Animal::findOrFail($animal_id);
        $organization_list = Organization::where('id', '!=', $organization_id)->get();

        return view('animal.transfer', [
            'animal' => $animal,
            'organization_list' => $organization_list
        ]);
    }

    /**
     * Create new Animal Transfer on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function transferCreate(Request $request, $animal_id)
    {
        $organization_id = auth()->user()->organization_id;
        $data = $request->all();
        $animal = Animal::findOrFail($animal_id);

        if($animal){
            $transfer = Transfer::create([
                'fromOrganization' => $organization_id,
                'toOrganization' => $data['toOrganization'],
                'animal_id' => $animal_id,
                'status'   =>  'AGUARDANDO'
            ]);

            activity()->log('Solicitação de transferência de animal');

            session()->flash('alert-success', 'Criado com sucesso!');
            return redirect()->route('animal.index');
        }

        session()->flash('alert-danger', 'Ocorreu um erro');
        return redirect()->route('animal.index');
    }

    /**
     * Method to transfer animal into two organization
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function approveTransfer(Request $request, $transfer_id)
    {
        $organization_id = auth()->user()->organization_id;
        $data = $request->all();
        $transfer = Transfer::findOrFail($transfer_id);

        if($transfer){
            $transfer->update([
                'status' => 'APROVADO',
            ]);

            $categoryName = $transfer->animal->category->name;
            $verifyCategory = Category::where('organization_id', $organization_id)
                ->where('name', $categoryName)
                ->first();

            if(!$verifyCategory) {
                $category = Category::create([
                    'name' => $categoryName,
                    'organization_id' => $organization_id
                ]);
            }
            else {
                $category = $transfer->animal->category;
            }

            if($transfer->animal->rescue) {
                $transfer->animal->rescue->update([
                    'organization_id' => $organization_id
                ]);
            }

            $transfer->animal->update([
                'organization_id' => $organization_id,
                'category_id' => $category->id
            ]);

            activity()->log('Solicitação de transferência aprovada');

            session()->flash('alert-success', 'Aprovado com sucesso!');
            return redirect()->route('animal.transfers');
        }

        session()->flash('alert-danger', 'Ocorreu um erro');
        return redirect()->route('animal.transfers');
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
            'category_id'  => 'required',
        ]);

        $data = $request->all();
        $organization_id = auth()->user()->organization_id;
        $data['organization_id'] = $organization_id;

        if($data){
            $animal = Animal::create($data);

            activity()->log('Animal '. $animal->name . ' foi criado.');

            session()->flash('alert-success', 'Criado com sucesso!');
            return redirect()->route('address.register', [$animal->id]);
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
        $organization_id = auth()->user()->organization_id;
        $animal = Animal::findOrFail($animal_id);

        return view('animal.edit', [
            'animal' => $animal ?? null,
            'category_list' => Category::where('organization_id', $organization_id)->get() ?? [],
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

        activity()->log('Animal '. $animal->name . ' foi atualizado.');

        session()->flash('alert-success', 'Atualizado com sucesso!');
        return redirect()->route('animal.index');
    }

    /**
     * Delete Animal on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($organization_id)
    {
        $organization = Animal::findOrFail($organization_id);

        activity()->log('Animal '. $animal->name . ' foi deletado.');

        $organization->delete();

        session()->flash('alert-success', 'Deletado com sucesso!');
        return redirect()->back();
    }

    /**
     * Export PDF of animals
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pdfExport()
    {
        $organization_id = auth()->user()->organization_id;
        $organization = Organization::find($organization_id);
        $animal_list = Animal::where('organization_id', $organization_id)->get();
        $animal_list = collect($animal_list);

        $pdf = \PDF::loadView('template.animals', compact('organization', 'animal_list'));
        // download PDF file with download method
        return $pdf->download('animais-exportados.pdf');
    }

    /**
     * Export Excel of animals
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function excelExport()
    {
        return Excel::download(new AnimalsExport, 'animais-exportados.xlsx');
    }
}

