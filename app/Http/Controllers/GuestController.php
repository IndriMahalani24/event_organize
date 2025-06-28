<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
     public function landing()
    {
        // Ambil daftar event dari database
        $events = DB::table('event')->where('status', 'active')->orderBy('event_date')->get();
        return view('guest.landing', compact('events'));
    }
}
