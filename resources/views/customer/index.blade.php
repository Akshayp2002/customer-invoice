@extends('layouts.admin')

@section('admin-content')
    <div class="container mx-auto p-6 sm:p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Customer</h1>
            <a href="{{ route('admin.createCustomer') }}" class="bg-indigo-600 text-white px-4 py-2 rounded shadow">
                + Create Customer
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
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Phone</th>
                        <th class="py-3 px-6 text-left">Address</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                @if (isset($customers) && count($customers) > 0)
                    <tbody class="text-gray-700 text-sm">
                        @foreach ($customers as $customer)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6">{{ $customer->id }}</td>
                                <td class="py-3 px-6">{{ $customer->name ?? 'N/A' }}</td>
                                <td class="py-3 px-6">{{ $customer->email ?? 'N/A' }}</td>
                                <td class="py-3 px-6">{{ $customer->phone ?? 'N/A' }}</td>
                                <td class="py-3 px-6">{{ $customer->address ?? 'N/A' }}</td>
                                <td class="py-3 px-6 text-center">
                                    <a href="{{ route('admin.createCustomer', $customer->id) }}"
                                        class="bg-blue-500 text-white px-3 py-1 rounded">Edit</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @endif
            </table>
        </div>
    </div>
@endsection
