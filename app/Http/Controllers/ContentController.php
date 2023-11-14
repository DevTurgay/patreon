<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::all();
        return view('contents.index', compact('contents'));
    }

    public function create()
    {
        return view('contents.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'text' => 'required|max:2000',
            'price' => 'nullable|numeric',
            'release_date' => 'nullable|date_format:Y-m-d\TH:i'
        ]);
        $validatedData['user_id'] = auth()->id();
        if (empty($validatedData['release_date'])) {
            $validatedData['release_date'] = Carbon::now();
            $validatedData['is_released'] = 1;
        }

        Content::create($validatedData);
        return redirect()->route('home');
    }

    public function show(Content $content)
    {
        return view('contents.show', compact('content'));
    }

    public function edit(Content $content)
    {
        return view('contents.edit', compact('content'));
    }

    public function update(Request $request, Content $content)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|max:100',
            'text' => 'required|max:2000',
            'price' => 'nullable|numeric',
            'release_date' => 'nullable|date',
            'is_released' => 'sometimes|boolean'
        ]);

        $content->update($validatedData);
        return redirect()->route('contents.index');
    }

    public function destroy(Content $content)
    {
        $content->delete();
        return redirect()->route('contents.index');
    }
}
