<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ChurchResource;
use App\Models\Church;
use App\Traits\HttpResponses;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChurchController extends Controller
{
    use HttpResponses;

    public function index()
    {
        $churches = Church::all();
        return $this->response('Church all', 200, ChurchResource::collection($churches));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->error('Data Invalid', 422, $validator->errors());
        }

        $church = Church::create($validator->validated());
        return $this->response('Church created', 200, new ChurchResource($church));
    }

    public function show(string $churchId)
    {

        $church = Church::find($churchId);
        if (!$church) {
            return $this->error('Church not found', 404);
        }
        return $this->response('Draw Group details', 200, new ChurchResource($church));
    }

    public function update(Request $request, string $churchId)
    {

        $church = Church::find($churchId);

        if (!$church) {
            return $this->error('Church not found', 404);
        }
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->error('Validation failed', 422, $validator->errors());
        }

        $church->update($validator->validated());
        return $this->response('Church updated', 200, new ChurchResource($church));
    }

    public function destroy(string $churchId)
    {
        $church = Church::find($churchId);

        if (!$church) {
            return $this->error('Church not found', 404);
        }
        $church->delete();
        return $this->response('Church deleted', 200);
    }
}
