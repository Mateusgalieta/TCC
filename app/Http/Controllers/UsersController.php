<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $organization_id = auth()->user()->organization()->id;

        if(isset($data['search']))
            $users_list = User::where('organization_id', $organization_id)->where('name', 'like', '%'. $data['search']. '%')->where('id', '!=', auth()->user()->id)->paginate();
        else
            $users_list = User::where('id', '!=', auth()->user()->id)->where('organization_id', $organization_id)->paginate();

        return view('user.index', [
            'users_list' => $users_list ?? [],
        ]);
    }

    /**
     * Redirect to Add User page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function register()
    {
        return view('user.register');
    }

    /**
     * Create new User on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {
        $data = $request->all();
        $user = User::create($data);

        activity()->log('O User ID'. $user->id . ' foi criado.');

        session()->flash('alert-success', 'Criado com sucesso!');
        return redirect()->route('user.index');
    }

     /**
     * edit page User on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);

        return view('user.edit', [
            'user' => $user ?? null,
        ]);
    }

    /**
     * Update User on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $user_id)
    {
        $data = $request->all();
        $user = User::findOrFail($user_id);

        if($data['password']){
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = bcrypt($user->password);
        }

        $user->update($data);

        activity()->log('O User ID'. $user->id . ' foi atualizado.');

        session()->flash('alert-success', 'Atualizado com sucesso!');
        return redirect()->route('user.index');
    }

    /**
     * Delete User on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();

        activity()->log('O User ID'. $user->id . ' foi deletado.');

        session()->flash('alert-success', 'Deletado com sucesso!');
        return redirect()->back();
    }

}
