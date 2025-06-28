<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        $events = DB::table('event')->where('status', 'active')->orderBy('event_date')->get();
        return view('events.index', compact('events'));
    }

    public function show($id)
    {
        $event = DB::table('event')->find($id);
        if (!$event) abort(404, 'Event tidak ditemukan');
        return view('events.show', compact('event'));
    }
}
