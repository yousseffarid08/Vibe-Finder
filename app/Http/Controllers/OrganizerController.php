<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrganizerController extends Controller
{
    /**
     * Show the edit form for the organizer.
     */
    public function edit()
    {
        return view('edit_organizer');
    }

    /**
     * Update the organizer's profile information.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'age'   => 'nullable|integer|min:1|max:150',
            'bio'   => 'nullable|string|max:1000',
        ]);

        $user->name  = $request->name;
        $user->phone = $request->phone;
        $user->age   = $request->age;
        $user->bio   = $request->bio;

        $user->save();

        return redirect('/organizer')->with('success', 'Profile updated successfully.');
    }
}

