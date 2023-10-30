<x-authentication-layout>
    @include('sweetalert::alert')
    <h1 class="text-3xl text-slate-800 font-bold mb-6">{{ __('Verifikasi email kamu') }} ✨</h1>
    <div class="text-justify">
        {{ __('Terima kasih sudah mendaftar menjadi anggota melalui web aplikasi perpustakaan SMK Negeri 1 Amuntai ini! Harap verifikasi dahulu email kamu dengan mengklik tombol verifikasi pada email yang baru saja kami kirimkan, kemudian tunggu Pustakawan memverifikasi pendaftaran kamu. Jika kamu tidak menerima email verifikasi, silahkan klik tombol kirim ulang dibawah agar kami dapat mengirim kembali email verifikasinya. Terima kasih!') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-6 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div>
                <x-jet-button type="submit">
                    {{ __('Kirim ulang email verifikasi') }}
                </x-jet-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <div class="ml-1">
                <button type="submit" class="text-sm underline hover:no-underline">
                    {{ __('Keluar') }}
                </button>
            </div>
        </form>   
    </div>
</x-authentication-layout>
