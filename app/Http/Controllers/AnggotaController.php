<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class AnggotaController extends Controller
{
    /**
     * Menampilkan daftar anggota dan fitur pencarian.
     */
    
public function index(Request $request)
{
    $keyword = trim($request->input('keyword', ''));

    $anggotas = Anggota::query()
        ->when($keyword !== '', function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%")
                    ->orWhere('no_anggota', 'like', "%{$keyword}%")
                    ->orWhere('nik', 'like', "%{$keyword}%")
                    ->orWhere('no_hp', 'like', "%{$keyword}%");
            });
        })
        ->orderByDesc('id')
        ->paginate(10)
        ->withQueryString();

    return view('anggota.index', compact('anggotas', 'keyword'));
}


    /**
     * Menampilkan formulir tambah anggota.
     */
    public function create()
    {
        return view('anggota.create');
    }

    /**
     * Menyimpan anggota baru.
     */
    public function store(Request $request)
    {
        $request->merge([
            'tanggal_bergabung' => $request->input(
                'tanggal_bergabung',
                $request->input('tanggal_gabung')
            ),
        ]);

        $validated = $request->validate([
            'no_anggota' => [
                'required', 'string', 'max:30',
                'unique:anggota,no_anggota',
            ],
            'nik' => [
                'required', 'digits:16',
                'unique:anggota,nik',
            ],
            'nama' => ['required', 'string', 'max:150'],
            'jenis_kelamin' => [
                'required', Rule::in(['L', 'P']),
            ],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => [
                'nullable', 'date', 'before_or_equal:today',
            ],
            'alamat' => ['required', 'string'],
            'no_hp' => ['required', 'string', 'max:20'],
            'email' => [
                'nullable', 'email', 'max:255',
                'unique:anggota,email',
            ],
            'tanggal_bergabung' => [
                'required', 'date', 'before_or_equal:today',
            ],
            'status' => [
                'required', Rule::in(['aktif', 'nonaktif']),
            ],
        ]);

        // Menyesuaikan nama field dengan kolom database.
        $validated['tanggal_gabung'] =
            $validated['tanggal_bergabung'];

        unset($validated['tanggal_bergabung']);

        Anggota::create($validated);

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail anggota.
     */
    public function show(Anggota $anggota)
    {
        return view('anggota.show', compact('anggota'));
    }

    /**
     * Menampilkan formulir edit anggota.
     */
    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    /**
     * Menyimpan perubahan data anggota.
     */
    public function update(Request $request, Anggota $anggota)
    {
        $request->merge([
            'tanggal_bergabung' => $request->input(
                'tanggal_bergabung',
                $request->input('tanggal_gabung')
            ),
        ]);

        $validated = $request->validate([
            'no_anggota' => [
                'required', 'string', 'max:30',
                Rule::unique('anggota', 'no_anggota')
                    ->ignore($anggota->id),
            ],
            'nik' => [
                'required', 'digits:16',
                Rule::unique('anggota', 'nik')
                    ->ignore($anggota->id),
            ],
            'nama' => ['required', 'string', 'max:150'],
            'jenis_kelamin' => [
                'required', Rule::in(['L', 'P']),
            ],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => [
                'nullable', 'date', 'before_or_equal:today',
            ],
            'alamat' => ['required', 'string'],
            'no_hp' => ['required', 'string', 'max:20'],
            'email' => [
                'nullable', 'email', 'max:255',
                Rule::unique('anggota', 'email')
                    ->ignore($anggota->id),
            ],
            'tanggal_bergabung' => [
                'required', 'date', 'before_or_equal:today',
            ],
            'status' => [
                'required', Rule::in(['aktif', 'nonaktif']),
            ],
        ]);

        $validated['tanggal_gabung'] =
            $validated['tanggal_bergabung'];

        unset($validated['tanggal_bergabung']);

        // Bagian penting: benar-benar menyimpan perubahan.
        $anggota->update($validated);

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    /**
     * Menghapus anggota yang tidak memiliki riwayat transaksi.
     */
    public function destroy(Anggota $anggota)
{
    try {
        $anggota->delete();

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Data anggota berhasil dihapus.');
    } catch (\Illuminate\Database\QueryException $e) {
        return redirect()
            ->route('anggota.index')
            ->with('error', 'Data anggota tidak dapat dihapus karena masih digunakan oleh transaksi lain.');
    }
}
}
