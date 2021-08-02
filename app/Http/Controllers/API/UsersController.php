<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Services\Contracts\UserServiceInterface;
use App\Services\Params\User\RegisterServiceParams;

class UsersController extends Controller
{
    protected $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get User to Response
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function allUsers()
    {
        $getUsers = User::all();

        if ($getUsers->count() > 0) {
            return response($getUsers, 200);
        }

        return response($getUsers, 401);
    }

    /**
     * Get User to Response
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUser(int $id)
    {
        $getUser = $this->userService->find($id);

        if ($getUser->success == true) {
            return response($getUser, 200);
        }

        return response($getUser, 401);
    }

    /**
     * Create new User on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(UserRequest $request)
    {
        $params = new RegisterServiceParams(
            $request->name,
            $request->email,
            $request->password,
            $request->birthdayDate,
        );

        $registerUserResponse = $this->userService->register($params);

        if ($registerUserResponse->success == true) {
            return response($registerUserResponse, 200);
        }

        return response($registerUserResponse, 401);
    }

    /**
     * Update User on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(UserRequest $request, $userId)
    {
        $params = new RegisterServiceParams(
            $request->name,
            $request->email,
            $request->password,
            $request->birthdayDate,
        );

        $updateUserResponse = $this->userService->update($params, $userId);

        if ($updateUserResponse->success == true) {
            return response($updateUserResponse, 200);
        }

        return response($updateUserResponse, 401);
    }

    /**
     * Delete User on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($userId)
    {
        $destroyUserResponse = $this->userService->delete($userId);

        if ($destroyUserResponse->success == true) {
            return response($destroyUserResponse, 200);
        }

        return response($destroyUserResponse, 401);
    }
}
