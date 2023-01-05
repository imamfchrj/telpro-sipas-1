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
        @if(isset($suratkeluar))
            {!! Form::model($suratkeluar, ['url' => ['admin/sipas/suratkeluar', $suratkeluar->id], 'method' => 'PUT', 'files' => true ]) !!}
            {!! Form::hidden('id') !!}
        @else
            {!! Form::open(['url' => 'admin/sipas/suratkeluar', 'files'=>true]) !!}
        @endif
        @csrf
        <div class="section-body">
            <h2 class="section-title">
                {{ empty($suratkeluar) ? 'Create Surat Keluar' : 'Update Surat Keluar' }}
            </h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ empty($suratkeluar) ? 'Add New Surat Keluar' : 'Update Surat Keluar' }}
                            </h4>
                        </div>
                        <div class="card-body">
                            @include('sipas::admin.shared.flash')
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kategori Surat</label>
                                <div class="col-sm-4">
                                    {{ Form::select('kategori', $kategori, null, ['class' => 'form-control', 'id' => 'kategori', 'onchange'=>'klasifikasi_get(this)' ]) }}
                                    <input type="hidden" name="id"
                                           value="{{ old('id', !empty($suratkeluar) ? $suratkeluar->id : '') }}">
                                </div>
                                @error('kategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <label class="col-sm-2 col-form-label">Klasifikasi</label>
                                <div class="col-sm-4">
                                    <select name="klasifikasi" id="klasifikasi"
                                            class="form-control browser-default select2" onchange="">
                                        <option value="">-- Pilih Klasifikasi Surat --</option>
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
                                        <input type="text" name="tanggal_surat" id="tanggal_surat"
                                               class="form-control datepicker @error('tanggal_surat') is-invalid @enderror @if (!$errors->has('tanggal_surat') && old('tanggal_surat')) is-valid @endif"
                                               value="{{ old('tanggal_surat', !empty($suratkeluar) ? $suratkeluar->tanggal_surat : null) }}">
                                    </div>
                                </div>
                                @error('tanggal_surat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <label class="col-sm-2 col-form-label">Unit Kerja</label>
                                <div class="col-sm-4">
                                    {{ Form::select('id_unit', $unit, null, ['class' => 'form-control', 'id' => 'id_unit', 'placeholder' => '-- Pilih Unit --' ]) }}
                                </div>
                                @error('id_unit')
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
                                           value="{{ old('dari', !empty($suratkeluar) ? $suratkeluar->dari : $unit_by_userId->unit) }}"
                                           readonly>
                                    <input type="hidden" name="dari_id_unit"
                                           value="{{ old('dari_id_unit', !empty($suratkeluar) ? $suratkeluar->dari_id_unit : $unit_by_userId->id) }}">
                                    <input type="hidden" name="dari_kode_unit"
                                           value="{{ old('dari_kode_unit', !empty($suratkeluar) ? $suratkeluar->dari_kode_unit : $unit_by_userId->kode_unit_sap) }}">
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
                                           value="{{ old('kepada', !empty($suratkeluar) ? $suratkeluar->kepada : null) }}">
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
                                           value="{{ old('perihal', !empty($suratkeluar) ? $suratkeluar->perihal : null) }}">
                                </div>
                                @error('perihal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                {{--<label class="col-sm-2 col-form-label">Lampiran</label>--}}
                                {{--<div class="col-sm-4">--}}
                                    {{--@if (!empty($pengajuan) && $pengajuan->featured_image)--}}
                                        {{--<img src="{{ $pengajuan->featured_image }}"--}}
                                             {{--alt="{{ $pengajuan->featured_image_caption }}"--}}
                                             {{--class="img-fluid img-thumbnail"/>--}}
                                    {{--@endif--}}
                                    {{--<input type="file" name="lampiranSk" class="form-control"/>--}}
                                {{--</div>--}}
                                {{--@error('lampiranSk')--}}
                                {{--<div class="invalid-feedback">--}}
                                    {{--{{ $message }}--}}
                                {{--</div>--}}
                                {{--@enderror--}}
                                <label class="col-sm-2 col-form-label">Lampiran</label>
                                <div class="col-sm-4">
                                    <input type="file" name="lampiranSk" class="form-control @error('lampiranSk') is-invalid @enderror @if (!$errors->has('lampiranSk') && old('lampiranSk')) is-valid @endif"/>
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
                                    <textarea name="keterangan" class="form-control"
                                              style="height: 100px;">{{ !empty($suratkeluar) ? $suratkeluar->keterangan : null }}</textarea>
                                </div>
                                @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-left">
                            <button
                                    class="btn btn-primary">{{ empty($suratkeluar) ? 'Create' : 'Update' }}</button>
                            {{--<a href="{{ url('admin/sipas/suratkeluar') }}"><button class="btn btn-light">Close</button></a>--}}
                            <a class="btn btn-light" href="{{ url('admin/sipas/suratkeluar') }}">Close</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
    @push('script')
        <script>
            $('#kategori').trigger('change');
            $('#klasifikasi').val({{ !empty($suratkeluar) ? $suratkeluar->klasifikasi : '' }});
        </script>
    @endpush
@endsection