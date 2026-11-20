@extends('layouts.app')

@section('title', 'Halo Page')

@section('content')
    <div class="container py-5">
        <div class="card text-center">
            <div class="card-body">
                <h2>{{ $pesan }}</h2>
                <p class="lead">Dikirim dari Controller pada pukul {{ $waktu }}</p>
                <a href="/" class="btn btn-primary">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
@endsection