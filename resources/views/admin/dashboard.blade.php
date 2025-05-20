<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Daftar Rute</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .scroll-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
        }
    </style>
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
                <div class="flex justify-between items-center flex-wrap gap-4">
                    <h1 class="text-xl font-bold">📍 Daftar Rute Bus</h1>
                    
                    <!-- Search Bar -->
                    <form action="{{ route('admin.dashboard') }}" method="GET" class="flex w-full md:w-1/3">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari asal, tujuan, bus, tanggal..."
                        class="flex-1 px-4 py-2 text-sm text-gray-800 bg-white border border-gray-300 rounded-l-md focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    />
                    <button
                        type="submit"
                        class="px-4 py-2 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-r-md transition font-medium"
                    >
                        🔍 Cari
                    </button>
                </form>

                </div>
            </header>

            <!-- Flash Message -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <!-- Rute Table -->
            <section class="bg-white p-6 rounded-xl shadow-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-gray-700">
                        <thead class="bg-gray-200 text-xs font-semibold uppercase text-left tracking-wider">
                            <tr>
                                <th class="py-3 px-4">Asal</th>
                                <th class="py-3 px-4">Tujuan</th>
                                <th class="py-3 px-4">Tanggal</th>
                                <th class="py-3 px-4">Bus</th>
                                <th class="py-3 px-4">Harga</th>
                                <th class="py-3 px-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rutes as $r)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="py-3 px-4">{{ $r->asal }}</td>
                                    <td class="py-3 px-4">{{ $r->tujuan }}</td>
                                    <td class="py-3 px-4">{{ $r->tanggal_berangkat }}</td>
                                    <td class="py-3 px-4">{{ $r->merk_bus }} - {{ $r->tipe_bus }}</td>
                                    <td class="py-3 px-4">Rp{{ number_format($r->harga, 0, ',', '.') }}</td>
                                    <td class="py-3 px-4 space-x-2">
                                        <a href="{{ route('admin.rute.edit', $r->id) }}" class="text-blue-600 hover:text-blue-800 text-sm">✏️ Edit</a>
                                        <form action="{{ route('admin.rute.delete', $r->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus rute ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm">🗑️ Hapus</button>
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

    <!-- Scroll to Top Button -->
    <button id="scrollToTopBtn" class="bg-blue-600 text-white p-3 rounded-full hover:bg-blue-700 scroll-to-top" onclick="scrollToTop()">↑</button>

    <script>
        window.onscroll = function() {
            const scrollToTopBtn = document.getElementById("scrollToTopBtn");
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                scrollToTopBtn.style.display = "block";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        };

        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: "smooth" });
        }
    </script>

</body>
</html>
