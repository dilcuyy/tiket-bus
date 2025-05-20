<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Booking - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-blue-900 text-white p-6 flex flex-col">
            <h2 class="text-2xl font-bold mb-6">🛠️ Admin Panel</h2>
            <nav class="flex flex-col space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block p-2 rounded hover:bg-blue-700 transition">📊 Dashboard</a>
                <a href="{{ route('admin.bookings') }}" class="block p-2 rounded hover:bg-blue-700 transition">📋 Bookings</a>
                <a href="{{ route('admin.review.index') }}" class="block p-2 rounded hover:bg-blue-700 transition">💬 Review</a> <!-- new -->
                <a href="{{ route('admin.rute.create') }}" class="block p-2 rounded hover:bg-blue-700 transition">🧾 Tambah Rute</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-auto">

            <!-- Navbar -->
            <header class="bg-blue-600 text-white p-4 rounded-md shadow-md mb-6">
                <div class="flex justify-between items-center">
                    <h1 class="text-xl font-bold">📄 Riwayat Booking Tiket</h1>
                    <a href="{{ route('admin.dashboard') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                        ← Kembali
                    </a>
                </div>
            </header>

            <!-- Table Section -->
            <section class="bg-white p-6 rounded-xl shadow-lg">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">📋 Daftar Semua Pemesanan</h2>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-gray-700">
                        <thead class="bg-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                            <tr>
                                <th class="py-3 px-4">Nama</th>
                                <th class="py-3 px-4">Email</th>
                                <th class="py-3 px-4">Telepon</th>
                                <th class="py-3 px-4">Kursi</th>
                                <th class="py-3 px-4">Asal - Tujuan</th>
                                <th class="py-3 px-4">Tanggal</th>
                                <th class="py-3 px-4">Bus</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $b)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="py-3 px-4">{{ $b->nama }}</td>
                                    <td class="py-3 px-4">{{ $b->email }}</td>
                                    <td class="py-3 px-4">{{ $b->telepon }}</td>
                                    <td class="py-3 px-4">{{ $b->kursi }}</td>
                                    <td class="py-3 px-4">{{ $b->rute->asal }} - {{ $b->rute->tujuan }}</td>
                                    <td class="py-3 px-4">{{ $b->rute->tanggal_berangkat }}</td>
                                    <td class="py-3 px-4">{{ $b->rute->merk_bus }} - {{ $b->rute->tipe_bus }}</td>
                                    <td class="py-3 px-4 text-center">
                                        <form action="{{ route('admin.bookings.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pemesanan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

</body>
</html>
