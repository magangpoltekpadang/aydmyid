<?php

namespace App\Http\Controllers;

use App\Models\VehicleType\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = VehicleType::query();
        $vehicleTypes = $query->paginate(10)->withQueryString();
        return view('VehicleType.index');
    }

    public function create()
    {
        return view('VehicleType.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'is_active' => 'nullable|in:1,0',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        VehicleType::create($validated);
        return redirect()->route('vehicle-type.index')->with('success', 'Vehicle type berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $vehicleType = VehicleType::findOrFail($id);
        return view('VehicleType.edit', compact('vehicleType'));
    }

    public function update(Request $request, $id)
    {
        $vehicleType = VehicleType::findOrFail($id);
        $vehicleType->update($request->only(['type_name', 'code', 'description', 'is_active']));
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $vehicleType = VehicleType::findOrFail($id);
        $vehicleType->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
