<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Rute - Admin</title>
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
                    <h1 class="text-xl font-bold">🚌 Tambah Rute Baru</h1>
                    <a href="{{ route('admin.dashboard') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">← Kembali</a>
                </div>
            </header>

            <!-- Form Section -->
            <section class="bg-white p-8 rounded-xl shadow-lg max-w-2xl mx-auto">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">📍 Form Tambah Rute</h2>

                <form action="{{ route('admin.rute.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="asal" class="block mb-1 text-sm font-medium text-gray-700">Asal</label>
                        <input type="text" name="asal" id="asal" placeholder="Contoh: Jakarta" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <div>
                        <label for="tujuan" class="block mb-1 text-sm font-medium text-gray-700">Tujuan</label>
                        <input type="text" name="tujuan" id="tujuan" placeholder="Contoh: Surabaya" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <div>
                        <label for="tanggal_berangkat" class="block mb-1 text-sm font-medium text-gray-700">Tanggal Berangkat</label>
                        <input type="date" name="tanggal_berangkat" id="tanggal_berangkat" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <div>
                        <label for="harga" class="block mb-1 text-sm font-medium text-gray-700">Harga</label>
                        <input type="number" name="harga" id="harga" placeholder="Contoh: 150000" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <div>
                        <label for="merk_bus" class="block mb-1 text-sm font-medium text-gray-700">Merk Bus</label>
                        <input type="text" name="merk_bus" id="merk_bus" placeholder="Contoh: PO Haryanto" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <div>
                        <label for="tipe_bus" class="block mb-1 text-sm font-medium text-gray-700">Tipe Bus</label>
                        <input type="text" name="tipe_bus" id="tipe_bus" placeholder="Contoh: Executive" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition duration-200">
                            💾 Simpan Rute
                        </button>
                    </div>
                </form>
            </section>
        </main>
    </div>

</body>
</html>
