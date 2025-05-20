<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;

class KontakController extends Controller
{
    public function form()
    {
        return view('kontak');
    }

    public function kirim(Request $request)
    {
        // Validasi input dari user
        $request->validate([
            'nama'  => 'required',
            'email' => 'required|email',
            'pesan' => 'required',
        ]);

        // Simpan ke database
        Kontak::create($request->all());

        // Kembali ke halaman sebelumnya dengan flash message
        return redirect()->back()->with('success', 'Pesan kamu telah dikirim!');
    }
}
