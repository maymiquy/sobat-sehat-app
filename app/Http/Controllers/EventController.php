<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::all();

        return view('events.index', compact('events'));
    }

    public function create(): View
    {
        $author = User::all();

        return view('events.create', compact('author'));
    }

    public function store(Request $request)
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

        return redirect()->route('events.index', compact('event'))->with('success', 'Activity schedule created successfully.');
    }


    public function edit(string $id)
    {
        $author = User::all();
        $event = Event::find($id);

        return view('events.edit', compact('author', 'event'));
    }

    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'event_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'event_date' => 'nullable|date',
            'event_time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string|max:255',
        ]);

        if (!$request->filled('event_name')) {
            $validatedData['event_name'] = $event->event_name;
        }

        if (!$request->filled('description')) {
            $validatedData['description'] = $event->description;
        }

        if ($poster = $request->file('poster')) {
            $path = 'assets/images/';
            if (file_exists($path . $event->poster)) {
                unlink($path . $event->poster);
            }
            $posterName = date('YmdHis') . "." . $poster->getClientOriginalExtension();
            $poster->move($path, $posterName);
            $validatedData['poster'] = $posterName;
        }

        if (!$request->filled('event_date')) {
            $validatedData['event_date'] = $event->event_date;
        }

        if (!$request->filled('event_time')) {
            $validatedData['event_time'] = $event->event_time;
        }

        if (!$request->filled('location')) {
            $validatedData['location'] = $event->location;
        }

        $event->update($validatedData);

        return redirect()->route('events.index')->with('success', 'Activity schedule updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Activity schedule deleted successfully.');
    }
}
