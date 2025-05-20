<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hasil Pencarian Tiket</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gradient-to-b from-green-50 via-white to-blue-100 min-h-screen">

  <!-- Navbar -->
  <header class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
      <h1 class="text-2xl font-bold text-green-600 flex items-center space-x-2">
        <span>BusNusantara</span>
      </h1>
      <nav class="hidden md:flex space-x-6 font-medium">
        <a href="{{ route('beranda') }}" class="hover:text-green-600 transition">Beranda</a>
        <a href="{{ route('rute.index') }}" class="hover:text-green-600 transition">Rute</a>
        <a href="{{ route('kontak') }}" class="hover:text-green-600 transition">Kontak</a>
      </nav>
    </div>
  </header>

  <!-- Judul Halaman -->
  <section class="bg-gradient-to-r from-green-500 to-blue-500 text-white text-center py-14 shadow-inner">
    <h1 class="text-4xl font-bold">Hasil Pencarian Tiket</h1>
    <p class="text-lg mt-2">Tiket yang sesuai dengan pencarian Anda</p>
  </section>

  <!-- Konten Hasil -->
  <main class="max-w-4xl mx-auto my-10 p-6 bg-white rounded-xl shadow-xl">
    @if($rute->isEmpty())
      <p class="text-center text-lg text-gray-600">Tidak ada rute ditemukan.</p>
    @else
      <div class="space-y-6">
        @foreach($rute as $item)
        <div class="p-6 bg-gradient-to-r from-green-100 to-blue-100 rounded-xl shadow-md">
          <strong class="text-2xl text-gray-800">{{ $item->asal }} → {{ $item->tujuan }}</strong>
          <p class="text-lg text-gray-700 mt-1">Tanggal: {{ $item->tanggal_berangkat }}</p>
          <p class="text-lg text-gray-700">Bus: {{ $item->merk_bus }} - {{ $item->tipe_bus }}</p>
          <p class="text-xl font-bold text-green-600 mt-2">Harga: Rp{{ number_format($item->harga, 0, ',', '.') }}</p>

          <a href="{{ route('booking.form', $item->id) }}"
            class="inline-block mt-4 px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300">
            Pesan Tiket
          </a>
        </div>
        @endforeach
      </div>
    @endif
  </main>

  <!-- Footer -->
  <footer class="mt-20 bg-white border-t text-center py-6 text-sm text-gray-500">
    &copy; 2025 <span class="font-semibold text-green-600">BusNusantara</span>. Semua Hak Dilindungi.
  </footer>

</body>
</html>
