<?php

namespace App\Http\Controllers;

use App\Models\ServiceType\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceType::query();
        $serviceTypes = $query->paginate(10)->withQueryString();
        return view('ServiceType.index');
    }

    public function create()
    {
        return view('ServiceType.create');
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
        ServiceType::create($validated);
        return redirect()->route('service-type.index')->with('success', 'Service type berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $serviceType = ServiceType::findOrFail($id);
        return view('ServiceType.edit', compact('serviceType'));
    }

    public function update(Request $request, $id)
    {
        $serviceType = ServiceType::findOrFail($id);
        $serviceType->update($request->only(['type_name', 'code', 'description', 'is_active']));
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $serviceType = ServiceType::findOrFail($id);
        $serviceType->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
