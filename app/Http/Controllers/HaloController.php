<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function Laravel\Prompts\alert;

class HaloController extends Controller
{
    public function index(){

        $pesan = 'Halo, Dunia! Hari ke-2 belajar Laravel — ini halaman view pertamaku!';
        $waktu = now()->format('H:i:s');


        return view('halo', compact('pesan', 'waktu'));
    }
}
