@extends('layouts.app')

@section('title', 'Daftar Catatan')

@section('content')
    <div class="row justify-content-between mb-3">
        <div class="col">
            <h2>Daftar Catatan</h2>
        </div>
        <div class="col-auto">
            <a href="/catatan/arsip" class="btn btn-outline-secondary me-2">Arsip
                ({{ App\Models\Catatan::where('user_id', auth()->id())->where('is_archived', true)->count() }})</a>
            <a href="{{ Route('catatan.create') }}" class="btn btn-success">+ Tambah Baru</a>
        </div>

        <form method="GET" action="/catatan" class="mb-4">
            <div class="input-group">
                <input type="text" name="cari" class="form-control" placeholder="Cari judul atau isi catatan..."
                    value="{{ request('cari') }}">
                <button class="btn btn-outline-primary" type="submit">Cari</button>
                @if(request('cari'))
                    <a href="/catatan" class="btn btn-outline-secondary">✕ Reset</a>
                @endif
            </div>
        </form>
    </div>

    @if($catatan->count() > 0)
        <div class="row">
            @foreach($catatan as $item)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">
                            {{ $item->judul }}
                            <small class="text-muted float-end">{{ $item->created_at->format('d M Y H:i') }}</small>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ Str::limit($item->isi, 100) }}</p>

                            @if($item->lampiran)
                                <small class="text-muted">📎 Ada lampiran</small>
                            @endif

                            <a href="{{ Route('catatan.show', $item->id) }}" class="btn btn-sm btn-outline-primary">Lihat</a>
                            <a href="{{ Route('catatan.edit', $item->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>

                            <form action="{{ Route('catatan.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Yakin?')">Hapus</button>
                            </form>
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