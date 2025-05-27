<?php

namespace App\Http\Controllers;

use App\Models\VehicleType\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VehicleTypeController extends Controller
{
    public function index()
    {
        $vehicleTypes = VehicleType::all();
        return view('VehicleType.index', compact('vehicleTypes')); 
    }

    public function create()
    {
        return view('VehicleType.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'type_name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        // Simpan data ke DB
        VehicleType::create($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('VehicleType.index')->with('success', 'Vehicle type berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $vehicleType = VehicleType::findOrFail($id);
        return view('VehicleType.edit', compact('vehicleType'));
    }

    public function update(Request $request, $id)
    {
        $vehicleType = VehicleType::findOrFail($id);

        $vehicleType->update([
            'type_name' => $request->type_name,
            'code' => $request->code,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('VehicleType.index')->with('success', 'Vehicle Type updated successfully.');
    }

    public function destroy($id)
    {
        VehicleType::destroy($id);
        return redirect()->route('VehicleType.index')->with('success', 'Vehicle Type deleted.');
    }

}
