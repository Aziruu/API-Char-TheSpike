<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SkillCharacters;
use App\Http\Resources\SkillCharacterResource;
use Illuminate\Http\Request;

class SkillCharactersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SkillCharacterResource::collection(SkillCharacters::with('characters')->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'character_id' => 'required|exits::characters,id',
            'skill_name' => 'required|string|max:255',
            'cooldown' => 'required|integer|min:0',
            'efficiency' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $skill = SkillCharacters::create($validated);

        return new SkillCharacterResource($skill);
    }

    /**
     * Display the specified resource.
     */
    public function show(SkillCharacters $id)
    {
        $skill = SkillCharacters::with('character')->findOrFail($id);
        return new SkillCharacterResource($skill);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SkillCharacters $skillCharacters)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SkillCharacters $id)
    {
        $skill = SkillCharacters::findOrFail($id);

        $validated = $request->validate([
            'character_id' => 'sometimes|exists:characters,id',
            'skill_name' => 'sometimes|string|max:255',
            'cooldown' => 'sometimes|integer|min:0',
            'efficiency' => 'sometimes|integer',
            'description' => 'nullable|string',
        ]);

        $skill->update($validated);

        return new SkillCharacterResource($skill);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SkillCharacters $id)
    {
        $skill = SkillCharacters::findOrFail($id);
        $skill->delete();

        return response()->json(['message' => 'Skill deleted successfully.']);
    }
}
