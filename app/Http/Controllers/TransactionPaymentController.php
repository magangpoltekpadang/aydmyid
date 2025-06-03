<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod\PaymentMethod;
use App\Models\Transaction\Transaction;
use App\Models\TransactionPayment\TransactionPayment;
use App\Models\TransactionService\TransactionService;
use Illuminate\Http\Request;

class TransactionPaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = TransactionPayment::query();
        $transaction_payments = $query->paginate(10)->withQueryString();
        $transactions = Transaction::all();
        $payment_methods = PaymentMethod::all();
        $transaction_services = TransactionService::all();
        return view('TransactionPayment.index', compact('transactions', 'transaction_services', 'payment_methods'));
    }

    public function create()
    {
        return view('TransactionPayment.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_id' => 'required|integer|exists:transactions,transaction_id',
            'payment_method_id' => 'required|integer|exists:payment_methods,payment_method_id',
            'amount' => 'required|numeric',
            'payment_date'=> 'required|date',
            'reference_number'=> 'required|string',
            'status_id' => 'required|integer|exists:transaction_services,transaction_service_id',
            'notes' => 'required|string'
        ]);

        TransactionPayment::create($validated);
        return redirect()->route('transaction-payment.index')->with('success', 'Transaction berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $transactionPayment = TransactionPayment::findOrFail($id);
        return view('TransactionPayment.edit', compact('transactionPayment'));
    }

    public function update(Request $request, $id)
    {
        $transactionPayment = TransactionPayment::findOrFail($id);

        $transactionPayment->update($request->only(['transaction_id', 'payment_method_id', 'amount', 'payment_date', 'reference_number', 'status_id', 'notes']));
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $transactionPayment = TransactionPayment::findOrFail($id);
        $transactionPayment->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
