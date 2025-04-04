@extends('root')

@section('root')
    <div class="flex min-h-screen">
        <div class="w-64 bg-gray-50 border-r border-gray-200">

            <div class="py-4 px-6 mt-12">

            </div>

            <div class="mb-10">
                <h3 class="mx-6 mb-2 text-xs text-gray-400 uppercase tracking-widest">
                    Main
                </h3>

                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-6 py-2.5 {{ request()->route()->getName() === 'admin.dashboard' ? 'text-orange-600' : 'text-gray-500 hover:text-orange-600' }} group">
                    <svg class="h-5 w-5 mr-2 {{ request()->route()->getName() === 'admin.dashboard' ? 'text-orange-500' : 'text-gray-400 group-hover:text-orange-500' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Home
                </a>

                <a href="{{ route('admin.handlegetRequest', ['type' => 'customer']) }}"
                    class="flex items-center px-6 py-2.5 {{ request()->query('type') === 'customer' ? 'text-orange-600' : 'text-gray-500 hover:text-orange-600' }} group">
                    <svg class="h-5 w-5 mr-2 {{ request()->query('type') === 'customer' ? 'text-orange-500' : 'text-gray-400 group-hover:text-orange-500' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                    </svg>
                    Customer
                </a>

                <a href="{{ route('admin.handlegetRequest', ['type' => 'invoice']) }}"
                    class="flex items-center px-6 py-2.5 {{ request()->query('type') === 'invoice' ? 'text-orange-600' : 'text-gray-500 hover:text-orange-600' }} group">
                    <svg class="h-5 w-5 mr-2 {{ request()->query('type') === 'invoice' ? 'text-orange-500' : 'text-gray-400 group-hover:text-orange-500' }}""
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>
                    Invoice
                </a>


            </div>
        </div>

        <div class="flex-1">
            <div class="flex justify-end py-3 px-6 bg-gray-50 border-b space-x-6">
                <span class="font-bold">{{ auth()->user()->name ?? 'User' }}</span>

                <form action="{{ route('admin.logout') }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit"
                        class="py-2 px-4 bg-blue-400 hover:bg-red-500 text-white hover:text-black rounded transition duration-300">
                        Logout
                    </button>
                </form>
                <div class="relative flex-shrink-0">

                    <div class="rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                        <img class="inline w-10 h-10 rounded-full" src="https://picsum.photos/150" alt="">
                    </div>
                </div>
            </div>
            <main>
                @yield('admin-content')
            </main>
        </div>
    </div>
@endsection
