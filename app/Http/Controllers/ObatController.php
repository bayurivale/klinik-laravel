<?php

namespace App\Http\Controllers;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obat = Obat::all();
        return view('obat.index', compact('obat'));
    }

    public function create()
    {
        return view('obat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required',
            'kategori_obat' => 'required',
            'harga_obat' => 'required|numeric',
            'stok_obat' => 'required|numeric',
            'tanggal_exp' => 'required|date',
        ]);

        Obat::create($request->all());

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil ditambahkan');
    }

    public function edit(Obat $obat)
    {
        return view('obat.edit', compact('obat'));
    }

    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama_obat' => 'required',
            'kategori_obat' => 'required',
            'harga_obat' => 'required|numeric',
            'stok_obat' => 'required|numeric',
            'tanggal_exp' => 'required|date',
        ]);

        $obat->update($request->all());

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil diperbarui');
    }

    public function destroy(Obat $obat)
    {
        $obat->delete();

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil dihapus');
    }
}
