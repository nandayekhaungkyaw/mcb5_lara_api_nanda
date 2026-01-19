<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

    // Use policy: if user_id=1 -> all, else -> only their customers
$customers =  Customer::with('user')
    ->when($user->id !== 1, fn ($q) =>
        $q->where('user_id', $user->id)
    )
    ->when($request->q, fn ($q) =>
    $q->where(function ($query) use ($request) {
        $query->where('name', 'like', '%' . $request->q . '%')
              ->orWhere('email', 'like', '%' . $request->q . '%')
              ->orWhere('phone', 'like', '%' . $request->q . '%')
              ->orWhere('township', 'like', '%' . $request->q . '%')
              ->orWhere('division', 'like', '%' . $request->q . '%');
    })
)

    ->orderBy($request->sort_by ?? 'created_at',
        $request->sort_direction ?? 'desc')
    ->latest()
    ->paginate(10);

    return CustomerResource::collection($customers);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(StoreCustomerRequest $request)
{
    $data = $request->validated();

    // Add current user id
    $data['user_id'] = Auth::id(); // or $request->user()->id

    $customer = Customer::create($data);

    return new CustomerResource($customer);
}

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
         $this->authorize('view', $customer);

    return new CustomerResource($customer);
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
        $customer->update($request->validated());

        return new CustomerResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(['message' => 'Customer deleted successfully']);
    }
}
