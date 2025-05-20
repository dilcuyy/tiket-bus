<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Edit Rute</title>
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
            <a href="{{ route('admin.review.index') }}" class="block p-2 rounded hover:bg-blue-700 transition">💬 Review</a>
            <a href="{{ route('admin.rute.create') }}" class="block p-2 rounded hover:bg-blue-700 transition">🧾 Tambah Rute</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-auto">

        <!-- Header -->
        <header class="bg-blue-600 text-white p-4 rounded-md shadow-md mb-6">
            <div class="flex justify-between items-center flex-wrap gap-2">
                <h1 class="text-xl font-bold">🛣️ Edit Rute</h1>
                <a href="{{ route('admin.dashboard') }}" class="bg-white text-blue-700 hover:bg-blue-100 px-4 py-2 rounded-lg transition">← Kembali</a>
            </div>
        </header>

        <!-- Edit Form -->
        <section class="bg-white p-6 rounded-xl shadow-lg max-w-2xl mx-auto">
            <h2 class="text-2xl font-bold mb-4">✏️ Form Edit Rute</h2>

            <form action="{{ route('admin.rute.update', $rute->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="asal" class="block text-sm font-medium text-gray-700">Asal</label>
                    <input type="text" name="asal" id="asal" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" value="{{ $rute->asal }}" required>
                </div>
                <div>
                    <label for="tujuan" class="block text-sm font-medium text-gray-700">Tujuan</label>
                    <input type="text" name="tujuan" id="tujuan" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" value="{{ $rute->tujuan }}" required>
                </div>
                <div>
                    <label for="tanggal_berangkat" class="block text-sm font-medium text-gray-700">Tanggal Berangkat</label>
                    <input type="date" name="tanggal_berangkat" id="tanggal_berangkat" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" value="{{ $rute->tanggal_berangkat }}" required>
                </div>
                <div>
                    <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" name="harga" id="harga" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" value="{{ $rute->harga }}" required>
                </div>
                <div>
                    <label for="merk_bus" class="block text-sm font-medium text-gray-700">Merk Bus</label>
                    <input type="text" name="merk_bus" id="merk_bus" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" value="{{ $rute->merk_bus }}" required>
                </div>
                <div>
                    <label for="tipe_bus" class="block text-sm font-medium text-gray-700">Tipe Bus</label>
                    <input type="text" name="tipe_bus" id="tipe_bus" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" value="{{ $rute->tipe_bus }}" required>
                </div>

                <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 rounded-lg transition">💾 Simpan Perubahan</button>
            </form>
        </section>
    </main>
</div>

</body>
</html>
