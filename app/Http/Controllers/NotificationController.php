<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = User::find(Auth::id())->notifications()->latest()->paginate(10);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|string',
            'link' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        Notification::create($validated);

        return redirect()->route('notifications.index')->with('success', 'Notification created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        $this->authorize('view', $notification);

        return view('notifications.show', compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        $this->authorize('update', $notification);

        return view('notifications.edit', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {
        $this->authorize('update', $notification);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|string',
            'link' => 'nullable|string',
        ]);

        $notification->update($validated);

        return redirect()->route('notifications.index')->with('success', 'Notification updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        // Hapus notifikasi dari database
        $notification->delete();

        // Hapus cache yang terkait dengan notifikasi pengguna
        cache()->forget('notifications_' . $notification->user_id);

        return redirect()->back()->with('success', 'Notification deleted successfully.');
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead(Notification $notification)
    {
        // $this->authorize('update', $notification);

        $notification->update(['is_read' => true, 'read_at' => now()]);

        if (!empty($notification->link)) {
            return redirect($notification->link)->with('success', 'Notification marked as read.');;
        }

        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    // public function markAsRead($id)
    // {
    //     $notification = Notification::findOrFail($id);
    //     $notification->update(['is_read' => true, 'read_at' => now()]);

    //     if (!empty($notification->link)) {
    //         return redirect($notification->link);
    //     }

    //     return redirect()->back();
    // }
}
