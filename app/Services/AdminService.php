<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminService
{
    /**
     * Fetch all customers from the database.
     */
    public function getCustomer()
    {
        return Customer::all();
    }

    /**
     * Handles the creation or update of a customer.
     * Validates request data before saving to the database.
     */
    public function handleCustomer(Request $request)
    {
        // Validate request data
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

        // Create or update the customer based on the request ID
        return Customer::updateOrCreate(
            ['id' => $request->id],
            $request->only(['name', 'phone', 'email', 'address'])
        );
    }

    /**
     * Fetch all invoices from the database.
     */
    public function getInvoice()
    {
        return Invoice::get();
    }

    /**
     * Handles the creation or update of an invoice.
     * Validates request data before saving to the database.
     */
    public function handleInvoice(Request $request)
    {
        // Validate request data
        $request->validate([
            'customer_id' => [
                'required',
                'exists:customers,id'
            ],
            'date'        => 'required|date|after_or_equal:today',
            'amount'      => 'required|numeric|min:0.01',
            'status'      => ['required', Rule::in(['Unpaid', 'Paid', 'Cancelled'])],
        ]);

        // Create or update the invoice based on the request ID
        return Invoice::updateOrCreate(
            ['id' => $request->id],
            $request->except('id')
        );
    }
}
