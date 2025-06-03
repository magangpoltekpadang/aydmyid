<?php

namespace App\Http\Controllers;

use App\Models\Service\Service;
use App\Models\Staff\Staff;
use App\Models\Transaction\Transaction;
use App\Models\TransactionService\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class TransactionServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = TransactionService::query();
        $transaction_services = $query->paginate(10)->withQueryString();
        $transactions = Transaction::all();
        $services = Service::all();
        $staffs = Staff::all();
        return view('TransactionService.index', compact('transactions', 'services', 'staffs'));
    }

    public function create()
    {
        return view('TransactionService.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_id' => 'required|integer|exists:transactions,transaction_id',
            'service_id' => 'required|integer|exists:services,service_id',
            'quantity' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'discount' => 'required|numeric',
            'worker_id' => 'required|integer|exists:staff,staff_id',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'nullable|in:pending,in_progress,completed,cancelled',
            'notes' => 'required|string',
        ]);
       
        // Hitung total price
        $totalPrice = ($validated['quantity'] * $validated['unit_price']) + $validated['discount'];
        $validated['total_price'] = $totalPrice;

        TransactionService::create($validated);
        return redirect()->route('transaction-service.index')->with('success', 'Transaction Service berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $transaction_services = TransactionService::findOrFail($id);
        return view('TransactionService.edit', compact('transaction_services'));
    }

    public function update(Request $request, $id)
    {
        $transaction_services = TransactionService::findOrFail($id);
        $transaction_services->update($request->only(['transaction_id','service_id','quantity','unit_price','discount','worker_id','start_time','end_time','status','notes']));
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $transaction_services = TransactionService::findOrFail($id);
        $transaction_services->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
