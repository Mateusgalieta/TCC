<?php

namespace App\Http\Controllers\API;

use App\Models\Animal;
use App\Models\Rescue;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RescueRequest;

class RescuesController extends Controller
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
     * Get Rescues to Response
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getRescues($organization_id)
    {
        $getRescues = Rescue::where('organization_id', $organization_id)->get();

        if ($getRescues->count() > 0) {
            $response = [
                'success' => true,
                'data' => $getRescues
            ];
            $response = json_encode($response);
            return response($response, 200);
        }

        $response = [
            'success' => false,
            'message' => 'Não existe resgates cadastrados',
            'data' => $getRescues
        ];
        $response = json_encode($response);

        return response($response, 401);
    }

    /**
     * Create new Rescue on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(RescueRequest $request)
    {
        $data = $request->all();

        if ($data) {
            $address = Address::create([
                'address' => $data['address'],
                'cep' => $data['cep'],
                'neighborhood' => $data['neighborhood'],
                'city' => $data['city'],
                'state' => $data['state'],
                'origin' => 2,
            ]);

            $rescue = Rescue::create([
                'reporter' => $data['reporter'],
                'animal_name' => $data['name'],
                'organization_id' => $data['organization_id'],
                'address_id' => $address->id,
                'status' => 'AGUARDANDO',
                'observations' => $data['observations']
            ]);
        }

        $response = [
            'success' => true,
            'message' => "Criado com sucesso!",
            'data' => $rescue
        ];

        $response = json_encode($response);
        return response($response, 200);
    }

    /**
     * Update Rescue on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $rescue_id)
    {
        $data = $request->all();
        $rescue = Rescue::findOrFail($rescue_id);

        if ($rescue && $data) {
            $rescue->animal->update([
                'name' => $data['name'],
                'rescuer_name' => $data['reporter'],
            ]);

            $rescue->address->update([
                'address' => $data['address'],
                'cep' => $data['cep'],
                'neighborhood' => $data['neighborhood'],
                'city' => $data['city'],
                'state' => $data['state'],
            ]);

            $rescue->update([
                'reporter' => $data['reporter'],
                'animal_name' => $data['name'],
            ]);

            $response = [
                'success' => true,
                'message' => "Atualizado com sucesso!",
                'data' => $rescue
            ];

            $response = json_encode($response);
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Resgate não encontrado'
            ];

            $response = json_encode($response);
            return response($response, 401);
        }
    }

    /**
     * Delete Rescue on the System
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($rescue_id)
    {
        $rescue = Rescue::findOrFail($rescue_id);

        if ($rescue){
            $rescue->delete();
            $response = [
                'success' => true,
                'message' => "Deletado com sucesso!"
            ];

            $response = json_encode($response);
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => "Resgate não encontrado"
            ];

            $response = json_encode($response);
            return response($response, 401);
        }
    }
}
