<?php

namespace App\Http\Controllers;

use App\Models\MembershipPackage\MembershipPackage;
use Illuminate\Http\Request;

class MembershipPackageController extends Controller
{
    public function index(Request $request)
    {
        $query = MembershipPackage::query();
        $membershipPackage = $query->paginate(10)->withQueryString();
        return view('MembershipPackage.index'); // view awal
    }

    public function create()
    {
        return view('MembershipPackage.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_name' => 'required|string|max:255',
            'duration_days' => 'nullable|string|max:50',
            'price' => 'required|string',
            'max_vehicles' => 'nullable|string|max:50',
            'description'=> 'nullable|string|max:50',
            'is_active' => 'nullable|in:1,0',
        ]);
        
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        MembershipPackage::create($validated);
        return redirect()->route('membership-package.index')->with('success', 'Membership Package berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $membershipPackage = MembershipPackage::findOrFail($id);
        return view('MembershipPackage.edit', compact('membershipPackage'));
    }

    public function update(Request $request, $id)
    {
        $membershipPackage = MembershipPackage::findOrFail($id);
        $membershipPackage->update($request->only(['package_name', 'duration_days', 'price', 'max_vehicles', 'description', 'is_active']));
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $membershipPackage = MembershipPackage::findOrFail($id);
        $membershipPackage->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
