 @extends('layouts.admin')

 @section('admin-content')
     <div class="container mx-auto p-8 flex">
         <div class="max-w-md w-full mx-auto">
             <h1 class="text-4xl text-center mb-12 font-thin">Deposit</h1>
             <!-- Error Messages -->
             <x-alert-messages />
             <div class="bg-white rounded-lg overflow-hidden shadow-2xl">
                 <div class="p-8">
                     <!-- Current Account Number -->
                     <div class="mb-5">
                         <label class="block mb-2 text-sm font-medium text-gray-600">Account Number</label>
                         <input type="text" value="{{ auth()->user()->account->account_number ?? "N/A"}}" disabled
                             class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                     </div>
                     <!-- Deposit Form -->
                     <form method="POST" action="{{ route('admin.deposit') }}">
                         @csrf
                         <div class="mb-5">
                             <label for="amount" class="block mb-2 text-sm font-medium text-gray-600">Deposit
                                 Amount</label>
                             <input type="number" name="amount" value="{{ old('amount') }}" required
                                 class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                         </div>

                         <div class="mb-5">
                             <label for="description" class="block mb-2 text-sm font-medium text-gray-600">Description
                                 (Optional)</label>
                             <input type="text" name="description" value="{{ old('description') }}"
                                 class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                         </div>
                         <button class="w-full p-3 mt-4 bg-indigo-600 text-white rounded shadow">Deposit</button>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 @endsection
