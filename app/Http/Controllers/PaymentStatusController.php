<?php

namespace App\Http\Controllers;

use App\Models\PaymentStatus\PaymentStatus;
use Illuminate\Http\Request;

class PaymentStatusController extends Controller
{
    public function index(Request $request)
    {
        $query = PaymentStatus::query();
        $paymentStatuss = $query->paginate(10)->withQueryString();
        return view('PaymentStatus.index');
    }

    public function create()
    {
        return view('PaymentStatus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'status_name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'is_active' => 'nullable|in:1,0',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        PaymentStatus::create($validated);
        return redirect()->route('payment-status.index')->with('success', 'Payment Status berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $paymentStatus = PaymentStatus::findOrFail($id);
        return view('PaymentStatus.edit', compact('paymentStatus'));
    }

    public function update(Request $request, $id)
    {
        $paymentStatus = PaymentStatus::findOrFail($id);
        $paymentStatus->update($request->only(['status_name', 'code', 'description', 'is_active']));
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $paymentStatus = PaymentStatus::findOrFail($id);
        $paymentStatus->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
