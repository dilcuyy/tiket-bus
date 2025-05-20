@if($rute->count())
  <div class="grid md:grid-cols-3 gap-6">
    @foreach($rute as $item)
      <div class="bg-white shadow-lg rounded-xl p-5 border border-gray-100">
        <h3 class="text-xl font-semibold text-green-700">
          {{ $item->asal }} → {{ $item->tujuan }}
        </h3>
        <p class="text-gray-600 mt-1">
          📅 {{ \Carbon\Carbon::parse($item->tanggal_berangkat)->translatedFormat('d F Y') }}
        </p>
        <p class="text-gray-800 mt-2 font-medium">
          🚌 {{ $item->merk_bus }} - {{ $item->tipe_bus }}
        </p>
        <p class="text-green-600 text-lg mt-3 font-bold">
          💸 Rp {{ number_format($item->harga, 0, ',', '.') }}
        </p>
      </div>
    @endforeach
  </div>

  <!-- Info & Pagination -->
  <div class="mt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-600">
    <div class="flex items-center gap-2 text-gray-600 text-xs md:text-sm font-semibold select-none">
    <span class="uppercase tracking-wide text-gray-400">showing</span>
    <span class="px-2 py-1 bg-gray-100 rounded-md text-gray-900">{{ $rute->firstItem() }}-{{ $rute->lastItem() }}</span>
    <span class="uppercase tracking-wide text-gray-400">ofa</span>
    <span class="px-2 py-1 bg-gray-100 rounded-md text-gray-900">{{ $rute->total() }}</span>
    </div>
    <div class="mt-4 md:mt-0">
      {{ $rute->links() }}
    </div>
  </div>
@else
  <div class="text-center text-gray-500 text-lg py-12">
    🙁 Yah, belum ada rute yang cocok. Coba ubah filter pencarianmu.
  </div>
@endif
