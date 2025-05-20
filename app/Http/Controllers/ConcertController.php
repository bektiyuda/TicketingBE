<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\Genre;
use Illuminate\Http\Request;

class ConcertController extends Controller
{
    public function index(Request $request)
    {
        $query = Concert::with(['genres', 'venue.city', 'tickets']);

        // Filter: Date Range
        if ($request->has(['start_date', 'end_date'])) {
            $query->whereBetween('concert_start', [$request->start_date, $request->end_date]);
        }

        // Filter: City
        if ($request->has('city_id')) {
            $query->whereHas('venue', function ($q) use ($request) {
                $q->where('city_id', $request->city_id);
            });
        }

        // Filter: Genre
        if ($request->has('genre_ids')) {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->whereIn('genres.id', $request->genre_ids);
            });
        }

        // Filter: Price Range (dari relasi ticket)
        if ($request->has(['min_price', 'max_price'])) {
            $query->whereHas('tickets', function ($q) use ($request) {
                $q->whereBetween('price', [$request->min_price, $request->max_price]);
            });
        }

        // Pagination
        $perPage = $request->get('limit', 10);
        $concerts = $query->paginate($perPage);

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
