@extends('layouts.dashboard')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Form Persetujuan JIB</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ url('admin/jib/workspace') }}">Manage Pengajuan JIB</a>
            </div>
        </div>
    </div>
    @if(isset($persetujuan))
    {!! Form::model($persetujuan, ['url' => ['admin/jib/workspace/updateform', $persetujuan->id], 'method' => 'PUT',
    'files' => true ]) !!}
    {!! Form::hidden('id') !!}
    @else
    {!! Form::open(['url' => 'admin/jib/workspace/storeform', 'files'=>true]) !!}
    @endif
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4> SUPPORT CAPEX/OPEX</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">No DRP/DRK</label>
                            <div class="col-sm-4">
                                <input type="hidden" name="pengajuan_id"
                                    value="{{ old('pengajuan_id', !empty($pengajuan) ? $pengajuan->id : '') }}">
                                <input type="text" name="no_drp"
                                    class="form-control @error('no_drp') is-invalid @enderror @if (!$errors->has('no_drp') && old('no_drp')) is-valid @endif"
                                    value="{{ !empty($pengajuan->no_drp) ? $pengajuan->no_drp : '' }}" readonly>
                            </div>

                            <label class="col-sm-2 col-form-label">BCR</label>
                            <div class="col-sm-4">
                                <input type="text" name="bcr"
                                    class="form-control @error('bcr') is-invalid @enderror @if (!$errors->has('bcr') && old('bcr')) is-valid @endif"
                                    value="{{ !empty($pengajuan) ? $pengajuan->bcr : '' }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kelompok Akun</label>
                            <div class="col-sm-4">
                                <input type="text" name="akun"
                                    class="form-control @error('akun') is-invalid @enderror @if (!$errors->has('akun') && old('akun')) is-valid @endif"
                                    value="{{ !empty($persetujuan->akun) ? $persetujuan->akun : '' }}">
                            </div>

                            <label class="col-sm-2 col-form-label">Analisa Inheret Risk</label>
                            <div class="col-sm-4">
                                {!! Form::select('analisa_risk', $risiko, !empty($persetujuan->analisa_risk) ?
                                $persetujuan->analisa_risk : old('analisa_risk'), ['class' => 'form-control',
                                'placeholder' => '-- Select --']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Kegiatan</label>
                            <div class="col-sm-4">
                                <input type="text" name="kegiatan"
                                    class="form-control @error('kegiatan') is-invalid @enderror @if (!$errors->has('kegiatan') && old('kegiatan')) is-valid @endif"
                                    value="{{ !empty($pengajuan->kegiatan) ? $pengajuan->kegiatan : '' }}" readonly>
                            </div>

                            <label class="col-sm-2 col-form-label">Score Inheret Risk</label>
                            <div class="col-sm-4">
                                <input type="text" name="score_risk"
                                    class="form-control @error('score_risk') is-invalid @enderror @if (!$errors->has('score_risk') && old('score_risk')) is-valid @endif"
                                    value="{{ !empty($persetujuan->score_risk) ? $persetujuan->score_risk : '' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Customer</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="customer_id" id="customer_id" readonly>
                                    <option value=" ">
                                        {{ !empty($pengajuan->mcustomers->name) ? $pengajuan->mcustomers->name : '' }}
                                    </option>
                                </select>
                            </div>

                            <label class="col-sm-2 col-form-label">Rencana Mitigasi</label>
                            <div class="col-sm-4">
                                <input type="text" name="rencana_mitigasi"
                                    class="form-control @error('rencana_mitigasi') is-invalid @enderror @if (!$errors->has('rencana_mitigasi') && old('rencana_mitigasi')) is-valid @endif"
                                    value="{{ !empty($persetujuan->rencana_mitigasi) ? $persetujuan->rencana_mitigasi : '' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Lokasi</label>
                            <div class="col-sm-4">
                                <input type="text" name="lokasi"
                                    class="form-control @error('lokasi') is-invalid @enderror @if (!$errors->has('lokasi') && old('lokasi')) is-valid @endif"
                                    value="{{ !empty($persetujuan->lokasi) ? $persetujuan->lokasi : '' }}">
                            </div>

                            <label class="col-sm-2 col-form-label">Resiko Setelah Mitigasi</label>
                            <div class="col-sm-4">
                                {!! Form::select('risk_mitigasi', $risiko, !empty($persetujuan->risk_mitigasi) ?
                                $persetujuan->risk_mitigasi : old('risk_mitigasi'), ['class' => 'form-control',
                                'placeholder' => '-- Select --']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Scope of Work</label>
                            <div class="col-sm-4">
                                <input type="text" name="sow"
                                    class="form-control @error('sow') is-invalid @enderror @if (!$errors->has('sow') && old('sow')) is-valid @endif"
                                    value="{{ !empty($persetujuan->sow) ? $persetujuan->sow : '' }}">
                            </div>

                            <label class="col-sm-2 col-form-label">Score Resiko Setelah Mitigasi</label>
                            <div class="col-sm-4">
                                <input type="text" name="score_mitigasi"
                                    class="form-control @error('score_mitigasi') is-invalid @enderror @if (!$errors->has('score_mitigasi') && old('score_mitigasi')) is-valid @endif"
                                    value="{{ !empty($persetujuan->score_mitigasi) ? $persetujuan->score_mitigasi : '' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Delivery Time</label>
                            <div class="col-sm-4">
                                <input type="text" name="delivery_time"
                                    class="form-control @error('delivery_time') is-invalid @enderror @if (!$errors->has('delivery_time') && old('delivery_time')) is-valid @endif"
                                    value="{{ !empty($persetujuan->delivery_time) ? $persetujuan->delivery_time : '' }}">
                            </div>

                            <label class="col-sm-2 col-form-label">Kesimpulan Inisiatif Bisnis</label>
                            <div class="col-sm-4">
                                {!! Form::select('kesimpulan', $kesimpulan, !empty($persetujuan->kesimpulan) ?
                                $persetujuan->kesimpulan : old('kesimpulan'), ['class' => 'form-control', 'placeholder'
                                => '-- Select --']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Catatan</label>
                            <div class="col-sm-4">
                                <textarea name="catatan" class="form-control"
                                    style="height: 70px;">{{ !empty($persetujuan->catatan) ? $persetujuan->catatan : '' }}</textarea>
                            </div>

                            @if(!empty($persetujuan))
                            <label class="col-sm-2 col-form-label">File Upload</label>
                            <div class="col-sm-4" id="file_approval">
                                @if (!empty($pengajuan) && $pengajuan->featured_image)
                                <img src="{{ $pengajuan->featured_image }}"
                                    alt="{{ $pengajuan->featured_image_caption }}" class="img-fluid img-thumbnail" />
                                @endif
                                <input type="file" name="file_approval" class="form-control" />
                            </div>
                            @error('file_approval')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            @endif
                        </div>

                    </div>

                    <div class="card-footer text-left">
                        <a class="btn btn-light"
                            href="{{ url('admin/jib/workspace/'.$pengajuan->id.'/editworkspace') }}">Back</a>
                        <a href=""><button class="btn btn-primary">{{ !empty($persetujuan) ? 'Update' : 'Create' }}</button></a>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {!! Form::close() !!}
</section>
@endsection
