<div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
    <div class="p-5">
        <header class="flex mb-2">
            <!-- Icon -->
            <img src="{{ asset('images/icon-01.svg') }}" width="32" height="32" alt="Icon 01" />
        </header>
        <h2 class="text-lg font-semibold text-slate-800 mb-2">Jumlah Anggota</h2>
        <div class="flex items-start">
            <div class="text-3xl font-bold text-slate-800 mr-2">{{ $anggota }}</div>
        </div>
    </div> 
</div>
