<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\Writers;
use App\Http\Requests\StoreWritersRequest;
use App\Http\Requests\UpdateWritersRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\WritersResource;
use App\Http\Resources\V1\WritersCollection;
use App\Services\V1;
use App\Filters\V1\WritersFilter;
use Illuminate\Http\Request;

class WritersController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    
    public function index(Request $request)
    {
        $filters = new WritersFilter();
        $queryItems = $filters->transform($request); //[['column','operator','value']]

        if(count($queryItems)== 0) {
            return new WritersCollection(Writers::paginate()) ;
        }else{
            $writers = Writers::where($queryItems)->paginate();
            return new WritersCollection($writers->appends($request->query()));
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
    public function store(StoreWritersRequest $request)
    {
        // return new WritersResource(new WritersFilter($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $writer = Writers::findOrFail($id);

        return new WritersResource($writer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Writers $writers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWritersRequest $request, Writers $writers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Writers $writers)
    {
        //
    }
}
