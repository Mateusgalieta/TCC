<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\Params\User\RegisterServiceParams;

class CategoriesController extends Controller
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
     * Get Category to Response
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCategories($organization_id)
    {
        $getCategories = Category::where('organization_id', $organization_id)->get();

        if ($getCategories->count() > 0) {
            $response = [
                'success' => true,
                'data' => $getCategories
            ];
            $response = json_encode($response);
            return response($response, 200);
        }

        $response = [
            'success' => false,
            'message' => 'Não existe usuários cadastrados',
            'data' => $getCategories
        ];
        $response = json_encode($response);

        return response($response, 401);
    }

    /**
     * Create new Category on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(CategoryRequest $request)
    {
        $data = $request->all();
        $category = Category::create($data);

        $response = [
            'success' => true,
            'message' => "Criado com sucesso!",
            'data' => $category
        ];

        $response = json_encode($response);
        return response($response, 200);
    }

    /**
     * Update Category on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(CategoryRequest $request, $category_id)
    {
        $data = $request->all();
        $category = Category::findOrFail($category_id);

        if ($category) {
            $category->update($data);

            $response = [
                'success' => true,
                'message' => "Atualizado com sucesso!",
                'data' => $category
            ];

            $response = json_encode($response);
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Categoria não encontrada'
            ];

            $response = json_encode($response);
            return response($response, 401);
        }
    }

    /**
     * Delete Category on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($category_id)
    {
        $category = User::findOrFail($category_id);

        if ($category){
            $category->delete();
            $response = [
                'success' => true,
                'message' => "Deletado com sucesso!"
            ];

            $response = json_encode($response);
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => "Categoria não encontrada."
            ];

            $response = json_encode($response);
            return response($response, 401);
        }
    }
}
