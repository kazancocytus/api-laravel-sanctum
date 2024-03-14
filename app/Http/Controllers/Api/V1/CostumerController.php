<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Costumer;
use App\Http\Requests\StoreCostumerRequest;
use App\Http\Requests\UpdateCostumerRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CostumerCollection;
use App\Http\Resources\V1\CostumerResource;
use App\Services\V1\CostumerQuery;
use Illuminate\Http\Request;

class CostumerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new CostumerQuery();
        $queryItems = $filter->transform($request);

        $includeInvoices = $request->query('includeInvoices');

        $costumers = Costumer::where($queryItems);

        if($includeInvoices){
            $costumers = $costumers->with('invoices');
        }

        return new CostumerCollection($costumers->paginate()->appends($request->query()));


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
    public function store(StoreCostumerRequest $request)
    {
        return new CostumerResource(Costumer::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Costumer $costumer, Request $request)
    {
        $includeInvoices = $request->query('includeInvoices');
        
        if($includeInvoices){
            return new CostumerResource($costumer->loadMissing('invoices'));
        }

        return new CostumerResource($costumer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Costumer $costumer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCostumerRequest $request, Costumer $costumer)
    {
        $costumer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $costumers = Costumer::findOrFail($id);

        $costumers->delete();
    }
}
