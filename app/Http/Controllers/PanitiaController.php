<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class UserController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $response = Http::get("http://localhost:3000/event/user/{$userId}");

        $events = $response->json();
        return view('panitia.event.index', compact('events'));
    }

    public function create()
    {
        return view('panitia.event.create');
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $data = $request->all();
        $data['users_iduser'] = $userId;

        $response = Http::post("http://localhost:3000/event", $data);

        if ($response->successful()) {
            return redirect()->route('panitia.event.index')->with('success', 'Event berhasil ditambahkan!');
        } else {
            return back()->withErrors('Gagal menambahkan event.');
        }
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