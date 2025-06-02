<?php

namespace App\Http\Controllers;

use App\Models\Customer\Customer;
use App\Models\VehicleType\VehicleType;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();
        $customer = $query->paginate(10)->withQueryString();
        $vehicle_types = VehicleType::all();
        return view('Customer.index', compact('vehicle_types'));
    }

    public function create()
    {
        return view('Customer.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'plate_number' => 'required|string|max:10',
            'name' => 'required|string|max:50',
            'phone_number' => 'required|string|max:20',
            'vehicle_type_id' => 'required|integer|exists:vehicle_types,vehicle_type_id',
            'vehicle_color' => 'required|string|max:20',
            'is_member' => 'nullable|in:1,0',
        ]);

        $joinDate = now();
        $validated['join_date'] = $joinDate;

        $isMember = $validated['is_member'] ?? 0;

        if ($isMember == 1) {
            // Cari nomor member terakhir
            $lastCustomer = Customer::whereNotNull('member_number')->orderByDesc('customer_id')->first();

            // Ambil angka dari member_number terakhir, misalnya 'M005' -> 5
            $lastNumber = 0;
            if ($lastCustomer && preg_match('/MB(\d+)/', $lastCustomer->member_number, $matches)) {
                $lastNumber = (int) $matches[1];
            }

            $newNumber = $lastNumber + 1;
            $validated['member_number'] = 'MB' . str_pad($newNumber, 2, '0', STR_PAD_LEFT); 

            $validated['member_expiry_date'] = $joinDate->copy()->addYear();
        } else {
            $validated['member_number'] = '-';
            $validated['member_expiry_date'] = null;
        }

        Customer::create($validated);
        return redirect()->route('customer.index')->with('success', 'Customer berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('Customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $joinDate = now();
        $validated['join_date'] = $joinDate;

        $isMember = $validated['is_member'] ?? 0;

        if ($isMember == 1) {
            // Cari nomor member terakhir
            $lastCustomer = Customer::whereNotNull('member_number')->orderByDesc('customer_id')->first();

            // Ambil angka dari member_number terakhir, misalnya 'M005' -> 5
            $lastNumber = 0;
            if ($lastCustomer && preg_match('/MB(\d+)/', $lastCustomer->member_number, $matches)) {
                $lastNumber = (int) $matches[1];
            }

            $newNumber = $lastNumber + 1;
            $validated['member_number'] = 'MB' . str_pad($newNumber, 2, '0', STR_PAD_LEFT); 

            $validated['member_expiry_date'] = $joinDate->copy()->addYear();
        } else {
            $validated['member_number'] = '-';
            $validated['member_expiry_date'] = null;
        }
        
        $customer->update($request->only(['plate_number', 'name', 'phone_number', 'vehicle_type_id', 'vehicle_color', 'member_number', 'join_date', 'member_expiry_date', 'is_member']));
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
