<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BusNusantara - Tiket Bus Online</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Flatpickr CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }

    @keyframes scroll {
      0% { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }

    .animate-scroll {
      animation: scroll 40s linear infinite;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

  <!-- Navbar -->
  <header class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
      <h1 class="text-2xl font-bold text-green-600 flex items-center space-x-2">
        <span>BusNusantara</span>
      </h1>
      <nav class="hidden md:flex space-x-6 font-medium">
        <a href="#" class="text-green-600 font-semibold">Beranda</a>
        <a href="{{ route('rute.index') }}" class="hover:text-green-600 transition">Rute</a>
        <a href="{{ route('kontak') }}" class="hover:text-green-600 transition">Kontak</a>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="bg-gradient-to-r from-green-500 to-blue-500 text-white py-20 px-6 text-center">
    <h2 class="text-4xl md:text-5xl font-bold mb-4 drop-shadow-lg">Pesan Tiket Bus Tanpa Ribet</h2>
    <p class="text-lg md:text-xl mb-6 opacity-90">Cari rute favoritmu dan pesan langsung di BusNusantara</p>
  </section>

  <!-- Search Form -->
  <section class="max-w-3xl mx-auto px-6 mt-[-60px]">
    <div class="bg-white rounded-2xl shadow-2xl p-8 space-y-6 border border-gray-100">
      <form action="{{ route('cari.tiket') }}" method="POST" class="space-y-5">
        @csrf
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">🛫 Kota Asal</label>
          <input type="text" name="asal" required placeholder="Masukkan kota asal"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 transition" />
        </div>
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">🛬 Kota Tujuan</label>
          <input type="text" name="tujuan" required placeholder="Masukkan kota tujuan"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 transition" />
        </div>
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">📅 Tanggal Berangkat</label>
          <input type="text" id="tanggal" name="tanggal" required placeholder="Pilih tanggal"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 transition" />
        </div>
        <div>
          <button type="submit"
            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold text-lg py-3 rounded-lg transition transform hover:scale-105 shadow-md">
            🔍 Cari Tiket Sekarang
          </button>
        </div>
      </form>
    </div>
  </section>
  
  <!-- Footer -->
  <footer class="mt-20 bg-white border-t text-center py-6 text-sm text-gray-500">
    &copy; 2025 <span class="font-semibold text-green-600">BusNusantara</span>. Semua Hak Dilindungi.
  </footer>

  <!-- Flatpickr -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    flatpickr("#tanggal", {
      dateFormat: "Y-m-d",
      minDate: "today",
      disableMobile: true
    });
  </script>
</body>
</html>
