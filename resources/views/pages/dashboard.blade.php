<x-member-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        
        <!-- Banner -->
        <x-dashboard.banner />

        <!-- Welcome banner -->
        <x-member.welcome-banner />
        
        <!-- Cards -->
        <div class="grid grid-cols-12 gap-6">

            <!-- Table (Top Channels) -->
            <x-member.riwayat-peminjaman-table :loans="$loans" :count="$loans_count" />

        </div>

    </div>
</x-member-layout>
