<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daftar Rute - BusNusantara</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />

  <!-- Flatpickr CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />

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
        <a href="{{ route('rute.index') }}" class="text-green-600 font-semibold">Rute</a>
        <a href="{{ route('kontak') }}" class="hover:text-green-600 transition">Kontak</a>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="bg-gradient-to-r from-green-500 to-blue-500 text-white py-16 px-6 text-center">
    <h2 class="text-4xl md:text-5xl font-bold mb-2">📍 Semua Rute Bus</h2>
    <p class="text-lg md:text-xl">Lihat daftar rute lengkap yang tersedia di BusNusantara</p>
  </section>

  <!-- Filter Form -->
  <section class="max-w-6xl mx-auto px-4 mt-12">
    <form id="filterForm" class="grid md:grid-cols-5 gap-4 bg-white border border-gray-200 rounded-2xl shadow-md p-6">
      <div>
        <label for="asal" class="block text-sm font-medium mb-1 text-gray-700">Asal</label>
        <input type="text" name="asal" id="asal" placeholder="Kota Asal"
          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
      </div>
      <div>
        <label for="tujuan" class="block text-sm font-medium mb-1 text-gray-700">Tujuan</label>
        <input type="text" name="tujuan" id="tujuan" placeholder="Kota Tujuan"
          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
      </div>
      <div>
        <label for="tanggal_berangkat" class="block text-sm font-medium mb-1 text-gray-700">Tanggal</label>
        <input type="text" name="tanggal_berangkat" id="tanggal_berangkat" placeholder="Pilih tanggal"
          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
      </div>
      <div>
        <label for="min_harga" class="block text-sm font-medium mb-1 text-gray-700">Harga Min</label>
        <input type="number" name="min_harga" id="min_harga" placeholder="Rp Min"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
      </div>
      <div>
        <label for="max_harga" class="block text-sm font-medium mb-1 text-gray-700">Harga Max</label>
        <input type="number" name="max_harga" id="max_harga" placeholder="Rp Max"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
      </div>
    </form>
  </section>

  <!-- Loading Indicator -->
  <section class="max-w-6xl mx-auto px-4 mt-2 text-center">
    <div id="loading" class="hidden text-green-600 font-semibold">Loading...</div>
  </section>

  <!-- Daftar Rute -->
  <section id="ruteList" class="max-w-6xl mx-auto px-4 py-12">
    @include('partials.rute-list', ['rute' => $rute])
  </section>

  <!-- Footer -->
  <footer class="mt-20 bg-white border-t text-center py-6 text-sm text-gray-500">
    &copy; 2025 <span class="font-semibold text-green-600">BusNusantara</span>. Semua Hak Dilindungi.
  </footer>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
  <script>
    // Inisialisasi kalender Flatpickr
    flatpickr("#tanggal_berangkat", {
      locale: "id",
      dateFormat: "Y-m-d",      // Format yang dikirim ke backend (invisible)
      altInput: true,           // Tampilan buat user
      altFormat: "d-m-Y",       // Format yang ditampilkan
      minDate: "today",
      disableMobile: true
    });

    // Debounce filter form
    let debounceTimer;

    function fetchFilteredData() {
      $('#loading').removeClass('hidden');

      let asal = $('#asal').val();
      let tujuan = $('#tujuan').val();
      let tanggal_berangkat = $('#tanggal_berangkat').val();
      let minHarga = $('#min_harga').val();
      let maxHarga = $('#max_harga').val();

      $.ajax({
        url: '{{ route("rute.index") }}',
        type: 'GET',
        data: {
          asal,
          tujuan,
          tanggal_berangkat,
          min_harga: minHarga,
          max_harga: maxHarga
        },
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        success: function(response) {
          $('#ruteList').html(response);
        },
        error: function() {
          $('#ruteList').html('<p class="text-center text-red-500">Gagal memuat data rute.</p>');
        },
        complete: function() {
          $('#loading').addClass('hidden');
        }
      });
    }

    // Trigger saat input berubah
    $('#filterForm input').on('input change', function () {
      clearTimeout(debounceTimer);
      debounceTimer = setTimeout(fetchFilteredData, 400);
    });
  </script>
</body>
</html>
