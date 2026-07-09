<nav class="flex items-center justify-between py-4 px-10">
    <div class="text-lg font-semibold">
        {{-- ganti text jadi <img> logo lu --}}
        Nama Bengkel
    </div>

    <ul class="flex items-center gap-8 text-base text-gray-600">
        <li><a href="#beranda" class="hover:text-gray-900">Beranda</a></li>
        <li><a href="#layanan" class="hover:text-gray-900">Layanan</a></li>
        <li><a href="#galeri" class="hover:text-gray-900">Galeri</a></li>
        <li><a href="#testimoni" class="hover:text-gray-900">Testimoni</a></li>
        <li><a href="#lokasi" class="hover:text-gray-900">Lokasi</a></li>
    </ul>

    <div class="flex items-center gap-3">
        <a href="{{ route('login') }}"
            class="text-sm font-medium px-5 py-2.5 rounded-full border border-gray-200 hover:bg-gray-50">
            Masuk
        </a>
        <a href="{{ route('register') }}"
            class="bg-gray-900 text-white text-sm font-medium px-5 py-2.5 rounded-full hover:bg-gray-800">
            Daftar Sekarang
        </a>
    </div>
</nav>