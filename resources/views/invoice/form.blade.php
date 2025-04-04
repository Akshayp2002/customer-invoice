@extends('layouts.admin')

@section('admin-content')
    <div class="container mx-auto p-6 sm:p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">
                {{ $invoice ? 'Edit Invoice' : 'Create Invoice' }}
            </h1>
            <a href="{{ route('admin.handlegetRequest', ['type' => 'invoice']) }}"
                class="bg-gray-600 text-white px-4 py-2 rounded shadow">
                ← Back to Invoices
            </a>
        </div>

        <x-alert-messages />

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ $invoice ? route('admin.handlePostRequest', $invoice->id) : route('admin.handlePostRequest') }}"
                method="POST">
                @csrf
                @if ($invoice)
                    @method('PUT')
                @endif

                <input type="hidden" name="type" value="invoice">

                <!-- Customer -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Customer <span
                            class="text-red-500">*</span></label>
                    <select name="customer_id"
                        class="w-full p-2 border border-gray-300 rounded focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                        <option value="">Select a Customer</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}"
                                {{ old('customer_id', $invoice->customer_id ?? '') == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Date -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Date</label>
                    <input type="date" name="date" value="{{ old('date', $invoice->date ?? now()->format('Y-m-d')) }}"
                        class="w-full p-2 border border-gray-300 rounded focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Amount -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Amount</label>
                    <input type="number" name="amount" value="{{ old('amount', $invoice->amount ?? '') }}" step="0.01"
                        class="w-full p-2 border border-gray-300 rounded focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Status</label>
                    <select name="status"
                        class="w-full p-2 border border-gray-300 rounded focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                        <option value="Unpaid" {{ old('status', $invoice->status ?? '') == 'Unpaid' ? 'selected' : '' }}>
                            Unpaid</option>
                        <option value="Paid" {{ old('status', $invoice->status ?? '') == 'Paid' ? 'selected' : '' }}>Paid
                        </option>
                        <option value="Cancelled"
                            {{ old('status', $invoice->status ?? '') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                        {{ $invoice ? 'Update Invoice' : 'Save Invoice' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
