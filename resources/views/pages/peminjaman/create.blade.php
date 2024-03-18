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

                <form id="loanForm" action="{{ route('peminjaman.store') }}" method="post">
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
                                <label class="block text-sm font-medium mb-1" for="foto_bukti">Foto Bukti Peminjaman</label>
                                <video id="video" width="400" height="300" autoplay></video>
                                <button class="btn bg-gray-500 hover:bg-gray-600 text-white my-1" id="snap">
                                    Ambil Gambar
                                </button>
                                <canvas id="canvas" width="400" height="300" style="display:none;"></canvas>
                                <input type="hidden" id="imageInput" name="foto_bukti">
                                <img id="photo" src="#" alt="Gambar" style="display:none;">
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                                <span>Simpan</span>
                            </button>
                        </div>
                    </div>
                </form>

            </div>

        </div>

    </div>

    <script>
    // Mengambil elemen
    var video = document.getElementById('video');
    var canvas = document.getElementById('canvas');
    var photo = document.getElementById('photo');
    var snapButton = document.getElementById('snap');
    var imageInput = document.getElementById('imageInput');
    var loanForm = document.getElementById('loanForm');

    // Meminta izin akses kamera saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        navigator.mediaDevices.getUserMedia({ video: true })
        .then(function(stream) {
            video.srcObject = stream;
            video.play();
        })
        .catch(function(err) {
            console.log("Error: " + err);
        });
    });

    // Ambil gambar saat tombol ditekan
    snapButton.addEventListener('click', function() {
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        var dataURL = canvas.toDataURL('image/png');
        photo.setAttribute('src', dataURL);
        photo.style.display = 'block';
        imageInput.value = dataURL; // Set nilai input tersembunyi dengan data gambar
    });

    // Submit formulir menggunakan AJAX
    loanForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Hindari pengiriman formulir standar

        var formData = new FormData(loanForm);

        // Kirim data formulir ke server menggunakan AJAX
        fetch(loanForm.action, {
            method: loanForm.method,
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); // Tanggapan dari server
            // Handle response as needed
        })
        .catch(error => {
            console.error('Terjadi kesalahan:', error);
            // Handle errors as needed
        });
    });
    </script>
</x-app-layout>