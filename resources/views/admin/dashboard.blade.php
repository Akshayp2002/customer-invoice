@extends('layouts.admin')

@section('admin-content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100 p-6">
        <div class="bg-white shadow-xl rounded-lg p-8 w-full max-w-lg sm:w-3/4 md:w-1/2 lg:w-1/3">
            <!-- Error Message -->
            <x-alert-messages />
            <div class="border-b pb-4 mb-4">
                <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800">{{ $user->name ?? 'User' }}</h2>
            </div>

        </div>
    </div>
@endsection
