<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Catatan::where('user_id', auth()->id())
            ->where('is_archived', false);

        // fitur search
        if ($request->filled('cari')) {
            $keyword = '%'.$request->cari.'%';
            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', $keyword)
                    ->orWhere('isi', 'like', $keyword);
            });
        }

        // fitur urut
        $urut = $request->get('urut', 'terbaru'); // default: terbaru
        if ($urut == 'terlama') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }
        // Ganti get() dengan paginate(5)
        $catatan = $query->paginate(5); // 5 catatan per halaman

        return view('catatan.index', compact('catatan'));
    }

    public function create()
    {

        return view('catatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,pdf,png,txt|max:2048',
        ], [
            'judul.required' => 'Judul wajib diisi.',
            'judul.max' => 'Judul maksimal 255 karakter.',
            'isi.required' => 'Isi catatan tidak boleh kosong.',
        ]);

        $data = $request->only('judul', 'isi');
        $data['user_id'] = auth()->id();

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time().'_'.$file->hashName();
            $file->storeAs('lampiran', $filename, 'public');
            $data['lampiran'] = 'lampiran/'.$filename;
        }

        Catatan::create($data);

        return redirect('/catatan')->with('sukses', 'Catatan berhasil disimpan!');
    }

    public function show($id)
    {

        $catatan = Catatan::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return view('catatan.show', compact('catatan'));
    }

    public function edit($id)
    {
        $catatan = Catatan::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return view('catatan.edit', compact('catatan'));
    }

    public function update(Request $request, $id)
    {
        $catatan = Catatan::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,pdf,png,txt|max:2048',

        ], [
            'judul.required' => 'Judul wajib diisi.',
            'judul.max' => 'Judul maksimal 255 karakter.',
            'isi.required' => 'Isi catatan tidak boleh kosong.',
        ]);

        $data = $request->only('judul', 'isi');

        if ($request->hasFile('lampiran')) {
            if ($catatan->lampiran) {
                Storage::disk('public')->delete($catatan->lampiran);
            }
            $file = $request->file('lampiran');
            $filename = time().'_'.$file->hashName();
            $file->storeAs('lampiran', $filename, 'public');
            $data['lampiran'] = 'lampiran/'.$filename;
        }

        $catatan->update($data);

        return redirect('/catatan')->with('sukses', 'Catatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $catatan = Catatan::findOrFail($id);
        $catatan->delete();
        if ($catatan->lampiran) {
            Storage::disk('public')->delete($catatan->lampiran);
        }

        return redirect('/catatan')->with('sukses', 'Catatan berhasil dihapus!');
    }

    public function arsip(Request $request)
    {
        $query = Catatan::where('user_id', auth()->id())
            ->where('is_archived', true);

        // fitur search
        if ($request->filled('cari')) {
            $keyword = '%'.$request->cari.'%';
            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', $keyword)
                    ->orWhere('isi', 'like', $keyword);
            });
        }

        // fitur urut
        $urut = $request->get('urut', 'terbaru'); // default: terbaru
        if ($urut == 'terlama') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // // fitur bagi page
        // // Ganti get() dengan paginate(5)
        $catatan = $query->paginate(5); // 5 catatan per halaman

        return view('catatan.arsip', compact('catatan'));
    }

    public function archive($id)
    {
        $catatan = Catatan::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        $catatan->is_archived = true;
        $catatan->save();

        return redirect('/catatan')->with('sukses', 'Catatan telah diarsipkan.');
    }

    public function unarchive($id)
    {
        $catatan = Catatan::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        $catatan->is_archived = false;
        $catatan->save();

        return redirect('/catatan')->with('sukses', 'Catatan dipulihkan dari arsip.');
    }
}
