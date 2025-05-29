<?php

namespace App\Http\Controllers;

use App\Models\NotificationType\NotificationType;
use Illuminate\Http\Request;

class NotificationTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = NotificationType::query();
        $notivicationType = $query->paginate(10)->withQueryString();
        return view('NotificationType.index');
    }

    public function create()
    {
        return view('NotificationType.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'template_text' => 'nullable|string',
            'is_active' => 'nullable|in:1,0',
        ]);
        
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        NotificationType::create($validated);
        return redirect()->route('notification-type.index')->with('success', 'Notification type berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $notificationType =  NotificationType::findOrFail($id);
        return view('NotificationType.edit', compact('notificationType'));
    }

    public function update(Request $request, $id)
    {
        $notificationType =  NotificationType::findOrFail($id);
        $notificationType->update($request->only(['type_name', 'code', 'template_text', 'is_active']));
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $notificationType =  NotificationType::findOrFail($id);
        $notificationType->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
