<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obat = Obat::all();
        return view('page.pegawai.obat.index', compact('obat'));
    }

    public function show($id)
    {
        $obat = Obat::findOrFail($id);
        return view('page.pegawai.obat.show', compact('obat'));
    }

    public function create()
    {
        return view('page.pegawai.obat.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_obat' => 'required',
            'kategori_obat' => 'required',
            'harga_obat' => 'required|numeric',
            'stok_obat' => 'required|numeric',
            'tanggal_exp' => 'required|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('obat', $namaFile, 'public');
            $data['foto'] = $namaFile;
        }

        Obat::create($data);

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil ditambahkan');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('page.pegawai.obat.edit', compact('obat'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_obat' => 'required',
            'kategori_obat' => 'required',
            'harga_obat' => 'required|numeric',
            'stok_obat' => 'required|numeric',
            'tanggal_exp' => 'required|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $obat = Obat::findOrFail($id);

        if ($request->hasFile('foto')) {
            // hapus foto lama kalau ada
            if ($obat->foto && file_exists(storage_path('app/public/obat/'.$obat->foto))) {
                unlink(storage_path('app/public/obat/'.$obat->foto));
            }

            $file = $request->file('foto');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('obat', $namaFile, 'public');
            $data['foto'] = $namaFile;
        }

        $obat->update($data);

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil diupdate');
    }

    public function destroy(Obat $obat)
    {
        // hapus foto juga (opsional tapi bagus)
        if ($obat->foto && file_exists(storage_path('app/public/obat/'.$obat->foto))) {
            unlink(storage_path('app/public/obat/'.$obat->foto));
        }

        $obat->delete();

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil dihapus');
    }
}
