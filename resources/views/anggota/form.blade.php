<div class="member-form">

    {{-- Nomor Anggota dan NIK --}}
    <div class="row g-4">

        <div class="col-md-6">
            <label for="no_anggota" class="form-label">
                Nomor Anggota <span class="text-danger">*</span>
            </label>
            <input
                type="text"
                id="no_anggota"
                name="no_anggota"
                class="form-control @error('no_anggota') is-invalid @enderror"
                value="{{ old('no_anggota', isset($anggota) ? $anggota->no_anggota : '') }}"
                maxlength="30"
                placeholder="Contoh: AGT001"
                required
            >
            @error('no_anggota')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="nik" class="form-label">
                NIK <span class="text-danger">*</span>
            </label>
            <input
                type="text"
                id="nik"
                name="nik"
                class="form-control @error('nik') is-invalid @enderror"
                value="{{ old('nik', isset($anggota) ? $anggota->nik : '') }}"
                maxlength="16"
                minlength="16"
                inputmode="numeric"
                pattern="[0-9]{16}"
                placeholder="Masukkan 16 digit NIK"
                required
            >
            @error('nik')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nama dan jenis kelamin --}}
        <div class="col-md-6">
            <label for="nama" class="form-label">
                Nama Lengkap <span class="text-danger">*</span>
            </label>
            <input
                type="text"
                id="nama"
                name="nama"
                class="form-control @error('nama') is-invalid @enderror"
                value="{{ old('nama', isset($anggota) ? $anggota->nama : '') }}"
                maxlength="150"
                placeholder="Masukkan nama lengkap"
                required
            >
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="jenis_kelamin" class="form-label">
                Jenis Kelamin <span class="text-danger">*</span>
            </label>
            <select
                id="jenis_kelamin"
                name="jenis_kelamin"
                class="form-select @error('jenis_kelamin') is-invalid @enderror"
                required
            >
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L" @selected(old('jenis_kelamin', isset($anggota) ? $anggota->jenis_kelamin : '') == 'L')>
                    Laki-laki
                </option>
                <option value="P" @selected(old('jenis_kelamin', isset($anggota) ? $anggota->jenis_kelamin : '') == 'P')>
                    Perempuan
                </option>
            </select>
            @error('jenis_kelamin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tempat dan tanggal lahir --}}
        <div class="col-md-6">
            <label for="tempat_lahir" class="form-label">
                Tempat Lahir
            </label>
            <input
                type="text"
                id="tempat_lahir"
                name="tempat_lahir"
                class="form-control @error('tempat_lahir') is-invalid @enderror"
                value="{{ old('tempat_lahir', isset($anggota) ? $anggota->tempat_lahir : '') }}"
                maxlength="100"
                placeholder="Contoh: Pekanbaru"
            >
            @error('tempat_lahir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="tanggal_lahir" class="form-label">
                Tanggal Lahir
            </label>
            <input
                type="date"
                id="tanggal_lahir"
                name="tanggal_lahir"
                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                value="{{ old('tanggal_lahir', isset($anggota) && $anggota->tanggal_lahir ? $anggota->tanggal_lahir->format('Y-m-d') : '') }}"
                max="{{ date('Y-m-d') }}"
            >
            @error('tanggal_lahir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nomor HP dan email --}}
        <div class="col-md-6">
            <label for="no_hp" class="form-label">
                Nomor HP <span class="text-danger">*</span>
            </label>
            <input
                type="tel"
                id="no_hp"
                name="no_hp"
                class="form-control @error('no_hp') is-invalid @enderror"
                value="{{ old('no_hp', isset($anggota) ? $anggota->no_hp : '') }}"
                maxlength="20"
                placeholder="Contoh: 081234567890"
                required
            >
            @error('no_hp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">
                Email
            </label>
            <input
                type="email"
                id="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', isset($anggota) ? $anggota->email : '') }}"
                maxlength="255"
                placeholder="nama@email.com"
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tanggal bergabung dan status --}}
        <div class="col-md-6">
            <label for="tanggal_bergabung" class="form-label">
                Tanggal Bergabung <span class="text-danger">*</span>
            </label>
            <input
                type="date"
                id="tanggal_bergabung"
                name="tanggal_bergabung"
                class="form-control @error('tanggal_bergabung') is-invalid @enderror"
                value="{{ old('tanggal_bergabung', isset($anggota) && $anggota->tanggal_bergabung ? $anggota->tanggal_bergabung->format('Y-m-d') : date('Y-m-d')) }}"
                max="{{ date('Y-m-d') }}"
                required
            >
            @error('tanggal_bergabung')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="status" class="form-label">
                Status Anggota <span class="text-danger">*</span>
            </label>
            <select
                id="status"
                name="status"
                class="form-select @error('status') is-invalid @enderror"
                required
            >
                <option value="aktif" @selected(old('status', isset($anggota) ? $anggota->status : 'aktif') == 'aktif')>
                    Aktif
                </option>
                <option value="nonaktif" @selected(old('status', isset($anggota) ? $anggota->status : '') == 'nonaktif')>
                    Nonaktif
                </option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Alamat --}}
        <div class="col-12">
            <label for="alamat" class="form-label">
                Alamat Lengkap <span class="text-danger">*</span>
            </label>
            <textarea
                id="alamat"
                name="alamat"
                rows="3"
                class="form-control @error('alamat') is-invalid @enderror"
                placeholder="Masukkan alamat lengkap anggota"
                required
            >{{ old('alamat', isset($anggota) ? $anggota->alamat : '') }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>

    {{-- Tombol aksi --}}
    <div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('anggota.index') }}" class="btn btn-secondary">
        Batal
    </a>

    <button type="submit" class="btn btn-primary">
        Simpan
    </button>
</div>

</div>
