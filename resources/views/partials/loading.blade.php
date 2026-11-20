<div id="page-loader">
    <div class="loader-box">
        <svg viewBox="0 0 200 180" width="200" height="180" aria-label="Memuat catatan">
            <!-- buku -->
            <rect x="35" y="30" width="120" height="130" rx="8" fill="#fff" stroke="#334155" stroke-width="4"/>
            <rect x="35" y="30" width="16" height="130" rx="6" fill="#334155"/>
            <!-- spiral -->
            <g fill="#94a3b8">
                <circle cx="43" cy="55" r="3"/><circle cx="43" cy="80" r="3"/>
                <circle cx="43" cy="105" r="3"/><circle cx="43" cy="130" r="3"/>
            </g>
            <!-- baris tulisan yang "tergambar" satu per satu -->
            <line class="ln l1" x1="65" y1="60"  x2="140" y2="60"  />
            <line class="ln l2" x1="65" y1="85"  x2="140" y2="85"  />
            <line class="ln l3" x1="65" y1="110" x2="115" y2="110" />
            <!-- pensil -->
            <g class="pencil">
                <polygon points="0,0 10,-6 60,-56 70,-50 20,0" fill="#fbbf24" stroke="#334155" stroke-width="3" stroke-linejoin="round" transform="translate(0,0)"/>
                <polygon points="0,0 10,-6 20,0" fill="#334155" transform="translate(0,0)"/>
            </g>
        </svg>
        <p class="loader-text">Memuat catatan<span class="dots"></span></p>
    </div>
</div>

<style>
    #page-loader {
        position: fixed; inset: 0; z-index: 9999;
        display: flex; align-items: center; justify-content: center;
        background: #f8fafc;
        transition: opacity .4s ease, visibility .4s ease;
    }
    #page-loader.hide { opacity: 0; visibility: hidden; }
    .loader-box { text-align: center; }
    .loader-text { margin-top: 8px; color: #475569; font-weight: 500; }

    /* garis tulisan muncul bergantian */
    .ln {
        stroke: #3b82f6; stroke-width: 5; stroke-linecap: round;
        stroke-dasharray: 80; stroke-dashoffset: 80;
        animation: tulis 2.4s ease-in-out infinite;
    }
    .l2 { animation-delay: .6s; }
    .l3 { animation-delay: 1.2s; }
    @keyframes tulis {
        0%   { stroke-dashoffset: 80; }
        35%  { stroke-dashoffset: 0; }
        85%  { stroke-dashoffset: 0; opacity: 1; }
        100% { stroke-dashoffset: 0; opacity: 0; }
    }

    /* pensil bergerak mengikuti baris */
    .pencil { animation: gerak 2.4s ease-in-out infinite; }
    @keyframes gerak {
        0%   { transform: translate(65px, 60px); }
        12%  { transform: translate(140px, 60px); }
        20%  { transform: translate(65px, 85px); }
        32%  { transform: translate(140px, 85px); }
        40%  { transform: translate(65px, 110px); }
        52%  { transform: translate(115px, 110px); }
        100% { transform: translate(115px, 110px); }
    }

    /* titik-titik teks */
    .dots::after { content: ''; animation: titik 1.4s steps(4) infinite; }
    @keyframes titik {
        0% { content: ''; } 25% { content: '.'; }
        50% { content: '..'; } 75% { content: '...'; }
    }
</style>

<script>
    window.addEventListener('load', function () {
        var loader = document.getElementById('page-loader');
        // minimal tampil 600ms supaya animasinya sempat terlihat
        setTimeout(function () {
            loader.classList.add('hide');
            setTimeout(function () { loader.remove(); }, 450);
        }, 600);
    });
</script>