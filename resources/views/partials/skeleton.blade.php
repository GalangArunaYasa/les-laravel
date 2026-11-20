<div id="skeleton-catatan" aria-hidden="true">
    <div class="row">
        @for ($i = 0; $i < 6; $i++)
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span class="sk sk-judul"></span>
                        <span class="sk sk-tanggal"></span>
                    </div>
                    <div class="card-body">
                        <span class="sk sk-baris"></span>
                        <span class="sk sk-baris" style="width: 85%"></span>
                        <span class="sk sk-baris" style="width: 60%"></span>
                        <div class="mt-3">
                            <span class="sk sk-tombol"></span>
                            <span class="sk sk-tombol"></span>
                            <span class="sk sk-tombol"></span>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>

<style>
    .sk {
        display: block;
        height: 14px;
        margin-bottom: 10px;
        border-radius: 6px;
        background: linear-gradient(90deg, #e9ecef 25%, #f8f9fa 50%, #e9ecef 75%);
        background-size: 200% 100%;
        animation: shimmer 1.4s infinite linear;
    }
    .sk-judul   { width: 40%; margin-bottom: 0; }
    .sk-tanggal { width: 22%; margin-bottom: 0; height: 10px; align-self: center; }
    .sk-baris   { width: 100%; }
    .sk-tombol  { display: inline-block; width: 55px; height: 28px; margin: 0 6px 0 0; border-radius: 4px; }

    @keyframes shimmer {
        0%   { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
</style>