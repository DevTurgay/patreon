<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $content = Cache::remember('contents', 1440, function () {
            return Content::isReleased()->with('user')->orderBy('id', 'desc')->take(10)->get();
        });

        $notifications = Notification::whereDoesntHave('read', function ($query) {
            $query->where('user_id', auth()->id());
        })->where('created_at', '>', auth()->user()->created_at)
            ->get();

        return view('home', compact('content', 'notifications'));
    }
}
