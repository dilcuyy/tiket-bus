<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemesanan Tiket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Header -->
    <header class="bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 text-white text-center py-12">
        <h1 class="text-4xl font-bold">Riwayat Pemesanan Tiket</h1>
        <p class="mt-2 text-xl">Lihat semua pemesanan yang telah Anda lakukan</p>
    </header>

    <div class="max-w-6xl mx-auto my-10 p-6 bg-white rounded-lg shadow-lg shadow-gray-300">
        <!-- Kondisi jika tidak ada riwayat pemesanan -->
        @if($bookings->isEmpty())
            <p class="text-center text-lg text-gray-600">Belum ada pemesanan.</p>
        @else
            <!-- Tabel Riwayat -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-6 py-3 text-left text-gray-700">Nama</th>
                            <th class="px-6 py-3 text-left text-gray-700">Rute</th>
                            <th class="px-6 py-3 text-left text-gray-700">Kursi</th>
                            <th class="px-6 py-3 text-left text-gray-700">Tanggal</th>
                            <th class="px-6 py-3 text-left text-gray-700">Bus</th>
                            <th class="px-6 py-3 text-left text-gray-700">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4 text-gray-800">{{ $booking->nama }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $booking->rute->asal }} → {{ $booking->rute->tujuan }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $booking->kursi }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $booking->rute->tanggal_berangkat }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $booking->rute->merk_bus }} - {{ $booking->rute->tipe_bus }}</td>
                                <td class="px-6 py-4 text-gray-800">Rp{{ number_format($booking->rute->harga, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Kembali ke Beranda -->
        <div class="mt-6 text-center">
            <a href="{{ url('/') }}" class="inline-block px-6 py-2 text-white bg-green-500 rounded-lg text-lg hover:bg-green-600 transition-all duration-300 transform hover:scale-105">🔙 Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>
