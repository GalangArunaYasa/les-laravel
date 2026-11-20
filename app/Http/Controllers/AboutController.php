<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
        public function index(){
        $judul_laman = 'Tentang Saya';
        $deksripsi = 'Aplikasi ini dibuat untuk belajar Laravel selama 30 hari.';

        return view('about', compact('judul_laman', 'deksripsi'));
    }
}
