<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Services\Params\User\RegisterServiceParams;

class UsersController extends Controller
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
     * Get All User to Response
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function allUsers()
    {
        $getUsers = User::all();

        if ($getUsers->count() > 0) {
            $response = [
                'success' => true,
                'data' => $getUsers
            ];
            $response = json_encode($response);
            return response($response, 200);
        }

        $response = [
            'success' => false,
            'message' => 'Não existe usuários cadastrados',
            'data' => $getUsers
        ];
        $response = json_encode($response);

        return response($response, 401);
    }

    /**
     * Get User to Response
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUser($user_id)
    {
        $getUsers = User::findOrFail($user_id);

        if ($getUsers->count() > 0) {
            $response = [
                'success' => true,
                'data' => $getUsers
            ];
            $response = json_encode($response);
            return response($response, 200);
        }

        $response = [
            'success' => false,
            'message' => 'Não existe usuário com esse id',
            'data' => $getUsers
        ];
        $response = json_encode($response);

        return response($response, 401);
    }

    /**
     * Create new User on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(UserRequest $request)
    {
        $data = $request->all();
        $user = User::create($data);

        $response = [
            'success' => true,
            'message' => "Criado com sucesso!",
            'data' => $user
        ];

        $response = json_encode($response);
        return response($response, 200);
    }

    /**
     * Update User on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(UserRequest $request, $userId)
    {
        $data = $request->all();
        $user = User::findOrFail($userId);

        if ($user) {
            $user->update($data);

            $response = [
                'success' => true,
                'message' => "Atualizado com sucesso!",
                'data' => $user
            ];

            $response = json_encode($response);
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Usuário não encontrado'
            ];

            $response = json_encode($response);
            return response($response, 401);
        }
    }

    /**
     * Delete User on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($userId)
    {
        $user = User::findOrFail($userId);

        if ($user){
            $user->delete();
            $response = [
                'success' => true,
                'message' => "Deletado com sucesso!"
            ];

            $response = json_encode($response);
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => "Usuário não encontrado."
            ];

            $response = json_encode($response);
            return response($response, 401);
        }
    }
}
