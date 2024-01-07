<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function indexNews(Request $request)
    {
        $slideItems = News::whereIn('id', [1, 2, 4])->get();

        $itemsPage = 6;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $start = ($page - 1) * $itemsPage;
        $news = News::skip($start)
            ->take($itemsPage)
            ->get();
        $total = News::count();
        $totalPages = ceil($total / $itemsPage);

        return view('home', compact('news', 'slideItems', 'page', 'totalPages'));
    }

    public function indexEvent(Request $request)
    {
        $itemsPage = 5;
        $page = $request->input('page', 1);
        $start = ($page - 1) * $itemsPage;

        $events = Event::skip($start)
            ->take($itemsPage)
            ->get();

        $total = Event::count();
        $totalPages = ceil($total / $itemsPage);

        return view('activity', compact('events', 'totalPages', 'page'));
    }

    public function storeEvent(Request $request)
    {
        $validatedData = $request->validate([
            'event_name' => 'required',
            'description' => 'nullable|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'event_date' => 'required|date',
            'event_time' => 'required|date_format:H:i',
            'location' => 'required',
        ]);

        if ($poster = $request->file('poster')) {
            $path = 'assets/images/';
            if (file_exists($path . $validatedData['poster'])) {
                unlink($path . $validatedData['poster']);
            }
            $posterName = date('YmdHis') . "." . $poster->getClientOriginalExtension();
            $poster->move($path, $posterName);
            $validatedData['poster'] = "$posterName";
        }

        $event = new Event($validatedData);

        $loggedInUser = Auth::user();
        $event->author = $loggedInUser->id;
        $event->save();

        return redirect()->route('kegiatan')->with('success', 'Activity schedule created successfully.');
    }

    public function searchEvent(Request $request)
    {
        $itemsPage = 5;
        $page = $request->input('page', 1);
        $start = ($page - 1) * $itemsPage;

        $query = $request->input('search');
        $events = Event::query()
            ->where('event_name', 'like', "%" . $query . "%")
            ->orWhere('location', 'like', "%" . $query . "%")
            ->orWhere('description', 'like', "%" . $query . "%")
            ->skip($start)
            ->take($itemsPage)
            ->get();

        $total = Event::query()
            ->where('event_name', 'like', "%" . $query . "%")
            ->orWhere('location', 'like', "%" . $query . "%")
            ->orWhere('description', 'like', "%" . $query . "%")
            ->count();

        $totalPages = ceil($total / $itemsPage);

        return view('activity', compact('events', 'totalPages', 'page'));
    }
}
