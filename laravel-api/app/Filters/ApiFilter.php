<?php

namespace App\Filters;
use Illuminate\Http\Request;

class ApiFilter {
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
    public function transform(Request $request){
        $eloQuery = [];
        foreach ($this ->allowedParms as $parm =>$operators) {
            $query = $request->query($parm);
            if (!isset($query)) {
                continue;
            }
            $column = $this->columnMap[$parm]?? $parm;
            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $value = $query[$operator];
                    
                    // If operator is 'contains', wrap the value with '%' for LIKE query
                    if ($operator === 'con') {
                        $value = '%' . $value . '%';
                    }

                    $eloQuery[] = [$column, $this->operatorMap[$operator], $value];
                }
            }

        }
        return $eloQuery;
    }
}