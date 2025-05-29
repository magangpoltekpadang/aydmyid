<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index(Request $request)
    {
        $query = PaymentMethod::query();
        $paymentMethods = $query->paginate(10)->withQueryString();
        return view('PaymentMethod.index');
    }

    public function create()
    {
        return view('PaymentMethod.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'method_name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'is_active' => 'nullable|in:1,0',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        PaymentMethod::create($validated);
        return redirect()->route('payment-method.index')->with('success', 'Payment Method berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        return view('PaymentMethod.edit', compact('paymentMethod'));
    }

    public function update(Request $request, $id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->update($request->only(['method_name', 'code', 'is_active']));
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
