<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
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
    public function index()
    {
        return view('profile', [
        ]);
    }

    /**
     * Create new user on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Update user on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request)
    {
        $data = $request->all();

        $auth_id = auth()->user()->id;
        $user = User::find($auth_id);

        if($data['password']){
            $data['password'] = bcrypt($data['password']);
        }
        else{
            $data['password'] = bcrypt($user->password);
        }

        $user->update($data);

        activity()->log('O profile do user ID'. $user->id . ' foi atualizado.');

        session()->flash('alert-success', 'Atualizado com sucesso!');
        return redirect()->back();
    }

}
