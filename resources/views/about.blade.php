@extends('layouts.app')
@section('title', 'About Page')


@section('content')
    <div class="container py-5">
        <div class="card text-center">
            <div class="card-body">
                <h2 class="card-title">{{ $judul_laman }}</h2>
                <p class="card-text">{{ $deksripsi }}</p>
                <a href="/" class="btn btn-primary">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
@endsection