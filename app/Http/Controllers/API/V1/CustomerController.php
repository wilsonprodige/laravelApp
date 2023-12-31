<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;
use  App\Filters\V1\CustomersFilter;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //@return Illuminate\Http\Responce
    public function index(Request $request)
    {

        $filter = new CustomersFilter();
       $queryItems = $filter->transform($request);

       $includeInvoices = $request->query('include');

       $customers = Customer::where($queryItems);
       if($includeInvoices){
        $customers = $customers->with('invoices');
        
       }
       
       //->paginate();
       return new CustomerCollection($customers->appends($request->query()));

       if(count($queryItems) == 0){
        return new CustomerCollection(Customer::paginate());
       }else{
       
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
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return new  CustomerResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
