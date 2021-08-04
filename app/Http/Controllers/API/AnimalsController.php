<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Animal;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AnimalRequest;
use App\Http\Requests\AddressRequest;

class AnimalsController extends Controller
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
     * Get Animal to Response
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getAnimals($organization_id)
    {
        $getAnimals = Animal::where('organization_id', $organization_id)->get();

        if ($getAnimals->count() > 0) {
            $response = [
                'success' => true,
                'data' => $getAnimals
            ];
            $response = json_encode($response);
            return response($response, 200);
        }

        $response = [
            'success' => false,
            'message' => 'Não existe animais cadastrados',
            'data' => $getAnimals
        ];
        $response = json_encode($response);

        return response($response, 401);
    }

    /**
     * Create new Animal on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(AnimalRequest $request)
    {
        $data = $request->all();
        $animal = Animal::create($data);

        $response = [
            'success' => true,
            'message' => "Criado com sucesso!",
            'data' => $animal
        ];

        $response = json_encode($response);
        return response($response, 200);
    }

    /**
     * Update Animal on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $animal_id)
    {
        $data = $request->all();
        $animal = Animal::findOrFail($animal_id);

        if ($animal) {
            $animal->update($data);

            $response = [
                'success' => true,
                'message' => "Atualizado com sucesso!",
                'data' => $animal
            ];

            $response = json_encode($response);
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Animal não encontrado'
            ];

            $response = json_encode($response);
            return response($response, 401);
        }
    }

    /**
     * Delete Animal on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($animal_id)
    {
        $animal = Animal::findOrFail($animal_id);

        if ($animal) {
            $animal->delete();
            $response = [
                'success' => true,
                'message' => "Deletado com sucesso!"
            ];

            $response = json_encode($response);
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => "Animal não encontrado."
            ];

            $response = json_encode($response);
            return response($response, 401);
        }
    }

     /**
     * Create new Address Rescue on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createAddress(AddressRequest $request)
    {
        $data = $request->all();
        $data['origin'] = 2; //Rescue Origin
        $address = Address::create($data);

        $response = [
            'success' => true,
            'message' => "Criado com sucesso!",
            'data' => $address
        ];

        $response = json_encode($response);
        return response($response, 200);
    }

    /**
     * Get Animal Address Rescue to Response
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getAddress($animal_id)
    {
        $getAddress = Address::where('animal_id', $animal_id)->get();

        if ($getAddress->count() > 0) {
            $response = [
                'success' => true,
                'data' => $getAddress
            ];
            $response = json_encode($response);
            return response($response, 200);
        }

        $response = [
            'success' => false,
            'message' => 'Não existe animais cadastrados',
            'data' => $getAddress
        ];
        $response = json_encode($response);

        return response($response, 401);
    }

     /**
     * Update Animal Address Rescue on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateAddress(Request $request, $animal_id)
    {
        $data = $request->all();
        $animal = Animal::findOrFail($animal_id);

        if ($animal) {
            $animal->rescueAddress()->update($data);

            $response = [
                'success' => true,
                'message' => "Atualizado com sucesso!",
                'data' => $animal
            ];

            $response = json_encode($response);
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Animal não encontrado'
            ];

            $response = json_encode($response);
            return response($response, 401);
        }
    }
}
