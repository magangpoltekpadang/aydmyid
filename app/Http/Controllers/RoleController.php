<?php

namespace App\Http\Controllers;

use App\Models\Role\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $query = Role::query();
        $role = $query->paginate(10)->withQueryString();
        return view('Role.index'); 
    }

    public function create()
    {
        return view('Role.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'role_name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);
        Role::create($validated);
        return redirect()->route('role.index')->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('Role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->only(['role_name', 'code', 'description']));
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
