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
    <div class="section-body">
        <h2 class="section-title">Show Surat Masuk</h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Surat Masuk Detail</h4>
                    </div>
                    <div class="card-body">
                        @include('sipas::admin.shared.flash')
                        <div class="form-row">
                            <div class="col-md-2">
                                <Label>Tanggal Terima</Label>
                            </div>
                            <div class="col-md-10">
                                : {{ $suratmasuk->tanggal_terima }}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2">
                                <Label>Nomor Surat</Label>
                            </div>
                            <div class="col-md-10">
                                : {{ $suratmasuk->nomor_surat }}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2">
                                <Label>Perihal</Label>
                            </div>
                            <div class="col-md-10">
                                : {{ $suratmasuk->perihal }}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2">
                                <Label>Tanggal Surat</Label>
                            </div>
                            <div class="col-md-10">
                                : {{ $suratmasuk->tanggal_surat }}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2">
                                <Label>Dari</Label>
                            </div>
                            <div class="col-md-10">
                                : {{ $suratmasuk->dari }}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2">
                                <Label>Kepada</Label>
                            </div>
                            <div class="col-md-10">
                                : {{ $suratmasuk->disposisi_name }}
                            </div>
                        </div>
                        <div class="card-footer text-left">
                            <a href="{{ url('admin/sipas/suratmasuk') }}"><button class="btn btn-light">Back</button></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection