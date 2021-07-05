<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
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
     * Show the Category Index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $organization_id = auth()->user()->organization_id;

        if(isset($data['search']))
            $categories_list = Category::where('organization_id', $organization_id)->where('name', 'like', '%'. $data['search']. '%')->paginate();
        else
            $categories_list = Category::where('organization_id', $organization_id)->paginate();

        return view('category.index', [
            'categories_list' => $categories_list ?? [],
        ]);
    }

    /**
     * Redirect to Register Category page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function register()
    {
        return view('category.register');
    }

    /**
     * Create new Category on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $organization_id = auth()->user()->organization_id;

        if($data){
            $category = Category::create(['name' => $data['name'], 'organization_id' => $organization_id]);
            $response = [
                'status' => 'success',
                'message' => "Criado com sucesso!",
            ];
            activity()->log('Categoria ID'. $category->id . ' foi criado.');
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
     * edit page Category on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($category_id)
    {
        $category = Category::findOrFail($category_id);

        return view('category.edit', [
            'category' => $category ?? null,
        ]);
    }

    /**
     * Update Category on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $category_id)
    {
        $data = $request->all();

        $category = Category::findOrFail($category_id);
        $category->update($data);

        activity()->log('Categoria ID'. $category->id . ' foi atualizado.');

        session()->flash('alert-success', 'Atualizado com sucesso!');
        return redirect()->route('category.index');
    }

    /**
     * Delete Category on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($category_id)
    {
        $category = Category::findOrFail($category_id);
        $category->delete();

        activity()->log('Categoria ID'. $category->id . ' foi deletado.');

        session()->flash('alert-success', 'Deletado com sucesso!');
        return redirect()->back();
    }

}
