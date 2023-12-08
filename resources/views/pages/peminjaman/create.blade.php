<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Input Transaksi Peminjaman ✨</h1>
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

                <form action="{{ route('peminjaman.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input id="status" name="status" class="form-input w-full" type="hidden" value="Belum dikembalikan" />
                    <input id="kuantitas" name="kuantitas" class="form-input w-full px-2 py-1" type="hidden" value="1"/>
                    <!-- Input Types -->
                    <div>
                        <div class="grid gap-5 md:grid-cols-2 mb-5">
                            <!-- Select -->
                            <div>
                                <label class="block text-sm font-medium mb-1" for="users_id">Nama Anggota</label>
                                <select id="users_id" name="users_id" class="form-select text-sm w-full">
                                    <option>Pilih Anggota</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Select -->
                            <div>
                                <label class="block text-sm font-medium mb-1" for="books_id">Judul Buku</label>
                                <select id="books_id" name="books_id" class="form-select text-sm w-full">
                                    <option>Pilih Buku</option>
                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->judul }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1" for="foto_bukti">Upload Foto Bukti Peminjaman</label>
                                <input id="foto_bukti" name="foto_bukti" type="file" class="form-input w-full" required/>
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
