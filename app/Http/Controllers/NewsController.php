<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::all();
        return view('news.index', compact('news'));
    }

    public function create(): View
    {
        $news = News::all();
        return view('news.create', compact('news'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
        ]);

        if ($image = $request->file('image')) {
            $path = 'assets/images/';
            if (file_exists($path . $validatedData['image'])) {
                unlink($path . $validatedData['image']);
            }
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($path, $imageName);
            $validatedData['image'] = "$imageName";
        }

        $news = News::create($validatedData);
        return redirect()->route('news.index', compact('news'))->with('success', 'News item created successfully.');
    }


    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
        ]);

        if (!$request->filled('title')) {
            $validatedData['title'] = $news->title;
        }

        if (!$request->filled('description')) {
            $validatedData['description'] = $news->description;
        }

        if ($image = $request->file('image')) {
            $path = 'assets/images/';
            if (file_exists($path . $validatedData['image'])) {
                unlink($path . $validatedData['image']);
            }
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($path, $imageName);
            $validatedData['image'] = "$imageName";
        }

        $news->update($validatedData);

        return redirect()->route('news.index')->with('success', 'News item updated successfully.');
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index')->with('success', 'News item deleted successfully.');
    }
}
