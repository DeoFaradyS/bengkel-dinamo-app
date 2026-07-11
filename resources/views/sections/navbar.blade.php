<header class="w-full flex justify-center px-6 py-5 bg-white">
  <div class="w-full max-w-[1200px]">
    <div class="flex items-center justify-between lg:gap-14">

      <a href="/" class="flex items-center shrink-0 text-xl font-bold text-neutral-900" aria-label="Beranda">
        Budi<span class="text-red-600">Dinamo</span>
      </a>

      <!-- nav+CTA: tampil lg keatas, hilang di bawahnya -->
      <ul class="hidden lg:flex flex-1 justify-end items-center gap-12 text-sm font-semibold uppercase text-neutral-800">
        <li><a href="#" class="text-red-600">Beranda</a></li>
        <li><a href="#layanan">Layanan</a></li>
        <li><a href="#galeri">Galeri</a></li>
        <li><a href="#riwayat">Riwayat Servis</a></li>
        <li><a href="#lokasi">Lokasi</a></li>
      </ul>
      <div class="hidden lg:flex items-center gap-7">
        <a href="tel:+62812XXXXXXX" class="text-red-600 font-semibold">+62 812-XXXX-XXXX</a>
        <a href="#appointment" class="flex items-center gap-4 px-6 py-3.5 bg-neutral-800 rounded-[10px] text-white font-semibold">
          <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M13.2768 7.46427L9.3393 11.4018C9.21601 11.5251 9.0488 11.5943 8.87445 11.5943C8.7001 11.5943 8.53289 11.5251 8.40961 11.4018C8.28633 11.2785 8.21707 11.1113 8.21707 10.9369C8.21707 10.7626 8.28633 10.5954 8.40961 10.4721L11.2266 7.65622H3.1875C3.01345 7.65622 2.84653 7.58708 2.72346 7.46401C2.60039 7.34094 2.53125 7.17402 2.53125 6.99997C2.53125 6.82593 2.60039 6.65901 2.72346 6.53593C2.84653 6.41286 3.01345 6.34372 3.1875 6.34372H11.2266L8.4107 3.52622C8.28742 3.40294 8.21816 3.23573 8.21816 3.06138C8.21816 2.88703 8.28742 2.71982 8.4107 2.59654C8.53399 2.47325 8.7012 2.40399 8.87555 2.40399C9.0499 2.40399 9.21711 2.47325 9.34039 2.59654L13.2779 6.53404C13.3391 6.59509 13.3876 6.66762 13.4207 6.74748C13.4538 6.82734 13.4707 6.91294 13.4706 6.99938C13.4705 7.08582 13.4534 7.17138 13.4201 7.25116C13.3868 7.33094 13.3381 7.40337 13.2768 7.46427Z" fill="#E81C2E"/>
          </svg>
          Buat Janji
        </a>
      </div>

      <!-- hamburger: tampil di bawah lg doang -->
      <button type="button" id="menuBtn" class="lg:hidden size-11 flex items-center justify-center" aria-expanded="false" aria-controls="mobileMenu" aria-label="Buka menu">
        <span class="flex flex-col gap-[9px]">
          <span class="w-5 h-0.5 rounded-full bg-red-600"></span>
          <span class="w-5 h-0.5 rounded-full bg-red-600"></span>
        </span>
      </button>
    </div>

    <!-- isi menu mobile, sama kaya nav desktop, cuma ditumpuk vertikal -->
    <div id="mobileMenu" class="lg:hidden hidden mt-5 flex flex-col gap-5 text-sm font-semibold uppercase text-neutral-800">
      <a href="#" class="text-red-600">Beranda</a>
      <a href="#layanan">Layanan</a>
      <a href="#galeri">Galeri</a>
      <a href="#riwayat">Riwayat Servis</a>
      <a href="#lokasi">Lokasi</a>
      <a href="tel:+62812XXXXXXX" class="text-red-600">+62 812-XXXX-XXXX</a>
      <a href="#appointment" class="flex items-center justify-center gap-4 px-6 py-3.5 bg-neutral-800 rounded-[10px] text-white normal-case">
        Buat Janji
      </a>
    </div>
  </div>
</header>

<script>
  // ponytail: toggle class doang, ga perlu framework buat buka/tutup menu
  const btn = document.getElementById('menuBtn');
  const menu = document.getElementById('mobileMenu');
  btn.addEventListener('click', () => {
    const open = menu.classList.toggle('hidden') === false;
    btn.setAttribute('aria-expanded', String(open));
  });
</script>