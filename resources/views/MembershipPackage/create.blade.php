@extends('layout.main')

@section('content')

<div class="container mx-auto px-4 py-6 max-w-lg">
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('membership-package.store') }}" method="POST" class="bg-white shadow rounded px-8 py-6">
        @csrf
         <h1 class="text-2xl font-bold mb-6">Add New Package</h1>
        <div class="mb-4">
            <label for="type_name" class="block text-gray-700 font-semibold mb-2">Type Name <span class="text-red-600">*</span></label>
            <input type="text" id="type_name" name="type_name" value="{{ old('type_name') }}" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <div class="mb-4">
            <label for="code" class="block text-gray-700 font-semibold mb-2">Code</label>
            <input type="text" id="code" name="code" value="{{ old('code') }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
            <textarea id="description" name="description" rows="3"
                      class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description') }}</textarea>
        </div>

        <div class="mb-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" value="1" 
                       {{ old('is_active', true) ? 'checked' : '' }}
                       class="form-checkbox text-indigo-600" />
                <span class="ml-2 text-gray-700 font-semibold">Aktifkan</span>
            </label>
        </div>

        <div class="flex items-center justify-between">
            <a href="/vehicle-type" 
               class="text-gray-600 hover:text-gray-900">Batal</a>

            <button type="submit" 
                    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
