<?php

namespace App\Http\Controllers;

use App\Models\NotificationStatuses\NotificationStatuses;
use Illuminate\Http\Request;

class NotificationStatusesController extends Controller
{
    public function index(Request $request)
    {
        $query = NotificationStatuses::query();
        $notivicationStatuses = $query->paginate(10)->withQueryString();
        return view('NotificationStatus.index');
    }

    public function create()
    {
        return view('NotificationStatus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'status_name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        NotificationStatuses::create($validated);
        return redirect()->route('notification-status.index')->with('success', 'Notification Status berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $notificationStatus =  NotificationStatuses::findOrFail($id);
        return view('NotificationStatus.edit', compact('notificationStatus'));
    }

    public function update(Request $request, $id)
    {
        $notificationStatus =  NotificationStatuses::findOrFail($id);
        $notificationStatus->update($request->only(['status_name', 'code', 'description']));
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $notificationStatus =  NotificationStatuses::findOrFail($id);
        $notificationStatus->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
