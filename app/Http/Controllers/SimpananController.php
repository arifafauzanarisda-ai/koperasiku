<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SimpananController extends Controller
{
    // Menampilkan daftar simpanan dan pencarian
    public function index(Request $request)
    {
        $keyword = trim($request->input('keyword', ''));

        $simpanans = Simpanan::with('anggota')
            ->when($keyword !== '', function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('no_transaksi', 'like', "%{$keyword}%")
                        ->orWhere('jenis_simpanan', 'like', "%{$keyword}%")
                        ->orWhere('keterangan', 'like', "%{$keyword}%")
                        ->orWhereHas('anggota', function ($anggota) use ($keyword) {
                            $anggota->where('nama', 'like', "%{$keyword}%")
                                ->orWhere('no_anggota', 'like', "%{$keyword}%");
                        });
                });
            })
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('simpanan.index', compact('simpanans', 'keyword'));
    }

    // Menampilkan formulir tambah simpanan
    public function create()
    {
        $anggotas = Anggota::orderBy('nama')->get();

        return view('simpanan.create', compact('anggotas'));
    }

    // Menyimpan simpanan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'anggota_id' => ['required', 'exists:anggota,id'],
            'no_transaksi' => [
                'required',
                'string',
                'max:30',
                'unique:simpanans,no_transaksi',
            ],
            'jenis_simpanan' => [
                'required',
                Rule::in(['pokok', 'wajib', 'sukarela']),
            ],
            'jumlah' => ['required', 'numeric', 'gt:0'],
            'tanggal' => ['required', 'date', 'before_or_equal:today'],
            'keterangan' => ['nullable', 'string'],
        ]);

        Simpanan::create($validated);

        return redirect()->route('simpanan.index')
            ->with('success', 'Data simpanan berhasil ditambahkan.');
    }

    // Menampilkan detail simpanan
    public function show(Simpanan $simpanan)
    {
        $simpanan->load('anggota');

        return view('simpanan.show', compact('simpanan'));
    }

    // Menampilkan formulir edit simpanan
    public function edit(Simpanan $simpanan)
    {
        $anggotas = Anggota::orderBy('nama')->get();

        return view('simpanan.edit', compact('simpanan', 'anggotas'));
    }

    // Memperbarui simpanan
    public function update(Request $request, Simpanan $simpanan)
    {
        $validated = $request->validate([
            'anggota_id' => ['required', 'exists:anggota,id'],
            'no_transaksi' => [
                'required',
                'string',
                'max:30',
                Rule::unique('simpanans', 'no_transaksi')
                    ->ignore($simpanan->id),
            ],
            'jenis_simpanan' => [
                'required',
                Rule::in(['pokok', 'wajib', 'sukarela']),
            ],
            'jumlah' => ['required', 'numeric', 'gt:0'],
            'tanggal' => ['required', 'date', 'before_or_equal:today'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $simpanan->update($validated);

        return redirect()->route('simpanan.index')
            ->with('success', 'Data simpanan berhasil diperbarui.');
    }

    // Menghapus simpanan
    
    // Menghapus simpanan
    public function destroy(Simpanan $simpanan)
    {
        try {
            $simpanan->delete();

            return redirect()
                ->route('simpanan.index')
                ->with('success', 'Data simpanan berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()
                ->route('simpanan.index')
                ->with('error', 'Data simpanan gagal dihapus karena masih terkait dengan data lain.');
        }
    }

}
