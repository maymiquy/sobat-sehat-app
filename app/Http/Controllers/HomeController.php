<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function indexNews()
    {
        $news = News::all();
        return view('home', compact('news'));
    }

    public function showNews(News $news)
    {
        return view('detail', compact('news'));
    }
}
