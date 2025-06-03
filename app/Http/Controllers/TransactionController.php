<?php

namespace App\Http\Controllers;

use App\Models\Customer\Customer;
use App\Models\Outlet\Outlet;
use App\Models\PaymentStatus\PaymentStatus;
use App\Models\Shift\Shift;
use App\Models\Staff\Staff;
use App\Models\Transaction\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::query();
        $transactions = $query->paginate(10)->withQueryString();
        $customers = Customer::all();
        $outlets = Outlet::all();
        $payment_statuses = PaymentStatus::all();
        $staffs = Staff::all();
        $shifts = Shift::all();
        return view('Transaction.index', compact('customers', 'outlets', 'payment_statuses', 'staffs', 'shifts'));
    }

    public function create()
    {
        return view('Transaction.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_code' => 'required|string',
            'customer_id' => 'required|integer|exists:customers,customer_id',
            'outlet_id' => 'required|integer|exists:outlets,outlet_id',
            'subtotal' => 'required|numeric',
            'discount' => 'required|numeric',
            'tax' => 'required|numeric',
            'final_price' => 'required|numeric',
            'payment_status_id' => 'required|integer|exists:payment_statuses,payment_status_id',
            'gate_opened' => 'nullable|in:1,0',
            'staff_id' => 'required|integer|exists:staffs,staff_id',
            'shift_id' => 'required|integer|exists:shifts,shift_id',
            'receipt_printed' => 'nullable|in:1,0',
            'whatsapp_sent' => 'nullable|in:1,0',
            'notes' => 'required|string',
        ]);

        $validated += [
            'transaction_date' => now(),
            'gate_opened' => $request->has('gate_opened') ? 1 : 0,
            'receipt_printed' => $request->has('receipt_printed') ? 1 : 0,
            'whatsapp_sent' => $request->has('whatsapp_sent') ? 1 : 0,
        ];

        Transaction::create($validated);
        return redirect()->route('transaction.index')->with('success', 'transaction berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('Transaction.edit', compact('transaction'));
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->update($request->only(['transaction_code', 'customer_id', 'outlet_id', 'transaction_date', 'subtotal', 'discount', 'tax', 'final_price', 'payment_status_id', 'gate_opened', 'staff_id', 'shift_id', 'receipt_printed', 'whatsapp_sent', 'notes']));
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
