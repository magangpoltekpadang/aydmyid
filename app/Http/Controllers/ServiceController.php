<?php

namespace App\Http\Controllers;

use App\Models\Outlet\Outlet;
use App\Models\Service\Service;
use App\Models\ServiceType\ServiceType;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();
        $services = $query->paginate(10)->withQueryString();
        $service_types = ServiceType::all();
        $outlets = Outlet::all();
        return view('Service.index', compact('outlets', 'service_types'));
    }

    public function create()
    {
        return view('Service.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_name' => 'required|string',
            'service_type_id' => 'required|integer|exists:service_types,service_type_id',
            'price' => 'required|integer',
            'estimated_duration' => 'required|integer',
            'description' => 'required|string',
            'outlet_id' => 'required|integer|exists:outlets,outlet_id',
            'is_active' => 'nullable|in:1,0',
        ]);
        
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        Service::create($validated);
        return redirect()->route('service.index')->with('success', 'Service berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('Service.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        
        $service->update($request->only(['service_name', 'service_type_id', 'price', 'estimated_duration', 'description', 'outlet_id', 'is_active']));
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
