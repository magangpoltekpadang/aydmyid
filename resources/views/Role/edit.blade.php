@extends('layout.main')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-lg">

    <form action="{{ route('role.update',  $role->role_id) }}" method="POST" class="bg-white shadow rounded px-8 py-6">
        @csrf
        @method('PUT')
        
        <h1 class="text-2xl font-bold mb-6">Edit Role</h1>
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Role Name</label>
            <input type="text" name="role_name" value="{{ old('role_name', $role->role_name) }}"
                   class="w-full border px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block text-gray-700">Code</label>
            <input type="text" name="code" value="{{ old('code', $role->code) }}"
                   class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label class="block text-gray-700">Description</label>
            <textarea name="description" class="w-full border px-4 py-2 rounded">{{ old('description', $role->description) }}</textarea>
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Update</button>
    </form>
</div>
@endsection
