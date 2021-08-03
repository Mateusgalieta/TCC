<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\Params\User\RegisterServiceParams;

class DepartmentsController extends Controller
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
     * Get Department to Response
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getDepartments($organization_id)
    {
        $getDepartments = Department::where('organization_id', $organization_id)->get();

        if ($getDepartments->count() > 0) {
            $response = [
                'success' => true,
                'data' => $getDepartments
            ];
            $response = json_encode($response);
            return response($response, 200);
        }

        $response = [
            'success' => false,
            'message' => 'Não existe departamentos cadastrados',
            'data' => $getDepartments
        ];
        $response = json_encode($response);

        return response($response, 401);
    }

    /**
     * Create new Department on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(DepartmentRequest $request)
    {
        $data = $request->all();
        $department = Department::create($data);

        $response = [
            'success' => true,
            'message' => "Criado com sucesso!",
            'data' => $department
        ];

        $response = json_encode($response);
        return response($response, 200);
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

        if ($department) {
            $department->update($data);

            $response = [
                'success' => true,
                'message' => "Atualizado com sucesso!",
                'data' => $department
            ];

            $response = json_encode($response);
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Departamento não encontrado'
            ];

            $response = json_encode($response);
            return response($response, 401);
        }
    }

    /**
     * Delete Department on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($department_id)
    {
        $department = Department::findOrFail($department_id);

        if ($department) {
            $department->delete();
            $response = [
                'success' => true,
                'message' => "Deletado com sucesso!"
            ];

            $response = json_encode($response);
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => "Departamento não encontrado."
            ];

            $response = json_encode($response);
            return response($response, 401);
        }
    }
}
