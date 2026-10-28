<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PinjamanController extends Controller
{
    // Menampilkan daftar pinjaman
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Pinjaman::with('anggota');

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('status', 'like', '%' . $keyword . '%')
                    ->orWhereHas('anggota', function ($anggota) use ($keyword) {
                        $anggota->where('nama', 'like', '%' . $keyword . '%');
                    });
            });
        }

        $pinjamans = $query->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('pinjaman.index', [
            'pinjamans' => $pinjamans,
            'keyword' => $keyword,
        ]);
    }

    // Form tambah pinjaman
    public function create()
    {
        $anggotas = Anggota::orderBy('nama')->get();

        return view('pinjaman.create', compact('anggotas'));
    }

    // Menyimpan pinjaman baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'anggota_id' => ['required', 'integer', 'exists:anggota,id'],
            'jumlah_pengajuan' => ['required', 'numeric', 'min:1'],
            'jumlah_disetujui' => ['nullable', 'numeric', 'min:0'],
            'bunga_persen' => ['required', 'numeric', 'min:0', 'max:100'],
            'tenor_bulan' => ['required', 'integer', 'min:1', 'max:600'],
            'status' => ['required', 'in:diajukan,disetujui,ditolak,berjalan,lunas'],
        ]);

        // Pengajuan baru belum memiliki jumlah yang disetujui.
        $data['jumlah_disetujui'] = $data['jumlah_disetujui'] ?? 0;

        // Simpan data pinjaman ke database.
        Pinjaman::create($data);

        return redirect()
            ->route('pinjaman.index')
            ->with('success', 'Data pinjaman berhasil ditambahkan.');
    }

   
    // Menampilkan detail pinjaman
    public function show($id)
    {
        $pinjaman = Pinjaman::with('anggota')->findOrFail($id);

        return view('pinjaman.show', compact('pinjaman'));
    }

    // Menampilkan formulir edit pinjaman
    
public function edit($id)
{
    $pinjaman = Pinjaman::findOrFail($id);
    $anggotas = Anggota::orderBy('nama')->get();

    return view('pinjaman.edit', compact('pinjaman', 'anggotas'));
}

public function update(Request $request, $id)
{
    $pinjaman = Pinjaman::findOrFail($id);

    $validated = $request->validate([
        'anggota_id' => 'required|exists:anggota,id',
        'jumlah_pengajuan' => 'required|numeric|min:1',
        'jumlah_disetujui' => 'nullable|numeric|min:0',
        'bunga_persen' => 'required|numeric|min:0|max:100',
        'tenor_bulan' => 'required|integer|min:1|max:600',
        'status' => 'required|in:diajukan,disetujui,ditolak,berjalan,lunas',
    ]);

    $validated['jumlah_disetujui'] =
        $validated['jumlah_disetujui'] ?? 0;

    $pinjaman->update($validated);

    return redirect()
        ->route('pinjaman.index')
        ->with('success', 'Data pinjaman berhasil diperbarui.');
}


    // Menghapus pinjaman
    
public function destroy($id)
{
    $pinjaman = Pinjaman::findOrFail($id);

    try {
        $pinjaman->delete();

        return redirect()
            ->route('pinjaman.index')
            ->with('success', 'Data pinjaman berhasil dihapus.');
    } catch (\Illuminate\Database\QueryException $e) {
        return redirect()
            ->route('pinjaman.index')
            ->with(
                'error',
                'Data pinjaman tidak dapat dihapus karena masih digunakan oleh data lain.'
            );
    }
}

}
