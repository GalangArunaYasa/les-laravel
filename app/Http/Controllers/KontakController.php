<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KontakController extends Controller
{
    public function index()
    {

        $kontak = Kontak::all();

        return view('kontak.index', compact('kontak'));
    }

    public function create()
    {
        $data = [
            'email' => 'Garuna@gmail.com',
            'telepon' => '0895-3266-30712',
        ];

        return view('kontak.create', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'email' => 'required|email|unique:kontak,email',
            'pesan' => 'required',
            'lampiran' => 'nullable|mimes:pdf,docx|max:2048',
        ], [
            'judul.required' => 'Judul wajib diisi.',
            'judul.max' => 'Judul maksimal 255 karakter.',
            'isi.required' => 'Isi catatan tidak boleh kosong.',
            'lampiran.mimes' => 'Format lampiran hanya boleh JPG,DOCX',
            'lampiran.max' => 'Ukuran lampiran maksimal 2 MB.',
        ]);
        $data = $request->only('nama', 'email', 'pesan');

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time().'_'.$file->hashName();
            $file->storeAs('kontak', $filename, 'public');
            $data['lampiran'] = 'kontak/'.$filename;
        }

        Kontak::create($data);

        return redirect('/kontak')->with('sukses', 'Pesan berhasil dikirim!');

    }

    public function edit($id)
    {
        $kontak = Kontak::findOrFail($id);

        return view('kontak.edit', compact('kontak'));
    }

    public function update(Request $request, $id)
    {
        $kontak = Kontak::findOrFail($id);

        $request->validate([
            'nama' => 'required|max:100',
            'email' => 'required|email|unique:kontak,email,'.$kontak->id.',id', // fungsinya adalah untuk jika ingin mengedit jika emailnya punya dia sendiri
            'pesan' => 'required',
            'lampiran' => 'nullable|mimes:docx,pdf|max:2048',

        ], [
            'nama.required' => 'Nama Harus diisi',
            'nama.max' => 'Nama Maksimal hanya 100',
            'email.required' => 'email Harus diisi',
            'email.email' => 'Harus berupa email',
            'email.unique' => 'Harus sudah terdaftar',
            'pesan.required' => 'Pesan Wajib diisi',
            'lampiran.mimes' => 'Format lampiran hanya boleh JPG,DOCX',
            'lampiran.max' => 'Ukuran lampiran maksimal 2 MB.',
        ]);

        $data = $request->only('nama', 'email', 'pesan');

        if ($request->hasFile('lampiran')) {
            if ($request->file('file_kontak')) {
                Storage::disk('public')->delete($kontak->lampiran);
            }
            $file = $request->file('lampiran');
            $filename = time().'_'.$file->hashName();
            $file->storeAs('kontak', $filename, 'public');
            $data['lampiran'] = 'kontak/'.$filename;
        }

        $kontak->update($data);

        return redirect("/kontak/{$id}")->with('sukses', 'Pesan berhasil diperbarui!');
    }

    public function show($id)
    {
        $kontak = Kontak::findOrFail($id);

        return view('kontak.show', compact('kontak'));
    }

    public function destroy($id)
    {
        $kontak = Kontak::findOrFail($id);
        $kontak->delete();

        return redirect('/kontak')->with('hapus', 'Pesan berhasil dihapus!');
    }
}
