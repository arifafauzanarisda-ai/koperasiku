<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AngsuranController extends Controller
{
    public function index(Request $request)
{
    $keyword = trim($request->input('keyword', ''));

    $angsurans = Angsuran::with('pinjaman')
        ->when($keyword !== '', function ($query) use ($keyword) {
            $query->where('status', 'like', "%{$keyword}%")
                ->orWhere('angsuran_ke', 'like', "%{$keyword}%");
        })
        ->latest('id')
        ->paginate(10)
        ->withQueryString();

    return view('angsuran.index', compact('angsurans', 'keyword'));
}

    public function create()
    {
        $pinjamans = Pinjaman::with('anggota')->latest('id')->get();

        return view('angsuran.create', compact('pinjamans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pinjaman_id' => ['required', 'exists:pinjamen,id'],
            'angsuran_ke' => ['required', 'integer', 'min:1'],
            'jumlah_angsuran' => ['required', 'numeric', 'gt:0'],
            'denda' => ['nullable', 'numeric', 'min:0'],
            'tanggal_jatuh_tempo' => ['required', 'date'],
            'tanggal_bayar' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['belum_bayar', 'lunas'])],
        ]);

        $validated['denda'] = $validated['denda'] ?? 0;

        if ($validated['status'] === 'belum_bayar') {
            $validated['tanggal_bayar'] = null;
        }

        Angsuran::create($validated);

        return redirect()->route('angsuran.index')
            ->with('success', 'Data angsuran berhasil ditambahkan.');
    }

    public function show(Angsuran $angsuran)
    {
        $angsuran->load('pinjaman.anggota');

        return view('angsuran.show', compact('angsuran'));
    }

    public function edit(Angsuran $angsuran)
    {
        $pinjamans = Pinjaman::with('anggota')->latest('id')->get();

        return view('angsuran.edit', compact('angsuran', 'pinjamans'));
    }

    public function update(Request $request, Angsuran $angsuran)
    {
        $validated = $request->validate([
            'pinjaman_id' => ['required', 'exists:pinjamen,id'],
            'angsuran_ke' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('angsurans', 'angsuran_ke')
                    ->where('pinjaman_id', $request->pinjaman_id)
                    ->ignore($angsuran->id),
            ],
            'jumlah_angsuran' => ['required', 'numeric', 'gt:0'],
            'denda' => ['nullable', 'numeric', 'min:0'],
            'tanggal_jatuh_tempo' => ['required', 'date'],
            'tanggal_bayar' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['belum_bayar', 'lunas'])],
        ]);

        $validated['denda'] = $validated['denda'] ?? 0;

        if ($validated['status'] === 'belum_bayar') {
            $validated['tanggal_bayar'] = null;
        }

        $angsuran->update($validated);

        return redirect()->route('angsuran.index')
            ->with('success', 'Data angsuran berhasil diperbarui.');
    }

    public function destroy(Angsuran $angsuran)
    {
        $angsuran->delete();

        return redirect()->route('angsuran.index')
            ->with('success', 'Data angsuran berhasil dihapus.');
    }
}
