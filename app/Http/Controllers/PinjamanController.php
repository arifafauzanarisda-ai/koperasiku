<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class PinjamanController extends Controller
{
    /**
     * Memastikan hanya Admin yang dapat melakukan
     * persetujuan, penolakan, pencairan, dan pelunasan.
     */
    private function hanyaAdmin(): void
    {
        abort_unless(
            Auth::check() && Auth::user()->role === 'admin',
            403,
            'Anda tidak memiliki izin untuk melakukan tindakan ini.'
        );
    }

    /**
     * Menampilkan daftar pinjaman.
     */
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

        $pinjamans = $query
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('pinjaman.index', compact(
            'pinjamans',
            'keyword'
        ));
    }

    /**
     * Menampilkan formulir pengajuan pinjaman.
     */
    public function create()
    {
        $anggotas = Anggota::orderBy('nama')->get();

        return view('pinjaman.create', compact('anggotas'));
    }

    /**
     * Menyimpan pengajuan pinjaman baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'anggota_id' => [
                'required',
                'integer',
                'exists:anggota,id'
            ],
            'jumlah_pengajuan' => [
                'required',
                'numeric',
                'min:1'
            ],
            'bunga_persen' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'tenor_bulan' => [
                'required',
                'integer',
                'min:1',
                'max:600'
            ],
        ]);

        // Data awal pengajuan.
        $data['jumlah_disetujui'] = 0;
        $data['status'] = 'diajukan';

        Pinjaman::create($data);

        return redirect()
            ->route('pinjaman.index')
            ->with('success', 'Pengajuan pinjaman berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail pinjaman.
     */
    public function show($id)
    {
        $pinjaman = Pinjaman::with([
            'anggota',
            'angsurans'
        ])->findOrFail($id);

        return view('pinjaman.show', compact('pinjaman'));
    }

    /**
     * Menampilkan formulir edit pinjaman.
     */
    public function edit($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        if ($pinjaman->status !== 'diajukan') {
            return redirect()
                ->route('pinjaman.index')
                ->with('error', 'Hanya pengajuan berstatus diajukan yang dapat diedit.');
        }

        $anggotas = Anggota::orderBy('nama')->get();

        return view('pinjaman.edit', compact(
            'pinjaman',
            'anggotas'
        ));
    }

    /**
     * Memperbarui data pengajuan pinjaman.
     */
    public function update(Request $request, $id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        if ($pinjaman->status !== 'diajukan') {
            return redirect()
                ->route('pinjaman.index')
                ->with('error', 'Hanya pengajuan yang belum diproses yang dapat diedit.');
        }

        $validated = $request->validate([
            'anggota_id' => [
                'required',
                'integer',
                'exists:anggota,id'
            ],
            'jumlah_pengajuan' => [
                'required',
                'numeric',
                'min:1'
            ],
            'bunga_persen' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'tenor_bulan' => [
                'required',
                'integer',
                'min:1',
                'max:600'
            ],
        ]);

        $pinjaman->update($validated);

        return redirect()
            ->route('pinjaman.index')
            ->with('success', 'Data pengajuan pinjaman berhasil diperbarui.');
    }

    /**
     * Menyetujui pengajuan pinjaman.
     */
    public function setujui(Request $request, $id)
    {
        $this->hanyaAdmin();

        $pinjaman = Pinjaman::findOrFail($id);

        if ($pinjaman->status !== 'diajukan') {
            return back()->with('error', 'Pengajuan ini sudah diproses.');
        }

        $validated = $request->validate([
            'jumlah_disetujui' => [
                'required',
                'numeric',
                'min:1',
                'max:' . $pinjaman->jumlah_pengajuan
            ],
        ]);

        $pinjaman->update([
            'jumlah_disetujui' => $validated['jumlah_disetujui'],
            'approved_by' => Auth::id(),
            'status' => 'disetujui',
        ]);

        return redirect()
            ->route('pinjaman.index')
            ->with('success', 'Pengajuan pinjaman berhasil disetujui.');
    }

    /**
     * Menolak pengajuan pinjaman.
     */
    public function tolak($id)
    {
        $this->hanyaAdmin();

        $pinjaman = Pinjaman::findOrFail($id);

        if ($pinjaman->status !== 'diajukan') {
            return back()->with('error', 'Hanya pengajuan yang belum diproses yang dapat ditolak.');
        }

        $pinjaman->update([
            'status' => 'ditolak',
            'approved_by' => Auth::id(),
        ]);

        return redirect()
            ->route('pinjaman.index')
            ->with('success', 'Pengajuan pinjaman berhasil ditolak.');
    }

    /**
     * Mencatat pencairan dana pinjaman.
     */
    public function cairkan(Request $request, $id)
    {
        $this->hanyaAdmin();

        $pinjaman = Pinjaman::findOrFail($id);

        if ($pinjaman->status !== 'disetujui') {
            return back()->with('error', 'Hanya pinjaman yang sudah disetujui yang dapat dicairkan.');
        }

        $validated = $request->validate([
            'jumlah_pencairan' => [
                'required',
                'numeric',
                'min:0.01',
                'max:' . $pinjaman->jumlah_disetujui
            ],
        ]);

        $pinjaman->update([
            'jumlah_pencairan' => $validated['jumlah_pencairan'],
            'tanggal_pencairan' => now()->toDateString(),
            'disbursed_by' => Auth::id(),
            'status' => 'dicairkan',
        ]);

        return redirect()
            ->route('pinjaman.index')
            ->with('success', 'Pencairan dana berhasil dicatat.');
    }

    /**
     * Mengubah status pinjaman menjadi lunas.
     */
    public function lunasi($id)
    {
        $this->hanyaAdmin();

        $pinjaman = Pinjaman::findOrFail($id);

        if ($pinjaman->status !== 'dicairkan') {
            return back()->with('error', 'Hanya pinjaman yang sudah dicairkan yang dapat dilunasi.');
        }

        $pinjaman->update([
            'status' => 'lunas',
            'tanggal_pelunasan' => now()->toDateString(),
        ]);

        return redirect()
            ->route('pinjaman.index')
            ->with('success', 'Status pinjaman berhasil diubah menjadi lunas.');
    }

    /**
     * Menghapus data pinjaman.
     */
    public function destroy($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        if (!in_array($pinjaman->status, ['diajukan', 'ditolak'], true)) {
            return redirect()
                ->route('pinjaman.index')
                ->with('error', 'Pinjaman yang sudah disetujui atau dicairkan tidak dapat dihapus.');
        }

        try {
            $pinjaman->delete();

            return redirect()
                ->route('pinjaman.index')
                ->with('success', 'Data pinjaman berhasil dihapus.');

        } catch (QueryException $e) {
            return redirect()
                ->route('pinjaman.index')
                ->with('error', 'Data pinjaman tidak dapat dihapus karena masih digunakan oleh data lain.');
        }
    }
}
