<div class="col-span-full  bg-white shadow-lg rounded-sm border border-slate-200">
    <header class="px-5 py-4 border-b border-slate-100">
        <h2 class="font-semibold text-slate-800">Riwayat Peminjaman Buku</h2>
    </header>
    <div class="p-3">

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <!-- Table header -->
                <thead class="text-xs uppercase text-slate-400 bg-slate-50 rounded-sm">
                    <tr>
                        <th class="p-2">
                            <div class="font-semibold text-left">No.</div>
                        </th>
                        <th class="p-2">
                            <div class="font-semibold text-left">Judul Buku</div>
                        </th>
                        <th class="p-2">
                            <div class="font-semibold text-left">Kode Buku</div>
                        </th>
                        <th class="p-2">
                            <div class="font-semibold text-left">Tanggal Pinjam</div>
                        </th>
                        <th class="p-2">
                            <div class="font-semibold text-left">Tanggal Dikembalikan</div>
                        </th>
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody class="text-sm font-medium divide-y divide-slate-100">
                    <!-- Row -->
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($loans as $item)
                        <tr>
                            <td class="p-2">
                                <div class="text-slate-800">{{ $i++ }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-slate-800">{{ $item->book->judul }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-slate-800">{{ $item->kode_buku }}</div>
                            </td>
                            <td class="p-2">
                                <div>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</div>
                            </td>
                            <td class="p-2">
                                @if ($item->status != 'Sudah dikembalikan')
                                    <div>{{ $item->status }}</div>
                                @else
                                    <div>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>