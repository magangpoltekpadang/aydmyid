<?php

namespace App\Http\Controllers;

use App\Models\Notification\Notification;
use Illuminate\Http\Request;


class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $query = Notification::query();
        $notifications = $query->paginate(10)->withQueryString();
        return view('Notification.index');
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
            'message' => 'nullable|string|200',
            'sent_at' => 'nullable|date_format:Y-m-d H:i:s',
            'status_id' => 'required|integer|exists:notification_statuses,status_id',
            'retry_count' => 'nullable|string|200',
        ]);
        Notification::create($validated);
        return redirect()->route('notification.index')->with('success', 'Notification berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $notification = Notification::findOrFail($id);
        return view('Notification.edit', compact('vnotification'));
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
