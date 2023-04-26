<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-5">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Buku ✨</h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Search form -->
                <x-search-form placeholder="Cari berdasarkan judul buku" />

                <!-- Cetak Laporan -->
                <div class="relative inline-flex" x-data="{ open: false }">
                    <button
                        class="btn bg-orange-500 hover:bg-orange-600 text-white"
                        :class="{ 'bg-slate-100 text-slate-500': open }"
                        aria-haspopup="true"
                        @click.prevent="open = !open"
                        :aria-expanded="open"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                        </svg>
                        <span class="hidden xs:block ml-2">Cetak Laporan</span>
                    </button>
                    <div
                        class="origin-top-right z-10 absolute top-full right-0 min-w-36 bg-white border border-slate-200 py-1.5 rounded shadow-lg overflow-hidden mt-1"                
                        @click.outside="open = false"
                        @keydown.escape.window="open = false"
                        x-show="open"
                        x-transition:enter="transition ease-out duration-200 transform"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-out duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        x-cloak                
                    >
                        <ul>
                            <li>
                                <a target="__blank" class="font-medium text-sm text-slate-600 hover:text-indigo-800 flex py-1 px-3" href="#" @click="open = false" @focus="open = true" @focusout="open = false">Jumlah Buku yang Dimiliki</a>
                            </li>
                            <li>
                                <a target="__blank" class="font-medium text-sm text-slate-600 hover:text-indigo-800 flex py-1 px-3" href="#" @click="open = false" @focus="open = true" @focusout="open = false">Jumlah Penambahan Buku</a>
                            </li>
                            <li>
                                <a target="__blank" class="font-medium text-sm text-slate-600 hover:text-indigo-800 flex py-1 px-3" href="#" @click="open = false" @focus="open = true" @focusout="open = false">Jumlah Buku Dipinjam</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Create book button -->
                <a href="{{ route('buku.create') }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="hidden xs:block ml-2">Tambah Buku</span>
                </a>                           
                
            </div>

        </div>      

        <!-- Table -->
        <x-buku.buku-table :books="$books" :count="$books_count" />
        
        <!-- Pagination -->
        <div class="mt-8">
            {{$books->links()}}
        </div>

    </div>
</x-app-layout>
