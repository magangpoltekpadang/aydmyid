<?php

namespace App\Http\Controllers;

use App\Models\Expense\Expense;
use App\Models\Outlet\Outlet;
use App\Models\Shift\Shift;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::query();
        $expense = $query->paginate(10)->withQueryString();
        $outlets = Outlet::all();
        $staff = Staff::all();
        $shifts = Shift::all();
        return view('Expense.index', compact('outlets', 'staff', 'shifts'));
    }

    public function create()
    {
        return view('Expense.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_code' => 'required|string|max:10',
            'outlet_id' => 'required|integer|exists:outlets,outlet_id',
            'amount' => 'required|integer',
            'category' => 'required|string|max:10',
            'description' => 'required|string|max:10',
            'staff_id' => 'required|integer|exists:staff,staff_id',
            'shift_id' => 'required|integer|exists:shifts,shift_id',
        ]);

        $expenseDate = now();
        $validated['expense_date'] = $expenseDate;

        Expense::create($validated);
        return redirect()->route('expense.index')->with('success', 'Expense berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        return view('Expense.edit', compact('expense'));
    }

    public function update(Request $request, $id)
    {
        $expense = Expense::findOrFail($id);

        $expenseDate = now();
        $validated['expense_date'] = $expenseDate;
        
        $expense->update($request->only(['expense_code', 'outlet_id', 'expense_date', 'amount', 'category', 'description', 'staff_id', 'shift_id']));
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
