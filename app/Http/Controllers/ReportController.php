<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('view_reports', [
            'totalUsers' => User::count(),
            'totalEvents' => Event::count(),
            'approvedEvents' => Event::where('approved', true)->count(),
            'pendingEvents' => Event::where('approved', false)->count(),
            // change 'tickets' if your table is different
        ]);
    }
}
