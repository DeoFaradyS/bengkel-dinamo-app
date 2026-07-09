@php
    $images = [
        'https://framerusercontent.com/images/YPveGYZbWs4GQCqpBqCPFmUZi8.webp',
        'https://framerusercontent.com/images/JpCMHCBG4lmAAjUyojskWFkLNE.webp',
        'https://framerusercontent.com/images/sBvG8y55MHQ9kjm8AtiVZmrL1c.webp',
        'https://framerusercontent.com/images/CeIg0R1oshX5yBcnzjojcKw9GW8.webp',
        'https://framerusercontent.com/images/XnQTWzpnDf36E2qyQYhzxrjtcg.webp',
    ];
@endphp

<section id="galeri" class="p-10 overflow-hidden">
    <div class="flex gap-5 w-max" style="animation: marquee 20s linear infinite;">
        @foreach ([...$images, ...$images] as $src)
            <img src="{{ $src }}" loading="lazy" alt=""
                class="h-72 w-auto rounded-3xl object-cover shrink-0" />
        @endforeach
    </div>
</section>

<style>
    @keyframes marquee {
        from { transform: translateX(0); }
        to { transform: translateX(-50%); }
    }
</style>