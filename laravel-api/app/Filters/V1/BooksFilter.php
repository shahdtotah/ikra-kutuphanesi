<?php

namespace App\Filters\V1;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class BooksFilter extends ApiFilter{
   
    protected $allowedParms = [
        "writersId"=>['eq'],
        "title"=> ['eq','con'],
        "category"=> ['eq','con'],
        "publicationDate"=> ['eq','lt','gt'],
        "summary"=> ['eq','con'],
    ] ;
    protected $columnMaps = [
        'publicationDate' =>'publication_date',
        'writersId'=>'writers_id'
    ];
    protected $operatorMap = [
        'eq'=> '=',
        'lt'=> '<',
        'lte'=> '<=',
        'gt'=> '>',
        'gte'=> '>=', 
        'con' => 'LIKE',
    ] ;

}