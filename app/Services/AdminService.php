<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminService
{
    public function getCustomer()
    {
        return Customer::all();
    }
    public function handleCustomer(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'email'   => [
                'nullable',
                'email',
                Rule::unique('customers', 'email')->ignore($request->id),
            ],
            'address' => 'nullable|string',
        ]);

        return Customer::updateOrCreate(
            ['id' => $request->id],
            $request->only(['name', 'phone', 'email', 'address'])
        );
    }

    public function getInvoice()
    {
        return Invoice::get();
    }

    public function handleInvoice(Request $request)
    {
        $request->validate([
            'customer_id' => [
                'required',
                'exists:customers,id'
            ],
            'date'        => 'required|date|after_or_equal:today',
            'amount'      => 'required|numeric|min:0.01',
            'status'      => ['required', Rule::in(['Unpaid', 'Paid', 'Cancelled'])],
        ]);

        return Invoice::updateOrCreate(
            ['id' => $request->id],
            $request->except('id')
        );
    }
}
