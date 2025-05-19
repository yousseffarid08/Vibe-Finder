<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Show all events for users (public page).
     */
    public function index(Request $request)
    {
        $events = Event::query()
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%$search%")
                      ->orWhere('location', 'like', "%$search%")
                      ->orWhere('desc', 'like', "%$search%");
            })
            ->get();

        return view('events', ['events' => $events]);
    }

    /**
     * Show the event creation form for organizers.
     */
    public function create()
    {
        return view('create_event');
    }

    /**
     * Store a newly created event in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label'    => 'required|string|max:50',
            'title'    => 'required|string|max:255',
            'desc'     => 'required|string|max:1000',
            'location' => 'required|string|max:100',
            'date'     => 'required|date',
            'time'     => 'required',
            'price'    => 'required|numeric|min:0',
            'seats'    => 'required|integer|min:1',
        ]);

        Event::create([
            'label'        => $request->label,
            'title'        => $request->title,
            'desc'         => $request->desc,
            'location'     => $request->location,
            'date'         => $request->date,
            'time'         => $request->time,
            'price'        => $request->price,
            'seats'        => $request->seats,
            'organizer_id' => Auth::id(),
        ]);

        return redirect()->route('organizer.my_events')->with('success', 'Event created successfully!');
    }

    /**
     * Show only the events created by the logged-in organizer.
     */
    public function myEvents()
    {
        $events = Event::where('organizer_id', Auth::id())->get();
        return view('my_events', ['events' => $events]);
    }

    /**
     * Show the edit form for a specific event.
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('edit_event', compact('event'));
    }

    /**
     * Update the given event in the database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'label'    => 'required|string|max:50',
            'title'    => 'required|string|max:255',
            'desc'     => 'required|string|max:1000',
            'location' => 'required|string|max:100',
            'date'     => 'required|date',
            'time'     => 'required',
            'price'    => 'required|numeric|min:0',
            'seats'    => 'required|integer|min:1',
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->only([
            'label', 'title', 'desc', 'location', 'date', 'time', 'price', 'seats'
        ]));

        return redirect()->route('organizer.my_events')->with('success', 'Event updated successfully!');
    }

    /**
     * Delete a specific event.
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('organizer.my_events')->with('success', 'Event deleted successfully!');
    }
}

