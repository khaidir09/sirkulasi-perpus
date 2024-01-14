<x-admin-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-5">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Daftar Pengajuan ✨</h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Search form -->
                {{-- <x-search-form placeholder="Cari berdasarkan nama anggota" /> --}}
                
            </div>

        </div>      

        <!-- Table -->
        <x-pengajuan.pengajuan-table-admin :wishlists="$wishlists" :count="$wishlists_count" />
        
        <!-- Pagination -->
        <div class="mt-8">
            {{$wishlists->links()}}
        </div>

    </div>
</x-admin-layout>
