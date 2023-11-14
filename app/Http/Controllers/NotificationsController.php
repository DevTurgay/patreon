<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\NotificationRead;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function read(Request $request)
    {
        $insert = [];
        foreach ($request->post() as $notification) {
            $insert[] = ['notification_id' => $notification, 'user_id' => auth()->id()];
        }

        NotificationRead::insert($insert);

        return response()->json(['status' => 'success'], 200);
    }
}
