<?php

namespace App\Http\Controllers;

use App\Models\Customer\Customer;
use App\Models\Notification\Notification;
use App\Models\NotificationStatuses\NotificationStatuses;
use App\Models\NotificationType\NotificationType;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $query = Notification::query();
        $notification = $query->paginate(10)->withQueryString();
        $customers = Customer::all();
        $notification_types = NotificationType::all();
        $notification_statuses = NotificationStatuses::all();
        return view('Notification.index', compact('customers', 'notification_types', 'notification_statuses')); 
    }

    public function create()
    {
        return view('Notification.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|integer|exists:customers,customer_id',
            'notification_type_id' => 'required|integer|exists:notification_types,notification_type_id',
            'message' => 'required|string',
            'status_id' => 'required|integer|exists:notification_statuses,status_id',
            'retry_count' => 'nullable|integer',
        ]);
        $validated['sent_at'] = now();
        
        Notification::create($validated);
        return redirect()->route('notification.index')->with('success', 'Customer berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $notification = Notification::findOrFail($id);
        return view('Notification.edit', compact('notification'));
    }

    public function update(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update($request->only(['customer_id', 'notification_type_id', 'message', 'sent_at', 'status_id', 'retry_count']));
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
