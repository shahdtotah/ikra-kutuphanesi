<?php

namespace App\Filters\V1;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class FavoritesFilter extends ApiFilter{
   
    protected $allowedParms = [
        "userId"=>['eq'],
        "bookId"=> ['eq'],
    ] ;
    // protected $columnMaps = [
    //     'userId' =>'user_id',
    //     'bookId'=>'book_id'
    // ];
    protected $operatorMap = [
        'eq'=> '=',
        'lt'=> '<',
        'lte'=> '<=',
        'gt'=> '>',
        'gte'=> '>=', 
        'con' => 'LIKE',
    ] ;

}