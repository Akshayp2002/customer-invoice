@extends('layouts.admin')

@section('admin-content')
    <div class="container mx-auto p-6 sm:p-8">
        <h1 class="text-2xl font-bold mb-6">Account Statement</h1>
        <!-- Alert Messages -->
        <x-alert-messages />
        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-3 text-left text-gray-700">Transaction ID</th>
                        <th class="px-4 py-3 text-left text-gray-700">Type</th>
                        <th class="px-4 py-3 text-left text-gray-700">Amount</th>
                        <th class="px-4 py-3 text-left text-gray-700">Receiver</th>
                        <th class="px-4 py-3 text-left text-gray-700">Description</th>
                        <th class="px-4 py-3 text-left text-gray-700">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr class="border-t">
                            <td class="px-4 py-3 text-gray-700">{{ $transaction->id ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ ucfirst($transaction->type) ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ number_format($transaction->amount, 2) ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-gray-700">
                                {{ $transaction->receiver_id ? $transaction->receiver->name : 'N/A' }}
                            </td>
                            <td class="px-4 py-3 text-gray-700">{{ $transaction->description ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-gray-700">
                                {{ $transaction->created_at->format('Y-m-d H:i') ?? 'Date' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $transactions->links() }}
        </div>
    </div>
@endsection
