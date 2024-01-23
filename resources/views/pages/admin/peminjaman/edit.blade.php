<x-admin-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Edit Pustakawan ✨</h1>
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

                <form action="{{ route('admin-pustakawan.update', $item->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <!-- Input Types -->
                    <div>
                        <div class="grid gap-5 md:grid-cols-2 mb-5">
                            
                            <!-- Select -->
                            <div>
                                <label class="block text-sm font-medium mb-1" for="users_id">Nama Anggota</label>
                                <select id="users_id" name="users_id" class="form-select text-sm w-full">
                                    <option selected value="{{ $item->user->id }}">{{ $item->user->name }}</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Select -->
                            <div>
                                <label class="block text-sm font-medium mb-1" for="books_id">Judul Buku yang Dipinjam</label>
                                <select id="books_id" name="books_id" class="form-select text-sm w-full">
                                    <option selected value="{{ $item->book->id }}">{{ $item->book->judul }}</option>
                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->judul }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1" for="created_at">Tanggal Pinjam</label>
                                <input id="created_at" name="created_at" class="form-input text-sm w-full" type="date" value="{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}"/>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1" for="foto_bukti">Ganti Foto Bukti Pustakawan</label>
                                <input id="foto_bukti" name="foto_bukti" type="file" class="form-input text-sm w-full"/>
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
