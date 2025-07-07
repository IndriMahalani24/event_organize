<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function index()
    {
        $registrations = DB::table('registration')
            ->join('user', 'registration.user_id', '=', 'user.id')
            ->join('event', 'registration.event_id', '=', 'event.id')
            ->select('registration.*', 'user.name as user_name', 'event.name as event_name')
            ->whereNotNull('payment_proof')
            ->where('registration.status', 'pending')
            ->get();

        return view('finance.index', compact('registrations'));
    }

    public function approve($id)
    {
        DB::table('registration')->where('id', $id)->update([
            'status' => 'paid',
        ]);

        return redirect()->back()->with('succes', 'Pembayaran disetujui.');
    }
}
