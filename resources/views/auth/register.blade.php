<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Daftar Anggota | Perpus SMKN 1 Amuntai</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-slate-100 text-slate-600 tracking-tight">
        <!-- Page wrapper -->
        <div class="flex flex-col min-h-screen overflow-hidden">
        
            <!-- Site header -->
            <header class="absolute w-full z-30">
                <div class="max-w-6xl mx-auto px-4 sm:px-6">
                    <div class="flex items-center justify-between h-16 md:h-20">
        
                        <!-- Site branding -->
                        <div class="shrink-0 mr-4">
                            <!-- Logo -->
                            <a class="block" href="{{ route('home') }}" aria-label="Cruip">
                                <img src="{{ asset('images/logo.png') }}" alt="">
                            </a>
                        </div>
        
                    </div>
                </div>
            </header>

            <main class="grow">

                <section class="relative">
                
                    <div class="relative max-w-6xl mx-auto px-4 sm:px-6">
                        <div class="pt-32 pb-12 md:pt-40 md:pb-20">

                            <div class="lg:flex lg:space-x-20">

                                <!-- Left side -->
                                <div class="grow lg:mt-20 mb-12 lg:mb-0 flex flex-col items-center lg:items-start">
                                    <!-- Avatars -->
                                    <div class="flex -space-x-3 -ml-0.5 mb-6">
                                        <img class="rounded-full border-2 border-slate-900 box-content" src="./images/avatar-01.jpg" width="40" height="40" alt="Avatar 01" />
                                        <img class="rounded-full border-2 border-slate-900 box-content" src="./images/avatar-02.jpg" width="40" height="40" alt="Avatar 02" />
                                        <img class="rounded-full border-2 border-slate-900 box-content" src="./images/avatar-03.jpg" width="40" height="40" alt="Avatar 03" />
                                        <img class="rounded-full border-2 border-slate-900 box-content" src="./images/avatar-04.jpg" width="40" height="40" alt="Avatar 04" />
                                    </div>
                                    <!-- Headline -->
                                    <h1 class="h2 font-hkgrotesk mb-8 text-center lg:text-left">Buat akun untuk dapat mengakses program sirkulasi perpustakaan SMK Negeri 1 Amuntai</h1>
                                    <!-- List -->
                                    <ul class="inline-flex flex-col text-lg text-slate-700 space-y-3">
                                        <li class="flex items-center">
                                            <svg class="w-3 h-3 fill-current text-emerald-500 mr-3 shrink-0" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.28 2.28L3.989 8.575 1.695 6.28A1 1 0 00.28 7.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 2.28z" />
                                            </svg>
                                            <span>Dapat melihat daftar buku yang tersedia.</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="w-3 h-3 fill-current text-emerald-500 mr-3 shrink-0" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.28 2.28L3.989 8.575 1.695 6.28A1 1 0 00.28 7.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 2.28z" />
                                            </svg>
                                            <span>Bisa mengajukan buku yang dibutuhkan.</span>
                                        </li>
                                    </ul>
                                </div>
                                
                                <!-- Right side -->
                                <div class="relative w-full max-w-md mx-auto">
                                    
                                    <!-- Bg gradient -->
                                    <div class="absolute inset-0 bg-white -z-10" aria-hidden="true"></div>
                                    
                                    <div class="p-6 md:p-8">
                                        <div class="font-hkgrotesk text-xl font-bold mb-6">Isi Formulir Pendaftaran</div>

                                        <!-- Form -->
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="space-y-4">
                                                <div>
                                                    <label class="block text-sm text-slate-600 font-medium mb-1" for="name">Nama Lengkap <span class="text-rose-500">*</span></label>
                                                    <input id="name" name="name" :value="old('name')" class="form-input text-sm py-2 w-full" type="name" required autocomplete="name" />
                                                </div>
                                                <div>
                                                    <label class="block text-sm text-slate-600 font-medium mb-1" for="alamat">Alamat <span class="text-rose-500">*</span></label>
                                                    <input id="alamat" name="alamat" class="form-input text-sm py-2 w-full" type="text" required />
                                                </div>
                                                <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                                                    <div class="sm:w-1/2">
                                                        <label class="block text-sm text-slate-600 font-medium mb-1" for="tempat_lahir">Tempat Lahir <span class="text-rose-500">*</span></label>
                                                        <input id="tempat_lahir" name="tempat_lahir" class="form-input text-sm py-2 w-full" type="text" required />
                                                    </div>
                                                    <div class="sm:w-1/2">
                                                        <label class="block text-sm text-slate-600 font-medium mb-1" for="tgl_lahir">Tanggal Lahir <span class="text-rose-500">*</span></label>
                                                        <input id="tgl_lahir" name="tgl_lahir" class="form-input text-sm py-2 w-full" type="date" required />
                                                    </div>
                                                </div>
                                                <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                                                    <div class="sm:w-1/2">
                                                        <label class="block text-sm text-slate-600 font-medium mb-1" for="nomor_hp">Nomor HP/WA <span class="text-rose-500">*</span></label>
                                                        <input id="nomor_hp" name="nomor_hp" class="form-input text-sm py-2 w-full" type="number" required />
                                                    </div>
                                                    <div class="sm:w-1/2">
                                                        <label class="block text-sm text-slate-600 font-medium mb-1" for="nomor_hp_ortu">Nomor HP Ortu <span class="text-rose-500">*</span></label>
                                                        <input id="nomor_hp_ortu" name="nomor_hp_ortu" class="form-input text-sm py-2 w-full" type="number" required />
                                                    </div>
                                                </div>
                                                <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                                                    <div class="sm:w-1/2">
                                                        <label class="block text-sm text-slate-600 font-medium mb-1" for="competencies_id">Jurusan <span class="text-rose-500">*</span></label>
                                                        <select id="competencies_id" name="competencies_id" class="form-select text-sm py-2 w-full" required>
                                                            <option>Pilih Jurusan</option>
                                                            @foreach ($competencies as $competency)
                                                                <option value="{{ $competency->id }}">{{ $competency->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="sm:w-1/2">
                                                        <label class="block text-sm text-slate-600 font-medium mb-1" for="class_rooms_id">Kelas <span class="text-rose-500">*</span></label>
                                                        <select id="class_rooms_id" name="class_rooms_id" class="form-select text-sm py-2 w-full" required>
                                                            <option>Pilih Kelas</option>
                                                            @foreach ($classrooms as $classroom)
                                                                <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block text-sm text-slate-600 font-medium mb-1" for="nama_ibu">Nama Ibu <span class="text-rose-500">*</span></label>
                                                    <input id="nama_ibu" name="nama_ibu" class="form-input text-sm py-2 w-full" type="name" required />
                                                </div>
                                                <div>
                                                    <label class="block text-sm text-slate-600 font-medium mb-1" for="email">Email <span class="text-rose-500">*</span></label>
                                                    <input id="email" name="email" class="form-input text-sm py-2 w-full" type="email" required />
                                                </div>
                                                <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                                                    <div class="sm:w-1/2">
                                                        <label class="block text-sm text-slate-600 font-medium mb-1" for="password">Kata Sandi <span class="text-rose-500">*</span></label>
                                                        <input id="password" name="password" class="form-input text-sm py-2 w-full" type="password" required autocomplete="new-password" />
                                                    </div>
                                                    <div class="sm:w-1/2">
                                                        <label class="block text-sm text-slate-600 font-medium mb-1" for="password_confirmation">Konfirmasi Kata Sandi <span class="text-rose-500">*</span></label>
                                                        <input id="password_confirmation" name="password_confirmation" class="form-input text-sm py-2 w-full" type="password" required autocomplete="new-password" />
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="flex items-center">
                                                        <input type="checkbox" class="form-checkbox" id="perjanjian" name="perjanjian" value="Bersedia Menerima Perjanjian" required />
                                                        <span class="text-sm ml-2">Saya berjanji memenuhi segala peraturan yang berlaku dan bersedia menerima sanksi jika melanggar</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mt-6">
                                                <button class="btn-sm text-sm text-white bg-indigo-500 hover:bg-indigo-600 w-full shadow-sm group">
                                                    Daftar <span class="tracking-normal text-sky-300 group-hover:translate-x-0.5 transition-transform duration-150 ease-in-out ml-1">-&gt;</span>
                                                </button>
                                            </div>
                                            <x-jet-validation-errors class="mt-4" />  
                                        </form>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </section>

            </main>

        </div>
        
        <script src="./js/vendors/alpinejs.min.js" defer></script>
        <script src="./js/vendors/aos.js"></script>
        <script src="./js/main.js"></script>

    </body>
</html>