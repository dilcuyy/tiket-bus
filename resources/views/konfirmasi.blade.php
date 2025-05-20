<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pemesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .struk {
            font-family: 'Courier New', monospace;
            width: 350px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border: 1px dashed #ccc;
        }
        .line {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        .center {
            text-align: center;
        }
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body class="bg-gray-100 p-6">

    <div class="struk">
        <div class="center">
            <h2 class="text-xl font-bold">🚌 STRUK TIKET BUS 🚌</h2>
            <p class="text-sm">PT. Bus Nusantara</p>
            <p class="text-sm">Jl. Transportasi No.1</p>
        </div>

        <div class="line"></div>

        <p><strong>Nama      :</strong> {{ $booking->nama }}</p>
        <p><strong>Telepon   :</strong> {{ $booking->telepon }}</p>
        <p><strong>Email     :</strong> {{ $booking->email }}</p>
        <p><strong>Kursi     :</strong> {{ $booking->kursi }}</p>

        <div class="line"></div>

        <p><strong>Asal      :</strong> {{ $booking->rute->asal }}</p>
        <p><strong>Tujuan    :</strong> {{ $booking->rute->tujuan }}</p>
        <p><strong>Tanggal   :</strong> {{ $booking->rute->tanggal_berangkat }}</p>
        <p><strong>Waktu     :</strong> {{ $booking->rute->waktu_berangkat ?? '-' }}</p>
        <p><strong>Bus       :</strong> {{ $booking->rute->merk_bus }} - {{ $booking->rute->tipe_bus }}</p>
        <p><strong>Harga     :</strong> Rp{{ number_format($booking->rute->harga, 0, ',', '.') }}</p>

        <div class="line"></div>

        <div class="center text-sm">
            <p>Terima kasih telah memesan</p>
            <p>Semoga perjalanan Anda nyaman 🙏</p>
        </div>

        <div class="line"></div>

        <div class="center mt-4 no-print">
            <button onclick="window.print()" class="px-4 py-1 bg-black text-white text-sm rounded">🖨️ Cetak Struk</button>
            <a href="{{ url('/') }}" class="ml-2 px-4 py-1 bg-green-600 text-white text-sm rounded">🏠 Kembali</a>
        </div>
    </div>

</body>
</html>
