<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'text' => 'required|max:2000',
            'price' => 'nullable|numeric',
            'release_date' => 'nullable|date_format:Y-m-d\TH:i',
            'user_timezone' => 'required'
        ]);
        $validatedData['user_id'] = auth()->id();
        if (empty($validatedData['release_date'])) {
            $validatedData['release_date'] = Carbon::now();
            $validatedData['is_released'] = 1;
            Cache::forget('contents');
        } else {
            $userDateTime = Carbon::parse($validatedData['release_date'], $validatedData['user_timezone']);
            $validatedData['release_date'] = $userDateTime->tz(config('app.timezone'));
        }

        Content::create($validatedData);
        return redirect()->route('home');
    }

    public function show(Content $content)
    {
        return view('single', compact('content'));
    }
}
