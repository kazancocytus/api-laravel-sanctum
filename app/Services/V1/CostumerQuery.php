<?php

namespace App\Services\V1;

use Illuminate\Http\Request;
use App\Services\ApiQuery;

class CostumerQuery extends ApiQuery
{
    protected $allowedParams = [
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'adress' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt']
    ];

    protected $columnMap = [
        'postalCode' => 'postal_code',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];

    public function transform(Request $request){
        $eloQuery = [];

        foreach($this->allowedParams as $params => $operator){
            $query = $request->query($params);

            if(!isset($query)){
                continue;
            }

            $column = $this->columnMap[$params] ?? $params;

            foreach($operator as $operators){
                if(isset($query[$operators])){
                    $eloQuery[] = [$column, $this->operatorMap[$operators], $query[$operators]];
                }
            }
        }
        return $eloQuery;
    }
}