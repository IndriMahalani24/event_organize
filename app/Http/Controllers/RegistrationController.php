<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function order($eventId)
    {
        $event = DB::table('event')->find($eventId);
        if (!$event) abort(404, 'Event tidak ditemukan');
        return view('registrations.order', compact('event'));
    }

    public function store(Request $request, $eventId)
    {
        $userId = auth()->id();
        $already = DB::table('registrations')->where('user_id', $userId)->where('event_id', $eventId)->first();
        if ($already) return redirect()->route('events.index')->with('error', 'Kamu sudah mendaftar.');

        $qr = 'QR-' . strtoupper(Str::random(8));
        $id = DB::table('registrations')->insertGetId([
            'user_id' => $userId,
            'event_id' => $eventId,
            'status' => 'pending',
            'qr_code' => $qr,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('registrations.qr', $id)->with('success', 'Pendaftaran berhasil!');
    }

    public function showUploadForm($id)
    {
    $registration = DB::table('registrations')
        ->where('id', $id)
        ->where('user_id', auth()->id())
        ->first();

    if (!$registration) abort(404);

    return view('registrations.upload', compact('registration'));
    }

    public function uploadProof(Request $request, $id)
    {
    $request->validate([
        'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $file = $request->file('payment_proof');
    $path = $file->store('payment_proofs', 'public');

    DB::table('registrations')
        ->where('id', $id)
        ->where('user_id', auth()->id())
        ->update(['payment_proof' => $path]);

    return redirect()->route('registrations.qr', $id)->with('success', 'Bukti pembayaran berhasil diunggah.');
    }
}

