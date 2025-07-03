<?php

namespace App\Http\Controllers;
use App\Models\panitia;
use App\Models\event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PanitiaController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $response = Http::get("http://localhost:3000/event/user/{$userId}");

        $events = $response->json();
        return view('event.index');
    }

    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request)
{
    // $request->validate([
    // ]);

    $posterName = null;
    if ($request->hasFile('poster')) {
        $posterFile = $request->file('poster');
        $posterName = Str::uuid() . '.' . $posterFile->getClientOriginalExtension();
        $posterFile->move(public_path('posters'), $posterName);
        // dd('Uploaded poster to: ' . public_path('posters/' . $posterName));

    }

    event::create([
        'name' => $request->name,
        'description' => $request->description,
        'event_date' => $request->event_date,
        'event_time' => $request->event_time,
        'location' => $request->location,
        'speaker' => $request->speaker,
        'poster' => $posterName,
        'registration_fee' => $request->registration_fee,
        'max_participants' => $request->max_participants,
        'status' => $request->status,
        'users_iduser' => auth()->user()->id
    ]);

    return redirect()->route('landing')->with('success', 'Event berhasil dibuat');
}


    public function edit($id)
    {
        $response = Http::get("http://localhost:3000/event/user/" . Auth::id());
        $event = collect($response->json())->firstWhere('id', $id);

        if (!$event) {
            abort(404, 'Event tidak ditemukan');
        }

        return view('panitia.event.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method']);

        $response = Http::put("http://localhost:3000/event/{$id}", $data);

        if ($response->successful()) {
            return redirect()->route('panitia.event.index')->with('success', 'Event berhasil diupdate!');
        } else {
            return back()->withErrors('Gagal mengupdate event.');
        }
    }


}