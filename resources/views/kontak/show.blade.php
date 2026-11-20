@extends('layouts.app')
@section('title', $kontak->nama)
@section('content')

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ $kontak->email }}</span>
                    <small class="text-muted">{{ $kontak->created_at->format('d F Y, H:i') }}</small>
                </div>
                <div class="card-body">
                    <p class="card-text">Dari: <span>{{ $kontak->nama }}</span><br>{!! nl2br(e($kontak->pesan)) !!}</p>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ Route('kontak.edit', $kontak->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ Route('kontak.index') }}" class="btn btn-secondary">← Kembali</a>
                    {{-- <a href="/{{ $catatan->id }}/edit" class="btn btn-warning">Edit</a> --}}
                    <form action="{{ Route('kontak.destroy', $kontak->id) }}" method="POST" class="d-inline form-delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
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
        </div>
    </div>

@endsection