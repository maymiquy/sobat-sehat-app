<?php

namespace App\Http\Controllers;

use App\Models\Member;
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

        $events = Event::withCount('members')
            ->skip($start)
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

    public function storeMember(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
        ]);

        $member = new Member($validatedData);

        $member->event_id = $request->event_id;
        $member->save();

        return redirect()->route('kegiatan')->with('success', 'Anda berhasil join kegiatan ini');
    }

    public function searchEvent(Request $request)
    {
        $itemsPerPage = 5;
        $page = max(1, $request->input('page', 1));
        $query = $request->input('search', '');

        $eventsQuery = Event::query()
            ->where('event_name', 'like', "%" . $query . "%")
            ->orWhere('location', 'like', "%" . $query . "%")
            ->orWhere('description', 'like', "%" . $query . "%");

        $events = $eventsQuery->withCount('members')
            ->forPage($page, $itemsPerPage)
            ->get();

        $total = $eventsQuery->count();
        $totalPages = ceil($total / $itemsPerPage);

        return view('activity', compact('events', 'totalPages', 'page'));
    }
}
