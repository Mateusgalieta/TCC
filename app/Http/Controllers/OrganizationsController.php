<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationsController extends Controller
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
     * Show the Organization Index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(auth()->user()->administrator != 1) {
            abort(403);
        }

        $data = $request->all();

        if(isset($data['search']))
            $organization_list = Organization::where('name', 'like', '%'. $data['search']. '%')->paginate();
        else
            $organization_list = Organization::paginate();

        return view('organization.index', [
            'organization_list' => $organization_list ?? [],
        ]);
    }

    /**
     * Redirect to Register Organization page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function register()
    {
        if(auth()->user()->administrator != 1) {
            abort(403);
        }

        return view('organization.register');
    }

    /**
     * Create new Organization on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {
        if(auth()->user()->administrator != 1) {
            abort(403);
        }
        $data = $request->validate([
            'name' => 'required|string',
            'document' => 'required|string',
            'cep'  => 'required|string',
            'city'  => 'required|string',
            'state'  => 'required|string',
        ]);

        $data = $request->all();

        if($data){
            $organization = Organization::create($data);

            activity()->log('Organização '. $organization->name . ' foi criado.');

            $token = $organization->createToken($request->name)->plainTextToken;

            session()->flash('alert-success', 'Criado com sucesso!');
            return redirect()->route('organization.index');
        }

        session()->flash('alert-danger', 'Ocorreu um erro');
        return redirect()->route('organization.index');
    }

     /**
     * edit page Organization on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($organization_id)
    {
        if(auth()->user()->administrator != 1) {
            abort(403);
        }
        $organization = Organization::findOrFail($organization_id);

        return view('organization.edit', [
            'organization' => $organization ?? null,
        ]);
    }

    /**
     * Update Organization on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $organization_id)
    {
        if(auth()->user()->administrator != 1) {
            abort(403);
        }
        $data = $request->all();

        $organization = Organization::findOrFail($organization_id);
        $organization->update($data);

        activity()->log('Organização '. $organization->name . ' foi atualizado.');

        session()->flash('alert-success', 'Atualizado com sucesso!');
        return redirect()->route('organization.index');
    }

    /**
     * Delete Organization on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($organization_id)
    {
        if(auth()->user()->administrator != 1) {
            abort(403);
        }
        $organization = Organization::findOrFail($organization_id);
        $organization->delete();

        activity()->log('Organização '. $organization->name . ' foi deletado.');

        session()->flash('alert-success', 'Deletado com sucesso!');
        return redirect()->back();
    }

}

