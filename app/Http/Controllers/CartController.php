<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Event;

class CartController extends Controller
{
    /**
     * Add an event to the user's cart.
     *
     * @param Request $request
     * @param int $eventId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request, $eventId)
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');

        $event = Event::findOrFail($eventId);

        // Prevent adding duplicates
        $exists = Cart::where('user_id', $user->id)
                      ->where('event_id', $eventId)
                      ->first();

        if (!$exists) {
            Cart::create([
                'user_id' => $user->id,
                'event_id' => $event->id,
            ]);
        }

        return redirect()->route('cart.view')->with('success', 'Event added to cart!');
    }

    /**
     * Display the current user's cart.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function view()
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');

        $cartItems = Cart::with('event')
                         ->where('user_id', $user->id)
                         ->get();

        return view('cart', compact('cartItems'));
    }

    /**
     * Remove an event from the cart.
     *
     * @param int $eventId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($eventId)
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');

        Cart::where('user_id', $user->id)
            ->where('event_id', $eventId)
            ->delete();

        return redirect()->route('cart.view')->with('success', 'Event removed from cart!');
    }

    /**
     * Complete the payment and clear the cart.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function completePayment()
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');

        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('events')->with('success', 'Payment complete!');
    }
}
