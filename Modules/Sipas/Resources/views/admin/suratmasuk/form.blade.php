@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Surat Masuk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a
                            href="{{ url('admin/sipas/suratmasuk') }}">Manage Surat Masuk</a></div>
            </div>
        </div>
        @if(isset($suratmasuk))
            {!! Form::model($suratmasuk, ['url' => ['admin/sipas/suratmasuk', $suratmasuk->id], 'method' => 'PUT', 'files' => true ]) !!}
            {!! Form::hidden('id') !!}
        @else
            {!! Form::open(['url' => 'admin/sipas/suratmasuk', 'files'=>true]) !!}
        @endif
        @csrf
        <div class="section-body">
            <h2 class="section-title">
                {{ empty($suratmasuk) ? 'Create Surat Masuk' : 'Update Surat Masuk' }}
            </h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ empty($suratmasuk) ? 'Add New Surat Masuk' : 'Update Surat Masuk' }}
                            </h4>
                        </div>
                        <div class="card-body">
                            @include('sipas::admin.shared.flash')
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal Terima</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="tanggal_terima" id="tanggal_terima" class="form-control datepicker @error('tanggal_terima') is-invalid @enderror @if (!$errors->has('tanggal_terima') && old('tanggal_terima')) is-valid @endif"
                                               value="{{ old('tanggal_terima', !empty($suratmasuk) ? $suratmasuk->tanggal_terima : null) }}">
                                    </div>
                                </div>
                                @error('tanggal_terima')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <label class="col-sm-2 col-form-label">Nomor Surat</label>
                                <div class="col-sm-4">
                                    <input type="text" name="nomor_surat" id="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror @if (!$errors->has('nomor_surat') && old('nomor_surat')) is-valid @endif"
                                           value="{{ old('nomor_surat', !empty($suratmasuk) ? $suratmasuk->nomor_surat : null) }}" readonly>
                                </div>
                                @error('nomor_surat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Dari</label>
                                <div class="col-sm-4">
                                    <input type="text" name="dari" id="dari" class="form-control @error('dari') is-invalid @enderror @if (!$errors->has('dari') && old('dari')) is-valid @endif"
                                           value="{{ old('dari', !empty($suratmasuk) ? $suratmasuk->dari : null) }}">
                                </div>
                                @error('dari')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <label class="col-sm-2 col-form-label">Tanggal Surat</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="tanggal_surat" id="tanggal_surat" class="form-control @error('tanggal_surat') is-invalid @enderror @if (!$errors->has('tanggal_surat') && old('tanggal_surat')) is-valid @endif"
                                               value="{{ old('tanggal_surat', !empty($suratmasuk) ? $suratmasuk->tanggal_surat : null) }}" readonly>
                                    </div>
                                </div>
                                @error('tanggal_surat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kepada</label>
                                <div class="col-sm-4">
                                    {!! Form::select('kepada', $unit, !empty($suratmasuk->disposisi_kode_unit) ? $suratmasuk->disposisi_kode_unit :
                                    old('kepada'), ['class' => 'form-control', 'placeholder' => '-- Pilih Unit --']) !!}
                                </div>
                                @error('kepada')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <label class="col-sm-2 col-form-label">Perihal</label>
                                <div class="col-sm-4">
                                    <input type="text" name="perihal" id="perihal" class="form-control @error('perihal') is-invalid @enderror @if (!$errors->has('perihal') && old('perihal')) is-valid @endif"
                                           value="{{ old('perihal', !empty($suratmasuk) ? $suratmasuk->perihal : null) }}" readonly>
                                </div>
                                @error('perihal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-left">
                            <button
                                    class="btn btn-primary">{{ empty($suratmasuk) ? 'Create' : 'Update' }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
@endsection