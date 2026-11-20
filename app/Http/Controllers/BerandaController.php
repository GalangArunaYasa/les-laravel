<?php

namespace App\Http\Controllers;

class BerandaController extends Controller
{
    public function index()
    {

        $judul = 'Selamat Datang di Les Laravel';
        $hari = 'Hari ke-2';
        $nama = 'Galang Aruna Yasa';
        $kata = 'Tetaplah Bernafas';
        $menu = ['Beranda', 'About', 'Kontak', 'Halo'];

        return view('welcome', compact('judul', 'hari', 'nama', 'kata', 'menu'));

    }
}
