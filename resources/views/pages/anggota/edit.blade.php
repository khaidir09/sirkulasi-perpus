<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Edit Data Anggota ✨</h1>
        </div>

        <div class="border-t border-slate-200">

            <!-- Components -->
            <div class="space-y-8 mt-8">

                @if ($errors->any())
                    <div x-show="open" x-data="{ open: true }">
                        <div class="px-4 py-2 rounded-sm text-sm bg-rose-500 text-white">
                            <div class="flex w-full justify-between items-start">
                                <div class="flex">
                                    <svg class="w-4 h-4 shrink-0 fill-current opacity-80 mt-[3px] mr-3" viewBox="0 0 16 16">
                                        <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm1 12H7V7h2v5zM8 6c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1z" />
                                    </svg>
                                    @foreach ($errors->all() as $error)
                                        <div class="font-medium">{{ $error }}</div>
                                    @endforeach
                                </div>
                                <button class="opacity-70 hover:opacity-80 ml-3 mt-[3px]" @click="open = false">
                                    <div class="sr-only">Close</div>
                                    <svg class="w-4 h-4 fill-current">
                                        <path d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('list-anggota.update', $item->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <!-- Input Types -->
                    <div>
                        <div class="grid gap-5 md:grid-cols-3 mb-5">
                            
                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="name">Nama Lengkap</label>
                                    <input id="name" name="name" class="form-input w-full" type="text" value="{{ $item->name }}" />
                                </div>
                                <!-- End -->
                            </div>

                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="nisn">NISN</label>
                                    <input id="nisn" name="nisn" class="form-input w-full" type="number" value="{{ $item->nisn }}"/>
                                </div>
                                <!-- End -->
                            </div>
                            
                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="alamat">Alamat</label>
                                    <input id="alamat" name="alamat" class="form-input w-full" type="text" value="{{ $item->alamat }}" />
                                </div>
                                <!-- End -->
                            </div>
                            
                        </div>
                        <div class="grid gap-5 md:grid-cols-4 mb-5">
                            
                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="tempat_lahir">Tempat Lahir</label>
                                    <input id="tempat_lahir" name="tempat_lahir" class="form-input w-full" type="text" value="{{ $item->tempat_lahir }}" />
                                </div>
                                <!-- End -->
                            </div>
                            
                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="tgl_lahir">Tanggal Lahir</label>
                                    <input id="tgl_lahir" name="tgl_lahir" class="form-input w-full" type="date" value="{{ $item->tgl_lahir }}" />
                                </div>
                                <!-- End -->
                            </div>

                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="nomor_hp">Nomor HP/WA</label>
                                    <input id="nomor_hp" name="nomor_hp" class="form-input w-full" type="number" value="{{ $item->nomor_hp }}" />
                                </div>
                                <!-- End -->
                            </div>

                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="nomor_hp_ortu">Nomor HP Orang Tua</label>
                                    <input id="nomor_hp_ortu" name="nomor_hp_ortu" class="form-input w-full" type="number" value="{{ $item->nomor_hp_ortu }}" />
                                </div>
                                <!-- End -->
                            </div>
                            
                        </div>
                        <div class="grid gap-5 md:grid-cols-3 mb-5">
                            
                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="nama_ibu">Nama Ibu</label>
                                    <input id="nama_ibu" name="nama_ibu" class="form-input w-full" type="text" value="{{ $item->nama_ibu }}" />
                                </div>
                                <!-- End -->
                            </div>
                            
                            <!-- Select -->
                            <div>
                                <label class="block text-sm font-medium mb-1" for="competencies_id">Jurusan</label>
                                <select id="competencies_id" name="competencies_id" class="form-select text-sm w-full">
                                    <option selected value="{{ $item->competency->id }}">{{ $item->competency->name }}</option>
                                    @foreach ($competencies as $competency)
                                        <option value="{{ $competency->id }}">{{ $competency->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Select -->
                            <div>
                                <label class="block text-sm font-medium mb-1" for="class_rooms_id">Kelas</label>
                                <select id="class_rooms_id" name="class_rooms_id" class="form-select text-sm w-full">
                                    <option selected value="{{ $item->classroom->id }}">{{ $item->classroom->name }}</option>
                                    @foreach ($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                        <div class="grid gap-5 md:grid-cols-2 mb-5">
                            
                            <div>
                                <!-- Start -->
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="email">Akun Email</label>
                                    <input id="email" name="email" class="form-input w-full" type="email" value="{{ $item->email }}"/>
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
</x-app-layout>
