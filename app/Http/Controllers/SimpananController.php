<?php

namespace App\Http\Controllers;

use App\Models\Simpan;
use App\Models\Anggota;
use Illuminate\Http\Request;

class SimpananController extends Controller
{
    public function index()
    {
        $simpans = Simpan::with('anggota')
            ->latest()
            ->paginate(10);

        return view('simpanan.index', compact('simpans'));
    }

    public function create()
    {
        $anggotas = Anggota::all();

        return view('simpanan.create', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'jenis' => 'required|in:pokok,wajib,sukarela',
            'nominal' => 'required|numeric|min:1',
            'tanggal_transaksi' => 'required|date',
            'status' => 'required|in:pending,berhasil',
        ]);

        Simpan::create($validated);

        return redirect()->route('simpanan.index')
            ->with('success', 'Data simpanan berhasil ditambahkan.');
    }

    public function show(Simpan $simpan)
    {
        return view('simpanan.show', compact('simpan'));
    }

    public function edit(Simpan $simpan)
    {
        $anggotas = Anggota::all();

        return view('simpanan.edit', compact('simpan', 'anggotas'));
    }

    public function update(Request $request, Simpan $simpan)
    {
        $validated = $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'jenis' => 'required|in:pokok,wajib,sukarela',
            'nominal' => 'required|numeric|min:1',
            'tanggal_transaksi' => 'required|date',
            'status' => 'required|in:pending,berhasil',
        ]);

        $simpan->update($validated);

        return redirect()->route('simpanan.index')
            ->with('success', 'Data simpanan berhasil diperbarui.');
    }

    public function destroy(Simpan $simpan)
    {
        $simpan->delete();

        return redirect()->route('simpanan.index')
            ->with('success', 'Data simpanan berhasil dihapus.');
    }
}