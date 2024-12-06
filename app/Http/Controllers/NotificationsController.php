<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{

    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(10); // Or use all() if no pagination

        return view('notifications.index', compact('notifications'));
    }
    public function show($notificationId)
    {
        // Get the authenticated user's notifications
        $notification = auth()->user()->notifications()->findOrFail($notificationId);

        // Mark the notification as read if necessary
        $notification->markAsRead();

        // Return the view or redirect to a page to show the notification details
        return view('notifications.purchase-appvl', compact('notification'));
    }

    public function getNotification($notificationId)
    {
        // Fetch the notification by ID
        $notification = auth()->user()->notifications()->findOrFail($notificationId);

        // Return the notification data in JSON format
        return response()->json([
            'item_name' => $notification->data['item_name'],
            'message' => $notification->data['message'],
        ]);
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return back(); // Redirect back to the previous page
    }
}
