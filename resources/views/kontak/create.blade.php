@extends('layouts.app')

@section('title', 'Kontak Page')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">
                <div class="card shadow-sm border-0">

                    <div class="card-body text-center p-4">
                        <h2 class="card-title fw-bold">{{ $data['email'] }}</h2>
                        <p class="card-text text-muted">
                            Anda dapat menghubungi kami melalui informasi di bawah ini: {{ $data['telepon'] }}
                        </p>
                        <a href="#" onclick="alert('Page belum tersedia');" class="btn btn-success px-4">Hubungi</a>
                    </div>

                    <hr class="my-0">

                    <div class="card-body p-4">

                        {{-- @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif --}}

                        {{-- validasi error klasik--}}

                        <form method="POST" action="/kontak" enctype="multipart/form-data">
                            @csrf

                            {{-- nama --}}
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama"
                                    class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror

                            </div>

                            {{-- email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- pesan --}}
                            <div class="mb-3">
                                <label for="pesan" class="form-label">Pesan</label>
                                <textarea name="pesan" id="pesan" class="form-control @error('pesan') is-invalid @enderror"
                                    rows="5">{{ old('pesan') }}</textarea>
                                @error('pesan')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tampilkan Cv --}}
                            <div class="mb-3">
                                <label for="lampiran" class="form-label">Lampiran CV (opsional)</label>
                                <input type="file" name="lampiran" id="lampiran" class="form-control @error('lampiran')is-invalid @enderror">
                                <div class="form-text">Format: PDF, gambar, atau teks. Maks 2MB.</div>
                                  @error('lampiran')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                            <a href="{{ Route('kontak.index') }}" class="mt-2 d-block text-center">← Kembali ke Daftar</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection