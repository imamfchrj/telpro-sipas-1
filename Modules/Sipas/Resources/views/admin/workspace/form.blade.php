@extends('layouts.dashboard')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Manage Surat Keluar</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a
                    href="{{ url('admin/sipas/suratkeluar') }}">Manage Surat Keluar</a></div>
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
>>>>>>> Stashed changes
                            </div>
                            @enderror

                            <label class="col-sm-2 col-form-label">Klasifikasi</label>
                            <div class="col-sm-4">
                                <select name="klasifikasiSk" id="klasifikasiSk" class="form-control" onchange="" required>
                                    <option value="">- Pilih -</option>
                                </select>
                            </div>
                            @error('klasifikasiSk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tanggal Surat Keluar</label>
                            <div class="col-sm-4">
                                <input type="text" name="tanggalSk" id="tanggalSk" class="form-control datepicker" autocomplete="off">
                            </div>
                            @error('tanggalSk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                            <label class="col-sm-2 col-form-label">Unit Kerja</label>
                            <div class="col-sm-4">
                                {{--<select name="unitSk" id="unitSk" class="form-control">--}}
                                    {{--<option value="">- Pilih -</option>--}}
                                    {{--<option value="GSD-070">General Manager Area VII</option>--}}
                                    {{--<option value="GSD-071">Business Support Manager</option>--}}
                                    {{--<option value="GSD-072">Marketing and Project Management Manager</option>--}}
                                    {{--<option value="GSD-073">Operation Manager</option>--}}
                                    {{--<option value="GSD-074">Facility/Building Manager</option>--}}
                                {{--</select>--}}
                                {!! Form::select('unitSk', $unit, !empty($suratkeluar->unit_kerja) ? $suratkeluar->unit_kerja :
                                old('unitSk'), ['class' => 'form-control', 'placeholder' => '-- Pilih --']) !!}
                            </div>
                            @error('unitSk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Dari</label>
                            <div class="col-sm-4">
                                <input type="text" name="dariSk" id="dariSk" class="form-control" autocomplete="off">
                            </div>
                            @error('dariSk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                            <label class="col-sm-2 col-form-label">Kepada</label>
                            <div class="col-sm-4">
                                <input type="text" name="kepadaSk" id="kepadaSk" class="form-control" autocomplete="off">
                            </div>
                            @error('kepadaSk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Perihal</label>
                            <div class="col-sm-4">
                                <input type="text" name="perihalSk" id="perihalSk" class="form-control" autocomplete="off">
                            </div>
                            @error('perihalSk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label class="col-sm-2 col-form-label">Lampiran</label>
                            <div class="col-sm-4">
                                {{--@if (!empty($pengajuan) && $pengajuan->featured_image)--}}
                                {{--<img src="{{ $pengajuan->featured_image }}"--}}
                                {{--alt="{{ $pengajuan->featured_image_caption }}" class="img-fluid img-thumbnail" />--}}
                                {{--@endif--}}
                                <input type="file" name="lampiranSk" class="form-control" />
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
                                <textarea name="ketSk" class="form-control" style="height: 100px;"></textarea>
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
                                class="btn btn-primary">{{ empty($suratkeluar) ? 'Create' : 'Update' }}</button>
                    </div>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </section>
@push('script')
<script>
       $('#kategori').trigger('change');
       $('#klasifikasi').val({{ !empty($workspace) ? $workspace->klasifikasi : '' }});
</script>
@endpush

@endsection