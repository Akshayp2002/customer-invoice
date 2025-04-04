@extends('layouts.admin')

@section('admin-content')
    <div class="container mx-auto p-6 sm:p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Invoices</h1>
            <a href="{{ route('admin.createInvoice') }}" class="bg-indigo-600 text-white px-4 py-2 rounded shadow">
                + Create Invoice
            </a>
        </div>

        <!-- Alert Messages -->
        <x-alert-messages />

        <!-- Table -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Customer</th>
                        <th class="py-3 px-6 text-left">Date</th>
                        <th class="py-3 px-6 text-left">Amount</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                @if (isset($invoices))
                    <tbody class="text-gray-700 text-sm">

                        @foreach ($invoices as $invoice)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6">{{ $invoice->id }}</td>
                                <td class="py-3 px-6">{{ $invoice->customer->name ?? 'N/A' }}</td>
                                <td class="py-3 px-6">{{ $invoice->date ?? 'N/A' }}</td>
                                <td class="py-3 px-6">₹{{ number_format($invoice->amount, 2) }}</td>
                                <td class="py-3 px-6">
                                    <span
                                        class="px-2 py-1 rounded text-white 
                                    {{ $invoice->status == 'Paid' ? 'bg-green-500' : ($invoice->status == 'Cancelled' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                        {{ $invoice->status }}
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <a href="{{ route('admin.createInvoice', $invoice->id) }}"
                                        class="bg-blue-500 text-white px-3 py-1 rounded">Edit</a>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <p>No data available</p>
                        </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
