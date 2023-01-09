@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Surat Masuk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a
                            href="{{ url('admin/sipas/workspace-suratmasuk') }}">Manage Surat Masuk</a></div>
            </div>
        </div>
        @if(isset($workspacesuratmasuk))
            {!! Form::model($workspacesuratmasuk, ['url' => ['admin/sipas/workspace-suratmasuk', $workspacesuratmasuk->id], 'method' => 'PUT', 'files' => true ]) !!}
            {!! Form::hidden('id') !!}
        @else
            {!! Form::open(['url' => 'admin/sipas/workspace-suratmasuk', 'files'=>true]) !!}
        @endif
        @csrf
        <div class="section-body">
            <h2 class="section-title">
                {{ empty($workspacesuratmasuk) ? 'Create Surat Masuk' : 'Update Surat Masuk' }}
            </h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ empty($workspacesuratmasuk) ? 'Add New Surat Masuk' : 'Update Surat Masuk' }}
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
                                        <input type="text" name="tanggal_terima" id="tanggal_terima" class="form-control @error('tanggal_terima') is-invalid @enderror @if (!$errors->has('tanggal_terima') && old('tanggal_terima')) is-valid @endif"
                                               value="{{ old('tanggal_terima', !empty($workspacesuratmasuk) ? $workspacesuratmasuk->tanggal_terima : null) }}" readonly>
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
                                           value="{{ old('nomor_surat', !empty($workspacesuratmasuk) ? $workspacesuratmasuk->nomor_surat : null) }}">
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
                                           value="{{ old('dari', !empty($workspacesuratmasuk) ? $workspacesuratmasuk->dari : null) }}" readonly>
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
                                        <input type="text" name="tanggal_surat" id="tanggal_surat" class="form-control datepicker @error('tanggal_surat') is-invalid @enderror @if (!$errors->has('tanggal_surat') && old('tanggal_surat')) is-valid @endif"
                                               value="{{ old('tanggal_surat', !empty($workspacesuratmasuk) ? $workspacesuratmasuk->tanggal_surat : null) }}" >
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
                                    {{--{!! Form::select('kepada', $unit, !empty($workspacesuratmasuk->disposisi_kode_unit) ? $workspacesuratmasuk->disposisi_kode_unit :--}}
                                    {{--old('kepada'), ['class' => 'form-control', 'placeholder' => '-- Pilih Unit --', 'readonly']) !!}--}}
                                    <select class="form-control" name="kepada" id ="kepada" disabled>
                                        <option value=" ">
                                            {{ !empty($workspacesuratmasuk->disposisi_name) ? $workspacesuratmasuk->disposisi_name : '' }}
                                        </option>
                                    </select>
                                </div>
                                @error('kepada')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <label class="col-sm-2 col-form-label">Perihal</label>
                                <div class="col-sm-4">
                                    <input type="text" name="perihal" id="perihal" class="form-control @error('perihal') is-invalid @enderror @if (!$errors->has('perihal') && old('perihal')) is-valid @endif"
                                           value="{{ old('perihal', !empty($workspacesuratmasuk) ? $workspacesuratmasuk->perihal : null) }}">
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
                                    class="btn btn-primary">Receive</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
@endsection