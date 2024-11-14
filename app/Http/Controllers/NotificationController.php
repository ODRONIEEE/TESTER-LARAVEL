<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Method to fetch unread notifications and count
    public function fetchNotifications()
    {
        $notifications = auth()->user()->unreadNotifications;

        return response()->json([
            'count' => $notifications->count(),
            'notifications' => $notifications,
        ]);
    }

    // Method to mark a specific notification as read
    public function markAsRead(Request $request)
    {
        $notification = auth()->user()->unreadNotifications->find($request->id);

        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json(['success' => true]);
    }
}
