<x-admin-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Input Data Klasifikasi ✨</h1>
        </div>

        <div class="border-t border-slate-200">

            <!-- Components -->
            <div class="space-y-8 mt-8">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin-klasifikasi.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Input Types -->
                    <div>
                        <div class="grid gap-5 md:grid-cols-2 mb-5">
                            
                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="kode">Kode Klasifikasi</label>
                                    <input id="kode" name="kode" class="form-input w-full" type="text" required />
                                </div>
                                <!-- End -->
                            </div>
                            
                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="name">Nama Klasifikasi</label>
                                    <input id="name" name="name" class="form-input w-full" type="text" required />
                                </div>
                                <!-- End -->
                            </div>
                            
                        </div>
                        <div class="flex justify-end">
                            <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                                <span class="hidden xs:block">Simpan</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</x-admin-layout>
