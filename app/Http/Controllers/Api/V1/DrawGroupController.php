<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\DrawGroupResource;
use App\Models\DrawGroup;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DrawGroupController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($churchId = $request->input('church_id')) {
            // Buscar e retornar grupos de sorteio da igreja específica
            $drawGroups = DrawGroup::where('igreja_id', $churchId)->get();

            return $this->response('List of Draw Groups', 200, DrawGroupResource::collection($drawGroups));
        }
        // Buscar e retornar todos os grupos de sorteio
        $drawGroups = DrawGroup::all();

        return $this->response('List of Draw Groups', 200, DrawGroupResource::collection($drawGroups));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'igreja_id' => 'required|exists:churches,id',
            'nome' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return $this->error('Validation failed', 422, $validator->errors());
        }

        $createdDrawGroup = DrawGroup::create($validator->validated());

        if ($createdDrawGroup) {
            return $this->response('Draw Group created', 201, $createdDrawGroup);
        }

        return $this->error('Draw Group not created', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $drawGroupId)
    {

        $drawGroup = DrawGroup::find($drawGroupId);
        if (!$drawGroup) {
            return $this->error('Draw group not found', 404);
        }
        return $this->response('Draw Group details', 200, $drawGroup);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $drawGroupId)
    {
        $drawGroup = DrawGroup::find($drawGroupId);

        if (!$drawGroup) {
            return $this->error('Draw group not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'igreja_id' => 'exists:churches,id',
            'nome' => 'max:255'
        ]);

        if ($validator->fails()) {
            return $this->error('Validation failed', 422, $validator->errors());
        }

        $updated = $drawGroup->update($validator->validated());

        if ($updated) {
            return $this->response('Draw Group updated', 200, $drawGroup);
        }

        return $this->error('Draw Group not updated', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $drawGroupId)
    {

        $drawGroup = DrawGroup::find($drawGroupId);

        if (!$drawGroup) {
            return $this->error('Draw group not found', 404);
        }

        $deleted = $drawGroup->delete();

        if ($deleted) {
            return $this->response('Draw Group deleted', 200);
        }

        return $this->error('Draw Group not deleted', 400);
    }
}
