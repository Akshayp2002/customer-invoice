<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Injecting AdminService in the constructor for dependency injection
    public function __construct(protected AdminService $adminService) {}

    /**
     * Handles GET requests based on the 'type' parameter.
     * If 'customer' → Fetches and displays customers.
     * If 'invoice' → Fetches and displays invoices.
     */
    public function handlegetRequest(Request $request)
    {
        $type = $request->query('type');

        switch ($type) {
            case 'customer':
                $customers = $this->adminService->getCustomer(); // Fetch customers from service
                return view('customer.index', compact('customers'));

            case 'invoice':
                $invoices = $this->adminService->getInvoice(); // Fetch invoices from service
                return view('invoice.index', compact('invoices'));

            default:
                return response()->json(['error' => 'Invalid type provided.'], 400);
        }
    }

    /**
     * Displays the customer form.
     * If an ID is provided, fetches the existing customer for editing.
     */
    public function createCustomer($id = null)
    {
        $customer = $id ? Customer::findOrFail($id) : null; // Fetch customer if ID exists, otherwise null
        return view('customer.form', compact('customer'));
    }

    /**
     * Displays the invoice form.
     * Fetches customers for selection and existing invoice if an ID is provided.
     */
    public function createInvoice($id = null)
    {
        $customers = Customer::select(['id', 'name'])->get(); // Fetch all customers for dropdown
        $invoice = $id ? Invoice::findOrFail($id) : null; // Fetch invoice if ID exists
        return view('invoice.form', compact('customers', 'invoice'));
    }

    /**
     * Handles form submission for both customer and invoice.
     * Determines the type (customer/invoice) and processes accordingly.
     */
    public function handlePostRequest(Request $request)
    {
        $type = $request->input('type', $request->query('type'));

        switch ($type) {
            case 'customer':
                $this->adminService->handleCustomer($request); // Handle customer creation/update
                return redirect()->route('admin.handlegetRequest', ['type' => 'customer'])
                    ->with('success', $request->id ? 'Customer updated successfully.' : 'Customer created successfully.');

            case 'invoice':
                $this->adminService->handleInvoice($request); // Handle invoice creation/update
                return redirect()->route('admin.handlegetRequest', ['type' => 'invoice'])
                    ->with('success', $request->id ? 'Invoice updated successfully.' : 'Invoice created successfully.');

            default:
                return response()->json(['error' => 'Invalid type provided.'], 400);
        }
    }
}
