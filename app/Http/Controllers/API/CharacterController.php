<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Character;
use App\Http\Resources\CharacterResource;

class CharacterController extends Controller
{
    public function index(Request $request)
    {
        $query = Character::query();

        // Filter Nama dan Rank Characters
        if ($request->has('search')) {
            $search = $request->get('search');

            //Note Jika Rank nya "+" gunakan "%2B" & Jika "-" gunakan "2%D"
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('rank', 'like', "%$search");
        }

        // Request Multi-Rank Filter
        if ($request->has('rank')) {
            $ranks = $request->get('rank');
            if (is_array($ranks)) {
                $query->whereIn('rank', $ranks);
            } else {
                $query->where('rank', $ranks);
            }
        }

        // Filter Range dari Kekuatan, Kecepatan, Lompatan, dan Ketahanan
        // Power / Kekuatan
        if ($request->has('min_power')) {
            $query->where('power', '>=', $request->get('min_power'));
        }

        if ($request->has('max_power')) {
            $query->where('power', '<=', $request->get('max_power'));
        }

        // Speed / Kecepatan
        if ($request->has('min_speed')) {
            $query->where('speed', '>=', $request->get('min_speed'));
        }

        if ($request->has('max_speed')) {
            $query->where('speed', '<=', $request->get('max_speed'));
        }

        // Sorting
        if ($request->has('sort_by')) {
            $sortBy = $request->get('sort_by', 'name');
            $order = $request->get('order', 'asc');
            $query->orderBy($sortBy, $order);
        }

        // Role Request
        if ($request->has('role')) {
            $query->where('role', $request->get('role'));
        }

        // Pagination (5 per Page)
        return CharacterResource::collection($query->paginate(5));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'rank' => 'required|string',
            'team_id' => 'nullable|exists:teams,id',
            'role' => 'required|string|in:Setter,Spiker,Blocker',
            'power' => 'required|integer|between:0,300',
            'speed' => 'required|integer|between:0,300',
            'jump' => 'required|integer|between:0,300',
            'deff' => 'required|integer|between:0,300',
        ]);

        return new CharacterResource(Character::create($data), 201);
    }

    public function show($id)
    {
        return new CharacterResource(Character::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $char = Character::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string',
            'rank' => 'required|string',
            'team_id' => 'nullable|exists:teams,id',
            'role' => 'required|string|in:Setter,Spiker,Blocker',
            'power' => 'required|integer|between:0,300',
            'speed' => 'required|integer|between:0,300',
            'jump' => 'required|integer|between:0,300',
            'deff' => 'required|integer|between:0,300',
        ]);

        $char->update($data);

        return new CharacterResource($char);
    }

    public function destroy($id)
    {
        Character::destroy($id);
        return response()->json(null, 204);
    }

    public function groupByRole()
    {
        $grouped = Character::all()->groupBy('role');

        $resource = $grouped->map(function ($group) {
            return CharacterResource::collection($group);
        });

        return response()->json($resource);
    }
}
