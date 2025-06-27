<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
{
    $response = Http::get('http://localhost:3000/panitia');
    
    if ($response->successful()) {
        $panitia = $response->json();
        return view('admin.index', compact('panitia'));
    } else {
        return back()->withErrors('Gagal mengambil data panitia');
    }
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
            'divisi' => $request->divisi
        ]);

        if ($response->successful()) {
            return redirect()->route('adminList')->with('success', 'Panitia berhasil ditambahkan!');
        } else {
            return back()->withErrors('Gagal menambahkan panitia');
        }
    }


    public function update(Request $request, $id)
    {
        $response = Http::put("http://localhost:3000/panitia/$id", [
            'name' => $request->name,
            'email' => $request->email,
            'divisi' => $request->divisi
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
