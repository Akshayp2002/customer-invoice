<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(protected AdminService $adminService) {}

    //for get method using same endpoint
    public function handlegetRequest(Request $request)
    {
        $type = $request->query('type');
        switch ($type) {
            case 'customer':
                $customers = $this->adminService->getCustomer();
                return view('customer.index', compact('customers'));
            case 'invoice':
                $invoices = $this->adminService->getInvoice();
                return view('invoice.index', compact('invoices'));
            default:
                return response()->json(['error' => 'Invalid type provided.'], 400);
        }
    }

    public function createCustomer($id = null)
    {
        $customer = $id ? Customer::findOrFail($id) : null;
        return view('customer.form', compact('customer'));
    }
    public function createInvoice($id = null)
    {
        $customers = Customer::select(['id', 'name'])->get();
        $invoice = $id ? Invoice::findOrFail($id) : null;
        return view('invoice.form', compact('customers', 'invoice'));
    }


    public function handlePostRequest(Request $request)
    {
        $type = $request->input('type', $request->query('type'));
        switch ($type) {
            case 'customer':
                $this->adminService->handleCustomer($request);
                return redirect()->route('admin.handlegetRequest', ['type' => 'customer'])
                    ->with('success', $request->id ? 'Customer updated successfully.' : 'Customer created successfully.');
            case 'invoice':
                $this->adminService->handleInvoice($request);
                return redirect()->route('admin.handlegetRequest', ['type' => 'invoice'])
                    ->with('success', $request->id ? 'Invoice updated successfully.' : 'Invoice created successfully.');
            default:
                return response()->json(['error' => 'Invalid type provided.'], 400);
        }
    }
}
