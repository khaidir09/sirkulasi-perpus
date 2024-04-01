<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Page header -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Konfirmasi Pengajuan Pinjam (Booking) ✨</h1>
        </div>

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

            <form id="loanForm" action="{{ route('konfirmasi-booking', $item->id) }}" method="post">
                @csrf
                <input type="hidden" name="users_id" value="{{ $item->users_id }}">
                <input type="hidden" name="books_id" value="{{ $item->books_id }}">
                <input type="hidden" name="status" value="Belum dikembalikan">
                <input type="hidden" name="kuantitas" value="1">
                <!-- Input Types -->
                <div>
                    <div class="grid gap-5 md:grid-cols-3 mb-5">
                        <!-- Select -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Nama Anggota</label>
                            <input class="form-input w-full px-2 py-1 disabled:text-slate-400 disabled:cursor-not-allowed" type="text" value="{{ $item->nama_anggota }}" disabled />
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Judul Buku</label>
                            <input class="form-input w-full px-2 py-1 disabled:text-slate-400 disabled:cursor-not-allowed" type="text" value="{{ $item->judul_buku }}" disabled />
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Tanggal Pengambilan</label>
                            <input class="form-input w-full px-2 py-1" type="date" name="created_at" required/>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1" for="foto_bukti">Foto Bukti Peminjaman</label>
                            <video id="video" width="400" height="300" autoplay></video>
                            <button type="submit" class="btn bg-indigo-500 hover:bg-indigo-600 text-white mt-1 mb-1" id="snap">
                                Ambil Gambar & Simpan Data
                            </button>
                            <canvas id="canvas" width="400" height="300" style="display:none;"></canvas>
                            <input type="hidden" id="imageInput" name="foto_bukti">
                            <img id="photo" src="#" alt="Gambar" style="display:none;">
                        </div>
                    </div>
                </div>
            </form>

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
    </script>
</x-app-layout>