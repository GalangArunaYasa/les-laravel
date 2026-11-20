@extends('layouts.app')

@section('title', 'Daftar Kontak')

@section('content')
    <div class="row justify-content-between mb-3">
        <div class="col">
            <h2>Daftar Kontak</h2>
        </div>
        <div class="col-auto">
            <a href="{{ Route('kontak.create') }}" class="btn btn-success">+ Tambah Baru</a>
        </div>
    </div>

    @if($kontak->count() > 0)
        <div class="row">
            @foreach($kontak as $item)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">
                            {{ $item->nama }}
                            <small class="text-muted float-end">{{ $item->created_at->format('d M Y H:i') }}</small>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ Str::limit($item->pesan, 100) }}</p>
                            <p class="card-text"><strong>Email:</strong> {{ $item->email }}</p>
                            <a href="/kontak/{{ $item->id }}" class="btn btn-sm btn-outline-primary">Lihat</a>
                            <a href="{{ Route('kontak.edit', $item->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>

                            <form action="{{ Route('kontak.destroy', $item->id) }}" method="POST" class="d-inline form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            Belum ada catatan. <a href="/kontak/add">Buat Pesan pertama!</a>
        </div>
    @endif
    <script>
        document.querySelectorAll('.form-delete').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: 'Data yang dihapus tidak dapat dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: '{{ session('sukses') }}',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                });
            });
        });
    </script>
@endsection