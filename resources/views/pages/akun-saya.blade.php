<x-member-layout background="bg-white">
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Akun Saya ✨</h1>
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

                <form action="{{ route('akun-saya-update', $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Input Types -->
                    <div>
                        <div class="grid gap-5 md:grid-cols-2 mb-5">
                            
                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="name">Nama Lengkap</label>
                                    <input id="name" name="name" class="form-input w-full" type="text" value="{{ $user->name }}" />
                                </div>
                                <!-- End -->
                            </div>

                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="tempat_lahir">Tempat Lahir</label>
                                    <input id="tempat_lahir" name="tempat_lahir" class="form-input w-full" type="text" value="{{ $user->tempat_lahir }}" />
                                </div>
                                <!-- End -->
                            </div>

                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="tgl_lahir">Tanggal Lahir</label>
                                    <input id="tgl_lahir" name="tgl_lahir" class="form-input w-full" type="date" value="{{ $user->tgl_lahir }}" />
                                </div>
                                <!-- End -->
                            </div>
                            
                            <!-- Select -->
                            <div>
                                <label class="block text-sm font-medium mb-1" for="competencies_id">Jurusan</label>
                                <select id="competencies_id" name="competencies_id" class="form-select text-sm w-full">
                                    <option selected value="{{ $user->competency->id }}">{{ $user->competency->name }}</option>
                                    @foreach ($competencies as $competency)
                                        <option value="{{ $competency->id }}">{{ $competency->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Select -->
                            <div>
                                <label class="block text-sm font-medium mb-1" for="class_rooms_id">Kelas</label>
                                <select id="class_rooms_id" name="class_rooms_id" class="form-select text-sm w-full">
                                    <option selected value="{{ $user->classroom->id }}">{{ $user->classroom->name }}</option>
                                    @foreach ($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="nomor_hp">Nomor HP/WA</label>
                                    <input id="nomor_hp" name="nomor_hp" class="form-input w-full" type="number" value="{{ $user->nomor_hp }}" />
                                </div>
                                <!-- End -->
                            </div>

                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="nama_ibu">Nama Ibu</label>
                                    <input id="nama_ibu" name="nama_ibu" class="form-input w-full" type="text" value="{{ $user->nama_ibu }}" />
                                </div>
                                <!-- End -->
                            </div>

                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="nomor_hp_ortu">Nomor HP Orang Tua</label>
                                    <input id="nomor_hp_ortu" name="nomor_hp_ortu" class="form-input w-full" type="number" value="{{ $user->nomor_hp_ortu }}" />
                                </div>
                                <!-- End -->
                            </div>

                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="alamat">Alamat</label>
                                    <input id="alamat" name="alamat" class="form-input w-full" type="text" value="{{ $user->alamat }}" />
                                </div>
                                <!-- End -->
                            </div>

                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="password">Kata Sandi</label>
                                    <input id="password" name="password" class="form-input w-full" type="password" />
                                    <div class="text-xs mt-2 text-slate-600">
                                        Jika tidak inggin mengganti kata sandi, silahkan kosongkan saja
                                    </div>
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
</x-member-layout>
