<?php

namespace App\Filters\V1;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class WritersFilter extends ApiFilter{
    protected $allowedParms = [
        "name"=> ['eq','con'],
        "birthDate"=> ['eq','gt','lt'],
        "nationality"=> ['eq'],
        "biography"=> ['eq'],
    ] ;
    // protected $columnMaps = [
    //     'birthDate' =>'birth_date'
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