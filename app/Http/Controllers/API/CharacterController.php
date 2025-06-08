<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Character;

class CharacterController extends Controller
{
    public function index()
    {
        return response()->json(Character::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'rank' => 'required|string',
            'power' => 'required|integer|between:0,300',
            'speed' => 'required|integer|between:0,300',
            'jump' => 'required|integer|between:0,300',
            'deff' => 'required|integer|between:0,300',
        ]);

        return response()->json(Character::create($data), 201);
    }

    public function show($id)
    {
        return response()->json(Character::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $char = Character::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string',
            'rank' => 'required|string',
            'power' => 'required|integer|between:0,300',
            'speed' => 'required|integer|between:0,300',
            'jump' => 'required|integer|between:0,300',
            'deff' => 'required|integer|between:0,300',
        ]);

        $char->update($data);

        return response()->json($char);
    }

    public function destroy($id)
    {
        Character::destroy($id);
        return response()->json(null, 204);
    }
}
