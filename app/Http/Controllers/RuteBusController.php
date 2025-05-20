<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RuteBus;
use App\Models\Booking;

class RuteBusController extends Controller
{
    // Halaman beranda / form pencarian
    public function index()
    {
        return view('cari');
    }

    // Proses submit pencarian, redirect ke hasil
    public function cari(Request $request)
    {
        return redirect()->route('hasil.pencarian', [
            'asal'    => $request->asal,
            'tujuan'  => $request->tujuan,
            'tanggal' => $request->tanggal,
        ]);
    }

    // Halaman hasil pencarian berdasarkan asal, tujuan, dan tanggal
    public function hasil(Request $request)
    {
        $rute = RuteBus::where('asal', $request->asal)
            ->where('tujuan', $request->tujuan)
            ->where('tanggal_berangkat', $request->tanggal)
            ->get();

        $kursiTerpakai = Booking::whereIn('rute_bus_id', $rute->pluck('id'))
            ->pluck('kursi')
            ->toArray();

        return view('hasil', compact('rute', 'kursiTerpakai'));
    }

    // Halaman admin dashboard dengan fitur search
    public function admin(Request $request)
    {
        $query = RuteBus::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('asal', 'like', "%$search%")
                  ->orWhere('tujuan', 'like', "%$search%")
                  ->orWhere('merk_bus', 'like', "%$search%")
                  ->orWhere('tanggal_berangkat', 'like', "%$search%");
            });
        }

        $rutes = $query->latest()->get();

        return view('admin.dashboard', compact('rutes'));
    }

    // Semua rute publik tanpa pagination (bisa dipakai untuk filter manual)
    public function semuaRute(Request $request)
    {
        $query = RuteBus::query();

        if ($request->filled('asal')) {
            $query->where('asal', 'like', '%' . $request->asal . '%');
        }

        if ($request->filled('tujuan')) {
            $query->where('tujuan', 'like', '%' . $request->tujuan . '%');
        }

        if ($request->filled('bus')) {
            $query->where(function ($q) use ($request) {
                $q->where('merk_bus', 'like', '%' . $request->bus . '%')
                  ->orWhere('tipe_bus', 'like', '%' . $request->bus . '%');
            });
        }

        if ($request->filled('min')) {
            $query->where('harga', '>=', $request->min);
        }

        if ($request->filled('max')) {
            $query->where('harga', '<=', $request->max);
        }

        $rute = $query->orderBy('tanggal_berangkat')->get();

        return view('rute.index', compact('rute'));
    }

    // Ini yang lo pakai buat live filter & paginasi AJAX
    public function listRute(Request $request)
    {
        $query = RuteBus::query();

        if ($request->filled('asal')) {
            $query->where('asal', 'like', "%{$request->asal}%");
        }

        if ($request->filled('tujuan')) {
            $query->where('tujuan', 'like', "%{$request->tujuan}%");
        }

        if ($request->filled('merk_bus')) {
            $query->where('merk_bus', 'like', "%{$request->merk_bus}%");
        }

        if ($request->filled('tipe_bus')) {
            $query->where('tipe_bus', 'like', "%{$request->tipe_bus}%");
        }

        if ($request->filled('min_harga')) {
            $query->where('harga', '>=', $request->min_harga);
        }

        if ($request->filled('max_harga')) {
            $query->where('harga', '<=', $request->max_harga);
        }

        $rute = $query->orderBy('tanggal_berangkat')->paginate(9);

        // Biar query param tetap ke pagination link (kalau perlu)
        $rute->appends($request->all());

        if ($request->ajax()) {
            // Kalau AJAX, return partial view untuk update live
            return view('partials.rute-list', compact('rute'))->render();
        }

        return view('rute.index', compact('rute'));
    }

    // CRUD admin

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'asal'              => 'required',
            'tujuan'            => 'required',
            'tanggal_berangkat' => 'required|date',
            'merk_bus'          => 'required',
            'tipe_bus'          => 'required',
            'harga'             => 'required|numeric',
        ]);

        RuteBus::create($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Rute ditambahkan!');
    }

    public function edit($id)
    {
        $rute = RuteBus::findOrFail($id);

        return view('admin.edit', compact('rute'));
    }

    public function update(Request $request, $id)
    {
        $rute = RuteBus::findOrFail($id);

        $request->validate([
            'asal'              => 'required',
            'tujuan'            => 'required',
            'tanggal_berangkat' => 'required|date',
            'merk_bus'          => 'required',
            'tipe_bus'          => 'required',
            'harga'             => 'required|numeric',
        ]);

        $rute->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Rute diupdate!');
    }

    public function destroy($id)
    {
        $rute = RuteBus::findOrFail($id);
        $rute->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Rute dihapus!');
    }
}
