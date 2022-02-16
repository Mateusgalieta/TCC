<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Rescue;
use App\Models\Address;
use Barryvdh\DomPDF\PDF;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Exports\RescuesExport;
use Maatwebsite\Excel\Facades\Excel;

class RescuesController extends Controller
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
     * Show the Rescue Index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $rescues_list = Rescue::where('organization_id', auth()->user()->organization_id)
            ->where('status', 'FINALIZADO')
            ->paginate();

        return view('rescue.index', [
            'rescues_list' => $rescues_list ?? [],
        ]);
    }

    /**
     * Show the Rescue Pending list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function rescuesPending()
    {
        $rescues_list = Rescue::where('organization_id', auth()->user()->organization_id)
            ->where('status', 'AGUARDANDO')
            ->paginate();

        return view('rescue.pending', [
            'rescues_list' => $rescues_list ?? [],
        ]);
    }

    /**
     * Show the Rescue Pending list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function confirm($rescue_id)
    {
        $rescue = Rescue::findOrFail($rescue_id);

        if ($rescue) {
            $address = $rescue->address->first() ?? null;

            $animal = Animal::create([
                'name' => $rescue->animal_name,
                'rescuer_name' => $rescue->reporter,
                'organization_id' => $rescue->organization_id,
                'address_id'  =>  $address->id
            ]);

            $rescue->update([
                'status' => 'FINALIZADO',
                'animal_id' => $animal->id
            ]);

            activity()->log('O Resgate do animal ' . $rescue->name . ' foi confirmado.');

            session()->flash('alert-success', 'Confirmado com sucesso!');
            return redirect()->route('rescue.intern.list');
        }

        session()->flash('alert-danger', 'Ocorreu um erro!');
        return redirect()->back();
    }

    /**
     * Redirect to Register Rescue page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function register()
    {
        return view('rescue.register');
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
            $rescue = Rescue::create($data);

            if($data){
                $animal = Animal::create([
                    'name' => $data['name'],
                    'rescuer_name' => $data['reporter'],
                    'organization_id' => auth()->user()->organization_id
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
                    'organization_id' => auth()->user()->organization_id,
                    'address_id' => $address->id,
                    'animal_id' => $animal->id,
                ]);
            }

            activity()->log('Resgate do animal  ' . $rescue->name . ' foi criado.');

            session()->flash('alert-success', 'Criado com sucesso!');
            return redirect()->route('rescue.intern.list');
        }

        session()->flash('alert-danger', 'Ocorreu um erro');
        return redirect()->route('rescue.intern.list');
    }

     /**
     * edit page Rescue on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($rescue_id)
    {
        $rescue = Rescue::findOrFail($rescue_id);

        return view('rescue.edit', [
            'rescue' => $rescue ?? null,
        ]);
    }

    /**
     * Update Rescue on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $rescue_id)
    {
        $data = $request->all();
        $rescue = Rescue::findOrFail($rescue_id);

        if($data && $rescue){
            $rescue->animal->update([
                'name' => $data['name'],
                'rescuer_name' => $data['reporter'],
            ]);

            $rescue->address->update([
                'address' => $data['address'],
                'cep' => $data['cep'],
                'neighborhood' => $data['neighborhood'],
                'city' => $data['city'],
                'state' => $data['state'],
            ]);

            $rescue->update([
                'reporter' => $data['reporter'],
                'animal_name' => $data['name'],
            ]);
        }

        activity()->log('Resgate do animal ' . $rescue->name  . ' foi atualizado.');

        session()->flash('alert-success', 'Atualizado com sucesso!');
        return redirect()->route('rescue.intern.list');
    }

    /**
     * Delete Rescue on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($rescue_id)
    {
        $rescue = Rescue::findOrFail($rescue_id);
        $rescue->delete();

        activity()->log('Resgate do animal '. $rescue->name . ' foi deletado.');

        session()->flash('alert-success', 'Deletado com sucesso!');
        return redirect()->back();
    }

    /**
     * Export PDF of Rescues
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pdfExport()
    {
        $organization_id = auth()->user()->organization_id;
        $organization = Organization::find($organization_id);
        $rescue_list = Rescue::where('organization_id', $organization_id)->get();
        $rescue_list = collect($rescue_list);

        $pdf = \PDF::loadView('template.rescues', compact('organization', 'rescue_list'));
        // download PDF file with download method
        return $pdf->download('resgates-exportados.pdf');
    }

    /**
     * Export Excel of Rescues
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function excelExport()
    {
        return Excel::download(new RescuesExport, 'resgates-exportados.xlsx');
    }
}

