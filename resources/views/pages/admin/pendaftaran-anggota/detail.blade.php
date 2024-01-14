<x-admin-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Detail Pendaftaran Anggota ✨</h1>
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

                <form action="{{ route('admin-pendaftaran.update', $item->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <!-- Input Types -->
                    <div>
                        <div class="grid gap-5 md:grid-cols-3 mb-5">
                            
                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="name">Nama Lengkap</label>
                                    <input id="name" name="name" class="form-input w-full disabled:cursor-not-allowed" type="text" value="{{ $item->name }}" disabled/>
                                </div>
                                <!-- End -->
                            </div>

                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="nisn">NISN</label>
                                    <input id="nisn" name="nisn" class="form-input w-full disabled:cursor-not-allowed" type="text" value="{{ $item->nisn }}" disabled />
                                </div>
                                <!-- End -->
                            </div>
                            
                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="alamat">Alamat</label>
                                    <input id="alamat" name="alamat" class="form-input w-full disabled:cursor-not-allowed" type="text" value="{{ $item->alamat }}" disabled />
                                </div>
                                <!-- End -->
                            </div>
                            
                        </div>
                        <div class="grid gap-5 md:grid-cols-3 mb-5">
                            
                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="tempat_lahir">Tempat Lahir</label>
                                    <input id="tempat_lahir" name="tempat_lahir" class="form-input w-full disabled:cursor-not-allowed" type="text" value="{{ $item->tempat_lahir }}" disabled />
                                </div>
                                <!-- End -->
                            </div>
                            
                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="tgl_lahir">Tanggal Lahir</label>
                                    <input id="tgl_lahir" name="tgl_lahir" class="form-input w-full disabled:cursor-not-allowed" type="text" value="{{ $item->tgl_lahir }}" disabled/>
                                </div>
                                <!-- End -->
                            </div>

                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="nomor_hp">Nomor HP/WA</label>
                                    <input id="nomor_hp" name="nomor_hp" class="form-input w-full disabled:cursor-not-allowed" type="number" value="{{ $item->nomor_hp }}" disabled/>
                                </div>
                                <!-- End -->
                            </div>

                        </div>
                        <div class="grid gap-5 md:grid-cols-3 mb-5">
                            
                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="nomor_hp_ortu">Nomor HP Orang Tua</label>
                                    <input id="nomor_hp_ortu" name="nomor_hp_ortu" class="form-input w-full disabled:cursor-not-allowed" type="number" value="{{ $item->nomor_hp_ortu }}" disabled/>
                                </div>
                                <!-- End -->
                            </div>

                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="nama_ibu">Nama Ibu</label>
                                    <input id="nama_ibu" name="nama_ibu" class="form-input w-full disabled:cursor-not-allowed" type="text" value="{{ $item->nama_ibu }}" disabled/>
                                </div>
                                <!-- End -->
                            </div>
                            
                            <!-- Select -->
                            <div>
                                <label class="block text-sm font-medium mb-1" for="competencies_id">Jurusan</label>
                                <input id="nama_ibu" name="nama_ibu" class="form-input w-full disabled:cursor-not-allowed" type="text" value="{{ $item->competency->name }}" disabled/>
                            </div>
                            
                        </div>

                        <div class="grid gap-5 md:grid-cols-3 mb-5">
                            <!-- Select -->
                            <div>
                                <label class="block text-sm font-medium mb-1" for="class_rooms_id">Kelas</label>
                                <input id="nama_ibu" name="nama_ibu" class="form-input w-full disabled:cursor-not-allowed" type="text" value="{{ $item->classroom->name }}" disabled/>
                            </div>

                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="email">Akun Email</label>
                                    <input id="email" name="email" class="form-input w-full disabled:cursor-not-allowed" type="email" value="{{ $item->email }}" disabled/>
                                </div>
                                <!-- End -->
                            </div>
                        </div>

                        <div class="flex space-x-2 justify-end">
                            <input type="submit" name="status" value="Ditolak" class="btn bg-rose-500 hover:bg-rose-600 text-white">
                            <input type="submit" name="status" value="Terverifikasi" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</x-admin-layout>
