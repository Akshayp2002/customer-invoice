@extends('layouts.admin')

@section('admin-content')
    <div class="container mx-auto p-6 sm:p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">{{ isset($customer) ? 'Edit Customer' : 'Create Customer' }}</h1>
            <a href="{{ route('admin.handlegetRequest', ['type' => 'customer']) }}"
                class="bg-gray-600 text-white px-4 py-2 rounded shadow">
                ← Back to Customers
            </a>
        </div>

        <!-- Alert Messages -->
        <x-alert-messages />

        <!-- Customer Form -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <form
                action="{{ isset($customer) ? route('admin.handlePostRequest', $customer->id) : route('admin.handlePostRequest') }}"
                method="POST">
                @csrf
                @if (isset($customer))
                    @method('PUT')
                @endif
                <input type="hidden" name="type" value="customer">

                <!-- Name & Phone -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <!-- Name -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="name"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-indigo-500 focus:border-indigo-500"
                            value="{{ old('name', $customer->name ?? '') }}" required>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Phone</label>
                        <input type="text" name="phone"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-indigo-500 focus:border-indigo-500"
                            value="{{ old('phone', $customer->phone ?? '') }}">
                    </div>
                </div>

                <!-- Email & Address -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <!-- Email -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" name="email"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-indigo-500 focus:border-indigo-500"
                            value="{{ old('email', $customer->email ?? '') }}">
                    </div>

                    <!-- Address -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Address</label>
                        <textarea name="address" rows="3"
                            class="w-full p-2 border border-gray-300 rounded focus:ring-indigo-500 focus:border-indigo-500">{{ old('address', $customer->address ?? '') }}</textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                        {{ isset($customer) ? 'Update Customer' : 'Save Customer' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
