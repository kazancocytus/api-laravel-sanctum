<?php

namespace App\Services;

use Illuminate\Http\Request;

class ApiQuery
{
    protected $allowedParams = [];

    protected $columnMap = [];

    protected $operatorMap = [];

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