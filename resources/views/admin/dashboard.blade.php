@extends('layouts.admin')

@section('admin-content')
<div class="bg-white shadow-md w-full p-6 text-center">
    <h2 class="text-3xl font-semibold text-gray-800">Welcome, {{ $user->name ?? 'Admin' }}</h2>
</div>

<!-- Empty space for future content -->
<div class="p-6 text-center text-gray-500">
    <p>Dashboard content will be displayed here.</p>
</div>
@endsection
