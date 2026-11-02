
<div class="member-form">

    <div class="member-form-grid">

        {{-- Nama Anggota --}}
        <div class="member-field">
            <label for="anggota_id">
                Nama Anggota <span>*</span>
            </label>

            <select
                id="anggota_id"
                name="anggota_id"
                required
                class="@error('anggota_id') is-invalid @enderror"
            >
                <option value="">-- Pilih Anggota --</option>

                @foreach ($anggotas as $anggota)
                    <option
                        value="{{ $anggota->id }}"
                        @selected(old('anggota_id', isset($simpanan) ? $simpanan->anggota_id : '') == $anggota->id)
                    >
                        {{ $anggota->no_anggota }} - {{ $anggota->nama }}
                    </option>
                @endforeach
            </select>

            @error('anggota_id')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

        {{-- Nomor Transaksi --}}
        <div class="member-field">
            <label for="no_transaksi">
                Nomor Transaksi <span>*</span>
            </label>

            <input
                type="text"
                id="no_transaksi"
                name="no_transaksi"
                value="{{ old('no_transaksi', $simpanan->no_transaksi ?? '') }}"
                maxlength="50"
                placeholder="Contoh: SMP001"
                required
                class="@error('no_transaksi') is-invalid @enderror"
            >

            @error('no_transaksi')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

        {{-- Jenis Simpanan --}}
        <div class="member-field">
            <label for="jenis_simpanan">
                Jenis Simpanan <span>*</span>
            </label>

            <select
                id="jenis_simpanan"
                name="jenis_simpanan"
                required
                class="@error('jenis_simpanan') is-invalid @enderror"
            >
                <option value="">-- Pilih Jenis Simpanan --</option>

                <option value="pokok"
                    @selected(old('jenis_simpanan', $simpanan->jenis_simpanan ?? '') == 'pokok')>
                    Simpanan Pokok
                </option>

                <option value="wajib"
                    @selected(old('jenis_simpanan', $simpanan->jenis_simpanan ?? '') == 'wajib')>
                    Simpanan Wajib
                </option>

                <option value="sukarela"
                    @selected(old('jenis_simpanan', $simpanan->jenis_simpanan ?? '') == 'sukarela')>
                    Simpanan Sukarela
                </option>
            </select>

            @error('jenis_simpanan')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

        {{-- Jumlah --}}
        <div class="member-field">
            <label for="jumlah">
                Jumlah Simpanan (Rp) <span>*</span>
            </label>

            <input
                type="number"
                id="jumlah"
                name="jumlah"
                value="{{ old('jumlah', $simpanan->jumlah ?? '') }}"
                min="1"
                step="1"
                placeholder="Contoh: 100000"
                required
                class="@error('jumlah') is-invalid @enderror"
            >

            @error('jumlah')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

        {{-- Tanggal --}}
        <div class="member-field">
            <label for="tanggal">
                Tanggal Simpanan <span>*</span>
            </label>

            <input
                type="date"
                id="tanggal"
                name="tanggal"
                value="{{ old('tanggal', isset($simpanan) && $simpanan->tanggal ? \Illuminate\Support\Carbon::parse($simpanan->tanggal)->format('Y-m-d') : date('Y-m-d')) }}"
                max="{{ date('Y-m-d') }}"
                required
                class="@error('tanggal') is-invalid @enderror"
            >

            @error('tanggal')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

        {{-- Keterangan --}}
        <div class="member-field member-field-full">
            <label for="keterangan">
                Keterangan
            </label>

            <textarea
                id="keterangan"
                name="keterangan"
                rows="4"
                placeholder="Masukkan keterangan tambahan jika diperlukan"
                class="@error('keterangan') is-invalid @enderror"
            >{{ old('keterangan', $simpanan->keterangan ?? '') }}</textarea>

            @error('keterangan')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

    </div>

    {{-- Tombol --}}
    <div class="member-form-actions">

        <a href="{{ route('simpanan.index') }}"
           class="btn-member-cancel">
            Batal
        </a>

        <button
            type="submit"
            class="btn-member-save"
            @disabled($anggotas->isEmpty())
        >
            Simpan Simpanan
        </button>

    </div>

    @if ($anggotas->isEmpty())
        <div class="alert alert-danger mt-3">
            Belum ada data anggota. Silakan tambahkan anggota terlebih dahulu.
        </div>
    @endif

</div>
