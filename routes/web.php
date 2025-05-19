<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReportController;

// ✅ Landing Page
Route::get('/', fn () => view('landing'))->name('home');

// ✅ Authentication Routes
Route::get('/login', fn () => view('login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/signup', fn () => view('signup'))->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

// ✅ Protected Routes (Only for logged-in users)
Route::middleware('auth')->group(function () {

    // ✅ User Dashboard
    Route::get('/user', fn () => view('user'))->name('user.dashboard');
    Route::get('/user/edit', fn () => view('edit_user'))->name('user.edit');
    Route::post('/user/update', [AuthController::class, 'updateUser'])->name('user.update');

    // ✅ Logout
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');

    // ✅ Organizer Dashboard
    Route::get('/organizer', fn () => view('organizer'))->name('organizer.dashboard');

    // ✅ Organizer Event Management
    Route::get('/organizer/my-events', [EventController::class, 'myEvents'])->name('organizer.my_events');
    Route::get('/organizer/create-event', [EventController::class, 'create'])->name('organizer.create_event');
    Route::post('/organizer/create-event', [EventController::class, 'store'])->name('organizer.store_event');

    // ✅ Edit / Delete Events
    Route::get('/organizer/events/{id}/edit', [EventController::class, 'edit'])->name('organizer.edit_event');
    Route::put('/organizer/events/{id}', [EventController::class, 'update'])->name('organizer.update_event');
    Route::delete('/organizer/events/{id}', [EventController::class, 'destroy'])->name('organizer.delete_event');

    // ✅ Organizer Profile Edit
    Route::get('/organizer/edit', [OrganizerController::class, 'edit'])->name('organizer.edit');
    Route::post('/organizer/update', [OrganizerController::class, 'update'])->name('organizer.update');

    // ✅ Cart
    Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
    Route::post('/cart/add/{eventId}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{eventId}', [CartController::class, 'remove'])->name('cart.remove');

    // ✅ Admin Dashboard Access (only for specific email)
    Route::get('/admin', function () {
        $user = auth()->user();
        if ($user->email !== 'youssef.farid@gmail.com') {
            abort(403, 'Unauthorized');
        }
        return view('admin');
    })->name('admin.dashboard');

    // ✅ Admin Manage Users
    Route::get('/admin/users', [AdminController::class, 'listUsers'])->name('admin.users');
    Route::post('/admin/users/{id}/approve', [AdminController::class, 'approveUser'])->name('admin.users.approve');
    Route::post('/admin/users/{id}/reject', [AdminController::class, 'rejectUser'])->name('admin.users.reject');

    // ✅ Admin Review Events
    Route::get('/review-events', [AdminController::class, 'reviewEvents'])->name('review.events');
    Route::post('/events/{id}/approve', [AdminController::class, 'approveEvent'])->name('events.approve');
    Route::post('/events/{id}/reject', [AdminController::class, 'rejectEvent'])->name('events.reject');

    // ✅ Admin Reports (Correct: dynamic via controller)
    Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports');
});

// ✅ Public Events Page
Route::get('/events', [EventController::class, 'index'])->name('events');



// ✅ Payment
Route::get('/payment', fn () => view('payment'))->name('payment.page');
Route::post('/payment/complete', [CartController::class, 'completePayment'])->name('payment.complete');




