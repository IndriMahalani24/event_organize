<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function index()
    {
        $registrations = DB::table('registrations')
            ->join('users', 'registrations.user_id', '=', 'users.id')
            ->join('event', 'registrations.event_id', '=', 'event.id')
            ->select('registrations.*', 'users.name as user_name', 'event.name as event_name')
            ->whereNotNull('payment_proof')
            ->where('registrations.status', 'pending')
            ->get();

        return view('finance.index', compact('registrations'));
    }

    public function approve($id)
    {
        DB::table('registrations')->where('id', $id)->update([
            'status' => 'paid',
        ]);

        return redirect()->back()->with('succes', 'Pembayaran disetujui.');
    }
}
