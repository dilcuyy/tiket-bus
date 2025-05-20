<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Review</title>
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
                <h1 class="text-xl font-bold">💬 Semua Review Pengguna</h1>
                <a href="{{ route('admin.dashboard') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">← Kembali</a>
            </div>
        </header>

        <!-- Review Table -->
        <section class="bg-white p-6 rounded-xl shadow-lg">
            <h2 class="text-2xl font-bold mb-4">💬 Daftar Review</h2>

            @if($reviews->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-gray-800 border border-gray-200">
                        <thead class="bg-gray-100 text-xs font-semibold uppercase text-left tracking-wider">
                            <tr>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Pesan</th>
                                <th class="px-4 py-3">Tanggal</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($reviews as $r)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium">{{ $r->nama }}</td>
                                    <td class="px-4 py-3">{{ $r->email ?? '-' }}</td>
                                    <td class="px-4 py-3 italic max-w-xs truncate">"{{ $r->pesan }}"</td>
                                    <td class="px-4 py-3 text-gray-500">{{ $r->created_at->format('d M Y H:i') }}</td>
                                    <td class="px-4 py-3 text-center space-x-2">
                                        <form action="{{ route('admin.review.destroy', $r->id) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Yakin mau hapus review ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-xs rounded transition">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $reviews->links() }}
                </div>
            @else
                <div class="text-center py-10 text-gray-500">
                    🚫 Belum ada review yang masuk.
                </div>
            @endif
        </section>
    </main>
</div>

</body>
</html>
