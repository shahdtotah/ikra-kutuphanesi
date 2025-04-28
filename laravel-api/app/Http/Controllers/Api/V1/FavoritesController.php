<?php

namespace App\Http\Controllers\Api\V1;
use App\Filters\V1\FavoritesFilter;
use App\Models\Favorites;
use App\Http\Requests\StoreFavoritesRequest;
use App\Http\Requests\UpdateFavoritesRequest;
use App\Http\Resources\V1\FavoritesResource;
use App\Http\Resources\V1\FavoritesCollection;
use App\Http\Controllers\Controller;
use Database\Seeders\FavoritesSeeder;
use Illuminate\Http\Request;
class FavoritesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = new FavoritesFilter();
        $queryItems = $filters->transform($request); //[['column','operator','value']]

        if(count($queryItems)== 0) {
            return new FavoritesCollection(Favorites::paginate()) ;
        }else{
            $favorites = Favorites::where($queryItems)->paginate();
             return new FavoritesCollection($favorites->appends($request->query()));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createFavorite(Request $request)
    {
         // Validate the incoming request
    $validated = $request->validate([
        'bookId' => 'required|integer|exists:books,id', // Ensure the book exists in the books table
        'userId' => 'required|integer|exists:users,id' // Ensure the user exists in the users table
    ]);

    // Check if the favorite already exists
    $favorite = Favorites::where('bookId', $validated['bookId'])
                        ->where('userId', $validated['userId'])
                        ->first();

    if ($favorite) {
        return response()->json(['message' => 'This book is already in your favorites.'], 200);
    }

    // Create a new favorite record
    $newFavorite = Favorites::create([
        'bookId' => $validated['bookId'],
        'userId' => $validated['userId']
    ]);

    return response()->json([
        'message' => 'Book added to favorites successfully.',
        'favorite' => $newFavorite
    ], 201);

    }
    public function removeFavorite(Request $request)
{
    // Validate the incoming request
    $validated = $request->validate([
        'bookId' => 'required|integer|exists:books,id', // Ensure the book exists in the books table
        'userId' => 'required|integer|exists:users,id' // Ensure the user exists in the users table
    ]);

    // Find the favorite entry
    $favorite = Favorites::where('bookId', $validated['bookId'])
                         ->where('userId', $validated['userId'])
                         ->first();

    if (!$favorite) {
        return response()->json(['message' => 'This book is not in your favorites.'], 404);
    }

    // Remove the favorite entry
    $favorite->delete();

    return response()->json(['message' => 'Favorite removed successfully.'], 200);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFavoritesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $fav = Favorites::findOrFail($id);
        return new FavoritesResource($fav);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorites $favorites)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavoritesRequest $request, Favorites $favorites)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorites $favorites)
    {
        //
    }
}
