<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Books;
use App\Http\Requests\StoreBooksRequest;
use App\Http\Requests\UpdateBooksRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\BooksCollection;
use App\Http\Resources\V1\BooksResource;
use App\Services\V1;
use App\Filters\V1\BooksFilter;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = new BooksFilter();
        $queryItems = $filters->transform($request); //[['column','operator','value']]

        if(count($queryItems)== 0) {
            return new BooksCollection(Books::paginate()) ;
        }else{
            $books = Books::where($queryItems)->paginate();
             return new BooksCollection($books->appends($request->query()));
        }
        
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
    public function store(StoreBooksRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $book = Books::findOrFail($id);
        return new BooksResource($book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Books $books)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBooksRequest $request, Books $books)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Books $books)
    {
        //
    }
}
