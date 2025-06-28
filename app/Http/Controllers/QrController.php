<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QrController extends Controller
{
    public function show($id)
    {
        $registration = DB::table('registrations')->where('id', $id)->first();

        if (!$registration) {
            abort(404);
        }

        return view('registrations.qr', compact('registration'));
    }
}
