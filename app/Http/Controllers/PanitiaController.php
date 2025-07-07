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

        // dd($events);

        return view('event.index', compact('events'));
    }

    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request)
    {
        $response = Http::attach(
            'poster',
            file_get_contents($request->file('poster')),
            $request->file('poster')->getClientOriginalName()
        )->post('http://localhost:3000/event/user', [
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'registration_fee' => $request->registration_fee,
            'max_participants' => $request->max_participants,
            'speaker' => $request->speaker,
            'status' => $request->status,
            'users_iduser' => auth()->user()->id, 
        ]);
        dd($response->body());

        return redirect()->route('landing')->with('success', 'Event berhasil dibuat');
    }


    public function edit($id)
    {
        $response = Http::get("http://localhost:3000/event/{$id}");
        $event = $response->json();
        // dd($response->body());
        if (!$event) {
            abort(404, 'Event tidak ditemukan');
        }

        return view('event.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $http = Http::asMultipart();
        $response = Http::get("http://localhost:3000/event/{$id}");
        $event = $response->json();
        // dd($response->json());
        if ($request->hasFile('poster')) {
            $http = $http->attach(
                'poster',
                file_get_contents($request->file('poster')),
                $request->file('poster')->getClientOriginalName()
            );
        }

        $formattedDate = date('Y-m-d', strtotime($request->event_date));
        $formattedTime = date('H:i:s', strtotime($request->event_time));

        $response = $http->put("http://localhost:3000/event/user/{$id}", [
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'event_date' => $formattedDate,
            'event_time' => $formattedTime,
            'registration_fee' => $request->registration_fee,
            'max_participants' => $request->max_participants,
            'speaker' => $request->speaker,
            'status' => $request->status,
            'users_iduser' => auth()->user()->id,
        ]);

        // dd($response->body());

        return redirect()->route('panitia.event.index')->with('success', 'Event berhasil dibuat');
    }

    public function destroy($id)
    {
        $response = Http::delete("http://localhost:3000/event/{$id}");

        if ($response->successful()) {
            return redirect()->route('landing')->with('success', 'Event berhasil dihapus');
        }

        return redirect()->route('landing')->with('error', 'Gagal menghapus event');
    }




}