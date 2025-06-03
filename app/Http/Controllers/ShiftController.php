<?php

namespace App\Http\Controllers;

use App\Models\Outlet\Outlet;
use App\Models\Shift\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index(Request $request)
    {
        $query = Shift::query();
        $shifts = $query->paginate(10)->withQueryString();
        $outlets = Outlet::all();
        return view('Shift.index', compact('outlets'));
    }

    public function create()
    {
        return view('Shift.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'outlet_id' => 'required|integer|exists:outlets,outlet_id',
            'shift_name' => 'nullable|string|max:50',
            'start_time' => 'required',
            'end_time' => 'required',
            'is_active' => 'nullable|in:1,0',
        ]);
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        Shift::create($validated);
        return redirect()->route('shift.index')->with('success', 'Shift berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $shift = Shift::findOrFail($id);
        return view('Shift.edit', compact('shift'));
    }

    public function update(Request $request, $id)
    {
        $shift = Shift::findOrFail($id);
        $shift->update($request->only(['outlet_id', 'shift_name', 'start_time', 'end_time', 'is_active']));
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $shift = Shift::findOrFail($id);
        $shift->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
