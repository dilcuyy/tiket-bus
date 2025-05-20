<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Form Pemesanan Tiket | BusNusantara</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Inter', sans-serif; }

    @media print {
    body * {
      visibility: hidden;
    }
    #strukBooking, #strukBooking * {
      visibility: visible;
    }
    #strukBooking {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
    }
  }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

  <!-- Navbar -->
  <header class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
      <h1 class="text-2xl font-bold text-green-600">BusNusantara</h1>
      <nav class="hidden md:flex space-x-6 font-medium">
        <a href="/" class="hover:text-green-600 transition">Beranda</a>
        <a href="{{ route('rute.index') }}" class="hover:text-green-600 transition">Rute</a>
        <a href="{{ route('kontak') }}" class="hover:text-green-600 transition">Kontak</a>
      </nav>
    </div>
  </header>

  <!-- Header -->
  <section class="bg-gradient-to-r from-green-500 to-blue-500 text-white py-16 px-6 text-center">
  <h2 id="headerTitle" class="text-4xl md:text-5xl font-bold mb-4">Form Pemesanan Tiket</h2>
    <p class="text-lg md:text-xl mb-2">Rute: {{ $rute->asal }} → {{ $rute->tujuan }}</p>
    <p class="text-md opacity-90">
      Tanggal Berangkat: {{ \Carbon\Carbon::parse($rute->tanggal_berangkat)->translatedFormat('d F Y') }}
    </p>
  </section>

  <!-- Booking Form -->
  <section class="max-w-3xl mx-auto px-6 mt-[-60px]">
    <div class="bg-white rounded-2xl shadow-2xl p-8 space-y-6 border border-gray-100" id="formPemesanan">
      <form id="formBooking" onsubmit="return kirimBooking(event)">
        <div class="space-y-4" id="formInput">
          <div>
            <label class="block mb-1 text-gray-700 font-medium">Nama Lengkap</label>
            <input type="text" name="nama" required class="w-full px-4 py-3 border rounded-lg shadow-sm focus:ring-2 focus:ring-green-500">
          </div>
          <div>
            <label class="block mb-1 text-gray-700 font-medium">No. Telepon</label>
            <input type="text" name="telepon" required class="w-full px-4 py-3 border rounded-lg shadow-sm focus:ring-2 focus:ring-green-500">
          </div>
          <div>
            <label class="block mb-1 text-gray-700 font-medium">Email</label>
            <input type="email" name="email" required class="w-full px-4 py-3 border rounded-lg shadow-sm focus:ring-2 focus:ring-green-500">
          </div>
          <div>
            <label class="block mb-2 text-gray-700 font-semibold">🪑 Pilih Kursi</label>
            <div id="gridKursi" class="grid grid-cols-4 gap-2 mb-4"></div>
            <input type="hidden" name="kursi" id="kursiDipilih">
          </div>
          <div class="flex justify-end space-x-3">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">Konfirmasi</button>
            <a href="{{ route('beranda') }}" class="bg-gray-400 text-white px-6 py-2 rounded-lg hover:bg-gray-500">Batal</a>
          </div>
        </div>
      </form>

      <!-- Struk -->
      <div id="strukBooking" class="hidden border-t mt-6 pt-6"></div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="mt-20 bg-white border-t text-center py-6 text-sm text-gray-500">
    &copy; 2025 <span class="font-semibold text-green-600">BusNusantara</span>. Semua Hak Dilindungi.
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    const semuaKursi = ['A1','A2','A3','A4','B1','B2','B3','B4','C1','C2','C3','C4'];
    const ruteId = {{ $rute->id }};
    const grid = document.getElementById('gridKursi');

    fetch(`/api/kursi/${ruteId}`)
      .then(res => res.json())
      .then(terisi => {
        semuaKursi.forEach(k => {
          const div = document.createElement('div');
          div.className = 'kursi p-4 border rounded-lg text-center cursor-pointer font-medium';
          div.innerText = k;
          div.dataset.kursi = k;

          if (terisi.includes(k)) {
            div.classList.add('bg-gray-300', 'cursor-not-allowed', 'text-gray-600');
          } else {
            div.onclick = () => {
              document.querySelectorAll('.kursi').forEach(el => el.classList.remove('bg-green-600', 'text-white'));
              div.classList.add('bg-green-600', 'text-white');
              document.getElementById('kursiDipilih').value = k;
            };
          }

          grid.appendChild(div);
        });
      });

    function kirimBooking(event) {
      event.preventDefault();

      const form = document.getElementById('formBooking');
      const kursi = document.getElementById('kursiDipilih').value;

      if (!kursi) {
        alert("Silakan pilih kursi terlebih dahulu.");
        return false;
      }

      const data = {
        rute_bus_id: ruteId,
        nama: form.nama.value,
        telepon: form.telepon.value,
        email: form.email.value,
        kursi: kursi
      };

      fetch("{{ route('booking.store') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
      })
      .then(async res => {
        if (!res.ok) {
          const errMsg = await res.text();
          console.error("Server error:", errMsg);
          alert("Gagal mengirim data: " + res.status);
          return;
        }
        return res.json();
      })
      .then(data => {
        if (!data) return;
        if (data.success) {
        // 🔥 Ganti judul dan subjudul
        document.querySelector('section.bg-gradient-to-r h2').innerText = "Selamat, pesananmu berhasil! 🎉";
        document.querySelector('section.bg-gradient-to-r p').innerText = "Detail tiketmu ada di bawah ya. Screenshot atau download PDF-nya sebelum kamu tutup halaman ini!";

        // 🔥 Scroll smooth ke atas biar liat header-nya
        window.scrollTo({ top: 0, behavior: 'smooth' });

        document.getElementById('formInput').classList.add('hidden');
          const struk = `
            <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-300 print:shadow-none print:border max-w-md mx-auto font-mono text-[15px] text-gray-800 leading-tight">
                <div class="text-center mb-4">
                <h2 class="text-xl font-bold tracking-wide">🧾 STRUK TIKET BUS</h2>
                <p class="text-sm text-gray-500">PT. Bus Nusantara</p>
                <p class="text-sm text-gray-500">Jl. Transportasi No. 1</p>
                </div>
                <div class="border-t border-dashed border-gray-400 my-3"></div>
                <div class="space-y-1">
                <p><span class="font-semibold">👤 Nama:</span> ${data.booking.nama}</p>
                <p><span class="font-semibold">📞 Telepon:</span> ${data.booking.telepon}</p>
                <p><span class="font-semibold">✉️ Email:</span> ${data.booking.email}</p>
                <p><span class="font-semibold">🪑 Kursi:</span> ${data.booking.kursi}</p>
                </div>
                <div class="border-t border-dashed border-gray-400 my-3"></div>
                <div class="space-y-1">
                <p><span class="font-semibold">🛫 Asal:</span> ${data.rute.asal}</p>
                <p><span class="font-semibold">🛬 Tujuan:</span> ${data.rute.tujuan}</p>
                <p><span class="font-semibold">📅 Tanggal:</span> ${new Date(data.rute.tanggal_berangkat).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}</p>
                <p><span class="font-semibold">🚌 Bus:</span> ${data.rute.merk_bus ?? '-'} - ${data.rute.tipe_bus ?? '-'}</p>
                <p><span class="font-semibold">💰 Harga:</span> Rp${parseInt(data.rute.harga).toLocaleString('id-ID')}</p>
                </div>
                <div class="border-t border-dashed border-gray-400 my-3"></div>
                <div class="text-center text-sm mt-3 text-gray-600">
                <p>Terima kasih telah memesan 🙏</p>
                <p>Semoga perjalanan Anda menyenangkan 🚍</p>
                </div>
                <div class="text-center mt-6 space-x-3">
                <a href="/booking/${data.booking.id}/pdf" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full transition-all duration-150 text-sm">📥 Unduh PDF</a>
                <a href="/" class="bg-green-600 hover:bg-green-500 text-white px-5 py-2 rounded-full transition-all duration-150 text-sm">🏠 Kembali</a>
                </div>
            </div>
            `;
          document.getElementById('strukBooking').innerHTML = struk;
          document.getElementById('strukBooking').classList.remove('hidden');
        } else {
          alert("Terjadi kesalahan saat menyimpan booking.");
        }
      })
      .catch(err => {
        console.error("Fetch error:", err);
        alert("Terjadi masalah koneksi.");
      });
    }
</script>
</body>
</html>
