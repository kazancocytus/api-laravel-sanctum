<?php

namespace App\Services\V1;

use Illuminate\Http\Request;
use App\Services\ApiQuery;

class InvoicesQuery extends ApiQuery
{
    protected $allowedParams = [
        'costumerId' => ['eq'],
        'amount' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'status' => ['eq', 'ne'],
        'billedDated' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'paidDated' => ['eq', 'lt', 'gt', 'lte', 'gte'],
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
        'ne' => '!='
    ];


}