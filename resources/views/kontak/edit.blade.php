@extends('layouts.app')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Edit Kontak</div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ Route('kontak.update', $kontak->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control"
                                value="{{ old('nama', $kontak->nama) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" id="email" class="form-control"
                                value="{{ old('email', $kontak->email) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea name="pesan" id="pesan" class="form-control" rows="5"
                                required>{{ old('pesan', $kontak->pesan) }}</textarea>
                        </div>


                        <div class="mb-3">
                            <label for="lampiran" class="form-label">Lampiran CV (opsional)</label>

                            <input type="file" name="lampiran" id="lampiran"
                                class="form-control @error('lampiran') is-invalid @enderror">

                            @error('lampiran')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror

                            <div class="form-text">Format: PDF dan DOCX. Maks 2MB.</div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                        </div>
                        <a href="/kontak/{{ $kontak->id }}" class="mt-2 d-block text-center">← Kembali ke Detail</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection