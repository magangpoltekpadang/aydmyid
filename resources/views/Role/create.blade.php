<form action="{{ route('role.store') }}" method="POST" 
    class="rounded-xl border border-gray-200 dark:bg-white-900 dark:border-white p-5 space-y-5 shadow-sm">
    @csrf
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray">Add New Role</h2>

    {{-- Role Name --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fa fa-user" aria-hidden="true"></i>
        </span>
        <input type="text" id="role_name" name="role_name" value="{{ old('role_name') }}" required
            placeholder="Role Name"
            class="w-full h-11 px-3 pl-9 text-sm text-black bg-white border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
    </div>

    {{-- Code --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fa fa-key" aria-hidden="true"></i>
        </span>
        <input type="text" id="code" name="code" value="{{ old('code') }}" required
            placeholder="Code"
            class="w-full h-11 px-3 pl-9 text-sm text-black bg-white border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
    </div>

    {{-- Description --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fa fa-file-alt" aria-hidden="true"></i>
        </span>
        <input type="text" id="description" name="description" value="{{ old('description') }}" required
            placeholder="Description"
            class="w-full h-11 px-3 pl-9 text-sm text-black bg-white border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
    </div>

    {{-- Tombol Aksi --}}
    <div class="flex justify-between items-center">
        <button @click="showCreateModal = false" 
            class="text-sm font-semibold text-white bg-red-600 px-4 py-2 rounded hover:bg-red-700 transition transition">Cencle
        </button>
        <button type="submit"
            class="bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded hover:bg-indigo-700 transition">
            Submit
        </button>
    </div>
</form>

