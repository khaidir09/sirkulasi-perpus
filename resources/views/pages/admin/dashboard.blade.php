<x-admin-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        
        <!-- Welcome banner -->
        <x-dashboard.welcome-banner />
        
        <!-- Cards -->
        <div class="grid grid-cols-12 gap-6">

            <!-- Line chart (Acme Advanced) -->
            <x-dashboard.koleksi :koleksibuku="$koleksibuku"  />

            <!-- Line chart (Acme Plus) -->
            <x-dashboard.stok-buku :stokbuku="$stokbuku" />

            <!-- Line chart (Acme Advanced) -->
            <x-dashboard.buku-dipinjam :dipinjam="$dipinjam"  />

            <!-- Line chart (Acme Professional) -->
            <x-dashboard.jumlah-anggota :anggota="$anggota" />

            <!-- Line chart (Acme Professional) -->
            <x-dashboard.jumlah-pengajuan :wishlist="$wishlist" />

            <!-- Doughnut chart (Top Countries) -->
            {{-- <x-dashboard.dashboard-card-06 /> --}}

            <!-- Table (Top Channels) -->
            {{-- <x-dashboard.dashboard-card-07 /> --}}

        </div>

    </div>
</x-admin-layout>
