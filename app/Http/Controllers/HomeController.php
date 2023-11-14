<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $content = Content::isReleased()->with('user')->orderBy('id', 'desc')->take(10)->get();
        // dd($content);

        return view('home', compact('content'));
    }
}
