@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Surat Keluar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a
                            href="{{ url('admin/sipas/workspace') }}">Manage Surat Keluar</a></div>
            </div>
        </div>
    </div>
        @if(isset($workspace))
            {!! Form::model($workspace, ['url' => ['admin/sipas/workspace', $workspace->id], 'method' => 'PUT', 'files' => true ]) !!}
            {!! Form::hidden('id') !!}
        @else
            {!! Form::open(['url' => 'admin/sipas/workspace', 'files'=>true]) !!}
        @endif
        @csrf
        <div class="section-body">
            <h2 class="section-title">
                {{ empty($workspace) ? 'Create Surat Keluar' : 'Update Surat Keluar' }}
            </h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ empty($workspace) ? 'Add New Surat Keluar' : 'Update Surat Keluar' }}
                            </h4>
                        </div>
                        <div class="card-body">
                            @include('sipas::admin.shared.flash')
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kategori Surat</label>
                                <div class="col-sm-4">
                                {{ Form::select('kategori', $kategori, null, ['class' => 'form-control', 'id' => 'kategori', 'onchange'=>'klasifikasi_get(this)', 'readonly' ]) }}
                                    <!-- <select name="kategori" id="kategori" class="form-control"
                                            onchange="klasifikasi_get(this)" readonly>
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="HK">Hukum</option>
                                        <option value="KU">Keuangan</option>
                                        <option value="LG">Logistik</option>
                                        <option value="PR">Public Relation</option>
                                        <option value="LP">Pengolahan Data & Pelaporan</option>
                                        <option value="PD">Pendidikan & Pelatihan</option>
                                        <option value="PS">Personalia</option>
                                        <option value="UM">Umum</option>
                                        <option value="LB">Penelitian & Pengembangan</option>
                                        <option value="PW">Pengawasan</option>
                                    </select> -->
                                    <input type="hidden" name="id"
                                           value="{{ old('id', !empty($workspace) ? $workspace->id : '') }}">
                                </div>
                                @error('kategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <label class="col-sm-2 col-form-label">Klasifikasi</label>
                                <div class="col-sm-4">
                                    <select name="klasifikasi" id="klasifikasi" class="form-control" onchange=""
                                            readonly>
                                        <option value="">-- Pilih Klasifikasi --</option>
                                    </select>
                                </div>
                                @error('klasifikasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                        </div>
                        <div class="card-body">
                            @include('sipas::admin.shared.flash')
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kategori Surat</label>
                                <div class="col-sm-4">
                                    <select name="kategori" id="kategori" class="form-control"
                                            onchange="klasifikasi_get(this)" readonly>
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="HK">Hukum</option>
                                        <option value="KU">Keuangan</option>
                                        <option value="LG">Logistik</option>
                                        <option value="PR">Public Relation</option>
                                        <option value="LP">Pengolahan Data & Pelaporan</option>
                                        <option value="PD">Pendidikan & Pelatihan</option>
                                        <option value="PS">Personalia</option>
                                        <option value="UM">Umum</option>
                                        <option value="LB">Penelitian & Pengembangan</option>
                                        <option value="PW">Pengawasan</option>
                                    </select>
                                    <input type="hidden" name="id"
                                           value="{{ old('id', !empty($workspace) ? $workspace->id : '') }}">
                                </div>
                                @error('kategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <label class="col-sm-2 col-form-label">Klasifikasi</label>
                                <div class="col-sm-4">
                                    <select name="klasifikasi" id="klasifikasi" class="form-control" onchange=""
                                            readonly>
                                        <option value="">-- Pilih Klasifikasi --</option>
                                    </select>
                                </div>
                                @error('klasifikasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal Surat Keluar</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="tanggal_surat" id="tanggal_surat" class="form-control datepicker @error('tanggal_surat') is-invalid @enderror @if (!$errors->has('tanggal_surat') && old('tanggal_surat')) is-valid @endif"
                                               value="{{ old('tanggal_surat', !empty($workspace) ? $workspace->tanggal_surat : null) }}" readonly>
                                    </div>
                                </div>
                                @error('tanggal_surat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <label class="col-sm-2 col-form-label">Unit Kerja</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="unit" id ="unit" disabled>
                                        <option value=" ">
                                            {{ !empty($workspace->nama_unit) ? $workspace->nama_unit : '' }}
                                        </option>
                                    </select>
                                </div>
                                @error('unit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Dari</label>
                                <div class="col-sm-4">
                                    <input type="text" name="dari"
                                           class="form-control @error('dari') is-invalid @enderror @if (!$errors->has('dari') && old('dari')) is-valid @endif"
                                           value="{{ old('dari', !empty($workspace) ? $workspace->dari : '') }}" readonly>
                                </div>
                                @error('dari')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <label class="col-sm-2 col-form-label">Kepada</label>
                                <div class="col-sm-4">
                                    <input type="text" name="kepada"
                                           class="form-control @error('kepada') is-invalid @enderror @if (!$errors->has('kepada') && old('kepada')) is-valid @endif"
                                           value="{{ old('kepada', !empty($workspace) ? $workspace->kepada : null) }}" readonly>
                                </div>
                                @error('kepada')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Perihal</label>
                                <div class="col-sm-4">
                                    <input type="text" name="perihal"
                                           class="form-control @error('perihal') is-invalid @enderror @if (!$errors->has('perihal') && old('perihal')) is-valid @endif"
                                           value="{{ old('perihal', !empty($workspace) ? $workspace->perihal : null) }}" readonly>
                                </div>
                                @error('perihal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <label class="col-sm-2 col-form-label">Lampiran</label>
                                <div class="col-sm-4">
                                    <input type="file" name="lampiranSk" class="form-control"/>
                                </div>
                                @error('lampiranSk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-4">
                                    <textarea name="ketSk" class="form-control" style="height: 100px;" readonly>{{ !empty($workspace) ? $workspace->keterangan : null }}</textarea>
                                </div>
                                @error('ketSk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-left">
                            <button
                                    class="btn btn-primary">Receive</button>
                        </div>
                    </div>
                </div>
            </div>
        </div
        {!! Form::close() !!}
    </section>
@push('script')
<script>
       $('#kategori').trigger('change');
       $('#klasifikasi').val({{ !empty($workspace) ? $workspace->klasifikasi : '' }});
</script>
@endpush
@endsection