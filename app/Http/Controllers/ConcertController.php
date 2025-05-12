<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\Genre;
use Illuminate\Http\Request;

class ConcertController extends Controller
{
    public function index()
    {
        $concerts = Concert::with(['genres', 'venue'])->get();

        return response()->json([
            'status' => 'success',
            'data' => $concerts
        ]);
    }

    public function show($id)
    {
        $concert = Concert::with(['genres', 'venue'])->find($id);

        if (!$concert) {
            return response()->json([
                'status' => 'error',
                'message' => 'Concert not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $concert
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'concert_start' => 'required|date',
            'concert_end' => 'required|date',
            'venue_id' => 'required|integer',
            'link_poster' => 'nullable|url',
            'link_venue' => 'nullable|url',
            'genre_ids' => 'required|array',
        ]);

        $concert = Concert::create([
            'name' => $request->name,
            'description' => $request->description,
            'concert_start' => $request->concert_start,
            'concert_end' => $request->concert_end,
            'venue_id' => $request->venue_id,
            'link_poster' => $request->link_poster,
            'link_venue' => $request->link_venue,
        ]);

        $concert->genres()->attach($request->genre_ids);

        return response()->json([
            'status' => 'success',
            'data' => $concert->load(['genres', 'venue'])
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $concert = Concert::find($id);

        if (!$concert) {
            return response()->json([
                'status' => 'error',
                'message' => 'Concert not found'
            ], 404);
        }

        $this->validate($request, [
            'name' => 'sometimes|string',
            'description' => 'nullable|string',
            'concert_start' => 'sometimes|date',
            'concert_end' => 'sometimes|date',
            'venue_id' => 'sometimes|integer',
            'link_poster' => 'nullable|url',
            'link_venue' => 'nullable|url',
            'genre_ids' => 'nullable|array'
        ]);

        $concert->update($request->only([
            'name',
            'description',
            'concert_start',
            'concert_end',
            'venue_id',
            'link_poster',
            'link_venue'
        ]));

        if ($request->has('genre_ids')) {
            $concert->genres()->sync($request->genre_ids);
        }

        return response()->json([
            'status' => 'success',
            'data' => $concert->load(['genres', 'venue'])
        ]);
    }

    public function destroy($id)
    {
        $concert = Concert::find($id);

        if (!$concert) {
            return response()->json([
                'status' => 'error',
                'message' => 'Concert not found'
            ], 404);
        }

        $concert->genres()->detach();

        $concert->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Concert deleted successfully'
        ]);
    }
}
