<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kontak - BusNusantara</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

  <!-- Navbar -->
  <header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
      <h1 class="text-2xl font-bold text-green-600 flex items-center space-x-2">
        <span>BusNusantara</span>
      </h1>
      <nav class="hidden md:flex space-x-6 font-medium">
        <a href="{{ route('beranda') }}" class="hover:text-green-600 transition">Beranda</a>
        <a href="{{ route('rute.index') }}" class="hover:text-green-600 transition">Rute</a>
        <a href="{{ route('kontak') }}" class="text-green-600 font-semibold">Kontak</a>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="bg-gradient-to-r from-green-500 to-blue-500 text-white py-16 px-6 text-center">
    <h2 class="text-4xl md:text-5xl font-bold mb-2">📬 Hubungi Kami</h2>
    <p class="text-lg md:text-xl">Kami siap membantu! Kirim pertanyaan atau masukan Anda di bawah ini</p>
  </section>

  <!-- Kontak Form -->
  <section class="max-w-4xl mx-auto px-4 mt-[-48px]">
    <div class="bg-white border border-gray-200 rounded-2xl shadow-md p-8 md:p-10 -mt-12 relative z-10">
      @if(session('success'))
        <div class="mb-6 bg-green-100 text-green-800 px-4 py-3 rounded-lg text-sm font-medium">
          {{ session('success') }}
        </div>
      @endif

      <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Formulir Kontak</h3>

      <form action="{{ route('kontak.kirim') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Nama -->
        <div>
          <label class="block text-sm font-medium mb-1 text-gray-700">👤 Nama Lengkap</label>
          <input type="text" name="nama" required placeholder="Masukkan nama lengkap"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
        </div>

        <!-- Email -->
        <div>
          <label class="block text-sm font-medium mb-1 text-gray-700">✉️ Email</label>
          <input type="email" name="email" required placeholder="contoh@email.com"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
        </div>

        <!-- Pesan -->
        <div>
          <label class="block text-sm font-medium mb-1 text-gray-700">💬 Pesan</label>
          <textarea name="pesan" rows="6" required placeholder="Tuliskan pesan atau pertanyaan Anda"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 resize-none"></textarea>
        </div>

        <!-- Tombol -->
        <div class="text-right pt-4">
          <button type="submit"
            class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition">
            📩 Kirim Pesan
          </button>
        </div>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer class="mt-20 bg-white border-t text-center py-6 text-sm text-gray-500">
    &copy; 2025 <span class="font-semibold text-green-600">BusNusantara</span>. Semua Hak Dilindungi.
  </footer>
  
</body>
</html>
