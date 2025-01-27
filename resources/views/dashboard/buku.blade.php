<x-dashboard.main title="Buku">
    <div class="grid sm:grid-cols-2 gap-5 md:gap-6">
        @foreach (['total_buku_terdaftar', 'buku_terbaru'] as $type)
            <div class="flex items-center px-4 py-3 bg-white border-back rounded-xl">
                <span
                    class="
                  {{ $type == 'total_buku_terdaftar' ? 'bg-blue-300' : '' }}
                  {{ $type == 'buku_terbaru' ? 'bg-amber-300' : '' }}
                  p-3 mr-4 text-gray-700 rounded-full"></span>
                <div>
                    <p class="text-sm font-medium capitalize text-gray-600 line-clamp-1">
                        {{ str_replace('_', ' ', $type) }}
                    </p>
                    <p class="text-lg font-semibold text-gray-700 line-clamp-1">
                        {{ $type == 'total_buku_terdaftar' ? $buku->count() ?? '-' : '' }}
                        {{ $type == 'buku_terbaru' ? $buku_terbaru->nama ?? 'Belum ada buku Terbaru' : '' }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</x-dashboard.main>