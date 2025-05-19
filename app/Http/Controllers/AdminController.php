<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;

class AdminController extends Controller
{
    /**
     * Display a list of all non-admin users.
     */
    public function listUsers()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('manage_users', compact('users'));
    }

    /**
     * Approve a user account.
     */
    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->approved = true;
        $user->save();

        return back()->with('success', 'User approved.');
    }

    /**
     * Reject and delete a user.
     */
    public function rejectUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User rejected and deleted.');
    }

    /**
     * Display events that are pending approval.
     */
    public function reviewEvents()
    {
        $events = Event::where('approved', false)->get();

        // ✅ Fix: use correct view path
        return view('review_events', compact('events'));
    }

    /**
     * Approve an event.
     */
    public function approveEvent($id)
    {
        $event = Event::findOrFail($id);
        $event->approved = true;
        $event->save();

        return redirect()->route('review.events')->with('success', 'Event approved successfully.');
    }

    /**
     * Reject and delete an event.
     */
    public function rejectEvent($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('review.events')->with('success', 'Event rejected and deleted.');
    }
}
