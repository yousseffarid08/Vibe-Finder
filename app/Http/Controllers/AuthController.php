<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Handle login form submission.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)
                    ->where('name', $request->username)
                    ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            if ($user->email === 'youssef.farid@gmail.com') {
                return redirect('/admin');
            } elseif ($user->role === 'organizer') {
                return redirect('/organizer');
            } else {
                return redirect('/user');
            }
        }

        return back()->withErrors([
            'login' => 'Invalid username, email or password.',
        ])->withInput();
    }

    /**
     * Handle signup form submission.
     */
    public function signup(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone'    => 'nullable|string|max:20',
            'role'     => 'required|in:user,organizer', // ✅ Validate role explicitly
        ]);

        $user = new User();
        $user->name     = $request->username;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone    = $request->phone;
        $user->role     = $request->role;
        $user->save();

        Auth::login($user);

        // 🔁 Redirect based on selected role
        return $request->role === 'organizer'
            ? redirect('/organizer')
            : redirect('/user');
    }

    /**
     * Handle profile update (excluding username & email).
     */
    public function updateUser(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'phone'         => 'nullable|string|max:20',
            'age'           => 'nullable|integer|min:1|max:150',
            'preferences'   => 'nullable|array',
            'preferences.*' => 'string|max:255',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user->phone = $request->phone;
        $user->age   = $request->age;

        $user->preferences = is_array($request->preferences)
            ? implode(',', $request->preferences)
            : null;

        if ($request->hasFile('profile_image')) {
            $image    = $request->file('profile_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path     = $image->storeAs('profile_images', $filename, 'public');
            $user->profile_image = $path;
        }

        $user->save();

        return redirect('/user')->with('success', 'Profile updated successfully.');
    }
}
