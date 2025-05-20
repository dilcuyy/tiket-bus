<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\RuteBus;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Spatie\Browsershot\Browsershot;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'rute_bus_id' => 'required|exists:rute_buses,id',
                'nama' => 'required|string',
                'telepon' => 'required|string|regex:/^[0-9]+$/',
                'email' => 'required|email',
                'kursi' => [
                    'required',
                    'string',
                    Rule::unique('bookings')->where(function ($query) use ($request) {
                        return $query->where('rute_bus_id', $request->rute_bus_id);
                    }),
                ],
            ]);
        } catch (ValidationException $e) {
            Log::error('Validasi gagal saat booking:', $e->errors());

            if ($request->expectsJson() || $request->isJson() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors(),
                ], 422);
            }

            return back()->withErrors($e->errors())->withInput();
        }

        // Simpan booking
        $booking = Booking::create([
            'rute_bus_id' => $request->rute_bus_id,
            'nama'        => $request->nama,
            'telepon'     => $request->telepon,
            'email'       => $request->email,
            'kursi'       => $request->kursi,
        ]);

        Log::info('Booking berhasil dibuat:', $booking->toArray());

        // Kalau request pakai JSON (AJAX)
        if ($request->expectsJson() || $request->isJson() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'booking' => $booking,
                'rute' => $booking->rute,
            ]);
        }

        // Redirect biasa ke halaman konfirmasi
        return redirect()->route('konfirmasi', ['id' => $booking->id]);
    }

    public function konfirmasi($id)
    {
        $booking = Booking::findOrFail($id);
        $rute = $booking->rute;

        return view('konfirmasi', compact('booking', 'rute'));
    }

    public function showBookingForm($ruteId)
    {
        $rute = RuteBus::findOrFail($ruteId);
        $kursiTerpakai = Booking::where('rute_bus_id', $ruteId)->pluck('kursi')->toArray();

        return view('booking-form', compact('rute', 'kursiTerpakai'));
    }

    public function riwayat()
    {
        $bookings = Booking::with('rute')->latest()->get();
        return view('riwayat', compact('bookings'));
    }

    public function adminIndex()
    {
        $bookings = Booking::with('rute')->latest()->get();
        return view('admin.bookings', compact('bookings'));
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings')->with('success', 'Pemesanan berhasil dihapus.');
    }


    public function generatePdf($id)
    {
        $booking = Booking::findOrFail($id);
        $rute = RuteBus::findOrFail($booking->rute_bus_id); // fix nama model

        $pdf = Pdf::loadView('pdf.struk', compact('booking', 'rute'));
        return $pdf->download("struk-booking.pdf");
    }

}
