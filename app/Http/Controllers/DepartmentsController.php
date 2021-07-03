<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
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
     * Show the Department Index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $organization_id = auth()->user()->organization()->id;

        if(isset($data['search']))
            $department_list = Department::where('organization_id', $organization_id)->where('name', 'like', '%'. $data['search']. '%')->paginate();
        else
            $department_list = Department::where('organization_id', $organization_id)->paginate();

        return view('department.index', [
            'department_list' => $department_list ?? [],
        ]);
    }

    /**
     * Redirect to Register Department page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function register()
    {
        return view('department.register');
    }

    /**
     * Create new Department on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $organization_id = auth()->user()->organization()->id;

        if($data){
            $department = Department::create(['name' => $data['name'], 'organization_id' => $organization_id]);
            $response = [
                'status' => 'success',
                'message' => "Criado com sucesso!",
            ];
            activity()->log('Departamento ID'. $department->id . ' foi criado.');
        }
        else {
            $response = [
                'status' => 'error',
                'message' => "Ocorreu um erro. Por favor, tente novamente!",
            ];
        }

        return $response;
    }

     /**
     * edit page Department on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($department_id)
    {
        $department = Department::findOrFail($department_id);

        return view('department.edit', [
            'department' => $department ?? null,
        ]);
    }

    /**
     * Update Department on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $department_id)
    {
        $data = $request->all();

        $department = Department::findOrFail($department_id);
        $department->update($data);

        activity()->log('Departamento ID'. $department->id . ' foi atualizado.');

        session()->flash('alert-success', 'Atualizado com sucesso!');
        return redirect()->route('department.index');
    }

    /**
     * Delete Department on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($department_id)
    {
        $department = Department::findOrFail($department_id);
        $department->delete();

        activity()->log('Departamento ID'. $department->id . ' foi deletado.');

        session()->flash('alert-success', 'Deletado com sucesso!');
        return redirect()->back();
    }

}

