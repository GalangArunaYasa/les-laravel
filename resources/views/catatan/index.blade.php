@extends('layouts.app')

@section('title', 'Daftar Catatan')

@section('content')
    <div class="row justify-content-between align-items-center mb-4">
        <div class="col">
            <h2 class="mb-0">Daftar Catatan</h2>
        </div>

        {{-- arsip dan tambah catatan --}}
        <div class="col-auto d-flex gap-2">
            <a href="/catatan/arsip" class="btn btn-outline-secondary">Arsip
                ({{ App\Models\Catatan::where('user_id', auth()->id())->where('is_archived', true)->count() }})</a>
            <a href="{{ Route('catatan.create') }}" class="btn btn-success">+ Tambah Baru</a>
        </div>
    </div>

    @error('ids')
        <div class="alert alert-warning py-2">{{ $message }}</div>
    @enderror

    {{-- toolbar: pencarian, pengurutan, arsip terpilih --}}
    <div class="d-flex flex-wrap align-items-center gap-2 mb-4 p-3 bg-light border rounded">

        {{-- pencarian --}}
        <form method="GET" action="/catatan" class="flex-grow-1">
            <div class="input-group">
                <input type="text" name="cari" class="form-control" placeholder="Cari judul atau isi..."
                    value="{{ request('cari') }}">
                <button class="btn btn-outline-primary" type="submit">Cari</button>
                @if(request('cari'))
                    <a href="/catatan" class="btn btn-outline-secondary">✕ Reset</a>
                @endif
            </div>
        </form>

        {{-- fitur uji coba --}}
        <form id="bulkForm" action="/catatan/arsip-massal" method="POST">
            @csrf
        </form>

        <button type="submit" form="bulkForm" class="btn btn-warning">
            Arsipkan terpilih
        </button>
        {{-- end uji coba --}}

        <form method="GET" action="/catatan">
            <input type="hidden" name="cari" value="{{ request('cari') }}">
            {{-- hidden berfungsi mempertahankan pencarian dan menambahkan pengurutan --}}
            <select name="urut" class="form-select" onchange="this.form.submit()">
                <option value="terbaru" {{ request('urut') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                <option value="terlama" {{ request('urut') == 'terlama' ? 'selected' : '' }}>Terlama</option>
            </select>
        </form>
    </div>

    @if($catatan->count() > 0)
        <div class="row">
            @foreach($catatan as $item)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">

                        {{-- fitur uji coba --}}
                        <div class="card-header d-flex justify-content-between align-items-center gap-2 bg-white">
                            <div class="form-check mb-0 text-truncate">
                                <input type="checkbox" name="ids[]" value="{{ $item->id }}" form="bulkForm"
                                    class="form-check-input" id="pilih-{{ $item->id }}">
                                <label for="pilih-{{ $item->id }}" class="form-check-label fw-semibold text-truncate">
                                    {{ $item->judul }}
                                </label>
                            </div>
                            <small class="text-muted text-nowrap">{{ $item->created_at->format('d M Y H:i') }}</small>
                        </div>
                        {{-- end uji coba --}}

                        <div class="card-body d-flex flex-column">
                            <p class="card-text flex-grow-1">{{ Str::limit($item->isi, 100) }}</p>

                            @if($item->lampiran)
                                <small class="text-muted mb-2">📎 Ada lampiran</small>
                            @endif

                            <div class="d-flex flex-wrap gap-1">
                                <a href="{{ Route('catatan.show', $item->id) }}"
                                    class="btn btn-sm btn-outline-primary">Lihat</a>
                                <a href="{{ Route('catatan.edit', $item->id) }}"
                                    class="btn btn-sm btn-outline-warning">Edit</a>

                                <form action="{{ Route('catatan.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Yakin?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            Belum ada catatan. <a href="/catatan/tambah">Buat catatan pertama!</a>
        </div>
    @endif

    <div class="d-flex justify-content-center mt-3">
        {{ $catatan->links('pagination::bootstrap-5') }}
    </div>

    <script>
        @if(session('sukses'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '{{ session('sukses') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>


@endsection