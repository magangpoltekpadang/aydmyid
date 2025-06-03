<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Outlet\Outlet;
use App\Models\Role\Role;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $query = Staff::query();
        $staffs = $query->paginate(10)->withQueryString();
        $outlets = Outlet::all();
        $roles = Role::all();
        return view('Staff.index', compact('outlets', 'roles'));
    }

    public function create()
    {
        return view('Staff.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone_number' => 'required|string',
            'password_hash' => 'required|string',
            'outlet_id' => 'required|integer|exists:outlets,outlet_id',
            'role_id' => 'required|integer|exists:roles,role_id',
            'is_active' => 'nullable|in:1,0',
        ]);

        $validated['last_login'] = now();
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        Staff::create($validated);
        return redirect()->route('staff.index')->with('success', 'Staff berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return view('Staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $staff= Staff::findOrFail($id);
        
        $staff->update($request->only(['name', 'email', 'phone_number', 'password_hash', 'outlet_id', 'role_id', 'last_login', 'is_active']));
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $staff= Staff::findOrFail($id);
        $staff->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
