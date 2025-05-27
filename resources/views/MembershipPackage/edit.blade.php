@extends('layout.main')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-lg">

    <form action="{{ route('membership-package.update',  $membershipPackage->package_id) }}" method="POST" class="bg-white shadow rounded px-8 py-6">
        @csrf
        @method('PUT')
        
        <h1 class="text-2xl font-bold mb-6">Edit Membership Package</h1>
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Package Name</label>
            <input type="text" name="package_name" value="{{ old('package_name', $membershipPackage->package_name) }}"
                   class="w-full border px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block text-gray-700">Duration Days</label>
            <input type="text" name="duration_days" value="{{ old('duration_days', $membershipPackage->duration_days) }}"
                   class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label class="block text-gray-700">Price</label>
            <input type="text" name="price" value="{{ old('price', $membershipPackage->price) }}"
                   class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label class="block text-gray-700">Max Vehicles</label>
            <input type="text" name="max_vehicles" value="{{ old('max_vehicles', $membershipPackage->max_vehicles) }}"
                   class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label class="block text-gray-700">Description</label>
            <textarea name="description" class="w-full border px-4 py-2 rounded">{{ old('description', $membershipPackage->description) }}</textarea>
        </div>

        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" {{ $membershipPackage->is_active ? 'checked' : '' }} class="form-checkbox">
                <span class="ml-2">Active</span>
            </label>
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Update</button>
    </form>
</div>
@endsection
