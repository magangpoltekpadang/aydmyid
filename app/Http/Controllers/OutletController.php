<?php

namespace App\Http\Controllers;

use App\Models\Outlet\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function index(Request $request)
    {
        $query = Outlet::query();
        $outlet = $query->paginate(10)->withQueryString();
        return view('Outlet.index');
    }

    public function create()
    {
        return view('Outlet.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'outlet_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:50',
            'phone_number' => 'nullable|string|max:50',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'is_active' => 'nullable|in:1,0',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        Outlet::create($validated);
        return redirect()->route('outlet.index')->with('success', 'Outlet berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $outlet = Outlet::findOrFail($id);
        return view('Outlet.edit', compact('outlet'));
    }

    public function update(Request $request, $id)
    {
        $outlet = Outlet::findOrFail($id);
        $outlet->update($request->only(['outlet_name', 'address', 'phone_number', 'latitude', 'longitude', 'is_active']));
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $outlet = Outlet::findOrFail($id);
        $outlet->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
