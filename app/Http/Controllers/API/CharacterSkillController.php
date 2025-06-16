<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Http\Resources\CharacterSkillResource;

class CharacterSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CharacterSkillResource::collection(Character::with('skills')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'character_id' => 'required|exists:characters,id',
            'skill_id' => 'required|exists:skills,id',
            'cooldown' => 'required|integer',
            'efficiency' => 'required|integer',
        ]);

        $character = Character::find($data['character_id']);
        $character->skills()->attach($data['skill_id'], [
            'cooldown' => $data['cooldown'],
            'efficiency' => $data['efficiency'],
        ]);

        return new CharacterSkillResource($character->load('skills'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'character_id' => 'required|exists:characters,id',
            'skill_id' => 'required|exists:skills,id',
            'cooldown' => 'nullable|integer',
            'efficiency' => 'nullable|integer',
        ]);

        $character = Character::find($data['character_id']);
        $character->skills()->updateExistingPivot($data['skill_id'], array_filter([
            'cooldown' => $data['cooldown'] ?? null,
            'efficiency' => $data['efficiency'] ?? null,
        ]));

        return new CharacterSkillResource($character->load('skills'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = $request->validate([
            'character_id' => 'required|exists:characters,id',
            'skill_id' => 'required|exists:skills,id',
        ]);

        $character = Character::find($data['character_id']);
        $character->skills()->detach($data['skill_id']);

        return response()->noContent();
    }
}
