<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Edit Data Buku ✨</h1>
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

                <form action="{{ route('buku.update', $item->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <!-- Input Types -->
                    <div>
                        <div class="grid gap-5 md:grid-cols-3 mb-5">
                            
                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="judul">Judul</label>
                                    <input id="judul" name="judul" class="form-input w-full" type="text" value="{{ $item->judul }}" />
                                </div>
                                <!-- End -->
                            </div>
                            
                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="nomor_induk">Nomor Induk</label>
                                    <input id="nomor_induk" name="nomor_induk" class="form-input w-full" type="text" value="{{ $item->nomor_induk }}" />
                                </div>
                                <!-- End -->
                            </div>

                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="jumlah">Jumlah</label>
                                    <input id="jumlah" name="jumlah" class="form-input w-full" type="number" value="{{ $item->jumlah }}" />
                                </div>
                                <!-- End -->
                            </div>

                            <!-- Select -->
                            <div>
                                <label class="block text-sm font-medium mb-1" for="publishers_id">Penerbit</label>
                                <select id="publishers_id" name="publishers_id" class="form-select text-sm w-full">
                                    <option selected value="{{ $item->publisher->id }}">{{ $item->publisher->name }}</option>
                                    @foreach ($publishers as $publisher)
                                        <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="pengarang">Pengarang</label>
                                    <input id="pengarang" name="pengarang" class="form-input w-full" type="text" value="{{ $item->pengarang }}" />
                                </div>
                                <!-- End -->
                            </div>

                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="tahun_terbit">Tahun Terbit</label>
                                    <input id="tahun_terbit" name="tahun_terbit" class="form-input w-full" type="number" value="{{ $item->tahun_terbit }}" />
                                </div>
                                <!-- End -->
                            </div>

                            <!-- Select -->
                            <div>
                                <label class="block text-sm font-medium mb-1" for="classifications_id">Klasifikasi</label>
                                <select id="classifications_id" name="classifications_id" class="form-select text-sm w-full">
                                    <option selected value="{{ $item->classification->id }}">{{ $item->classification->name }}</option>
                                    @foreach ($classifications as $classification)
                                        <option value="{{ $classification->id }}">{{ $classification->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="asal">Asal</label>
                                    <input id="asal" name="asal" class="form-input w-full" type="text" value="{{ $item->asal }}" />
                                </div>
                                <!-- End -->
                            </div>

                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="harga">Harga</label>
                                    <input id="harga" name="harga" class="form-input w-full" type="number" value="{{ $item->harga }}" />
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
</x-app-layout>
