<?php

namespace App\Http\Controllers;

use App\Models\Rescue;
use Illuminate\Http\Request;

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
        $rescues_list = Rescue::where('organization_id', auth()->user()->organization_id);

        return view('rescue.index', [
            'rescues_list' => $rescues_list ?? [],
        ]);
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

            activity()->log('Resgate ID ' . $rescue->id . ' foi criado.');

            session()->flash('alert-success', 'Criado com sucesso!');
            return redirect()->route('rescue.index');
        }

        session()->flash('alert-danger', 'Ocorreu um erro');
        return redirect()->route('rescue.index');
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
        $rescue->update($data);

        activity()->log('Resgate ID ' . $rescue->id  . ' foi atualizado.');

        session()->flash('alert-success', 'Atualizado com sucesso!');
        return redirect()->route('rescue.index');
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

        activity()->log('Resgate ID '. $rescue->id . ' foi deletado.');

        session()->flash('alert-success', 'Deletado com sucesso!');
        return redirect()->back();
    }

}

