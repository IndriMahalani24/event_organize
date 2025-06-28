<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function index()
    {
        $eventPanitia = Http::get('http://localhost:3000/panitia/event')->json();
        $keuanganPanitia = Http::get('http://localhost:3000/panitia/keuangan')->json();
        // dd($eventPanitia);
        return view('admin.admin', compact('eventPanitia', 'keuanganPanitia'));
    }


    public function create()    
    {
        return view ('admin.create');
    }

    public function store(Request $request)
    {
        $response = Http::post('http://localhost:3000/panitia', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'divisi' => $request->divisi,
            'role_id' => $request->role_id
        ]);
        // dd($response->json());

        if ($response->successful()) {
            return redirect()->route('adminList')->with('success', 'Panitia berhasil ditambahkan!');
        } else {
            return back()->withErrors('Gagal menambahkan panitia');
        }
    }


    public function edit($id)
    {
        $response = Http::get("http://localhost:3000/panitia/{$id}");
        $panitia = $response->json();

        if (!$panitia) {
            abort(404, 'Panitia tidak ditemukan');
        }

        return view('admin.edit', compact('panitia'));
    }


    public function update(Request $request, $id)
    {
        $response = Http::put("http://localhost:3000/panitia/$id", [
            'name' => $request->name,
            'divisi' => $request->divisi,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            return redirect()->route('adminList')->with('success', 'Panitia berhasil diupdate!');
        } else {
            return back()->withErrors('Gagal update panitia');
        }
    }

    public function destroy($id)
    {
        $response = Http::delete("http://localhost:3000/panitia/$id");

        if ($response->successful()) {
            return redirect()->route('adminList')->with('success', 'Panitia berhasil dihapus');
        } else {
            return back()->withErrors('Gagal menghapus panitia');
        }
    }


}
