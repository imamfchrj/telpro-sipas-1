@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Surat Masuk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a
                            href="{{ url('admin/sipas/workspacesuratmasuk') }}">Workspace Surat Masuk</a></div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">List of Surat Masuks</h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @include('sipas::admin.shared.flash')
                            @include('sipas::admin.workspacesuratmasuk._filter')
                            <div class="table-responsive">
                                <table id="suratmasuk" class="table table-bordered table-striped table-sm ">
                                    <thead>
                                    <th>No</th>
                                    <th>Tanggal Terima</th>
                                    <th>Nomor Surat</th>
                                    <th>Perihal</th>
                                    <th>Dari</th>
                                    <th>Kepada</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    @forelse ($workspacesuratmasuks as $suratmasuk)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $suratmasuk->tanggal_terima }}</td>
                                            <td>{{ $suratmasuk->nomor_surat }}</td>
                                            <td>{{ $suratmasuk->perihal }}</td>
                                            <td>{{ $suratmasuk->dari }}</td>
                                            <td>{{ $suratmasuk->disposisi_name }}</td>
                                            <td>{{ $suratmasuk->status }}</td>
                                            <td>
                                                {{--@can('view_sipas-suratmasuk')--}}
                                                    {{--<a class="btn btn-sm btn-primary"--}}
                                                    {{--href="{{ url('admin/sipas/suratmasuk/'. $suratmasuk->id )}}"><i--}}
                                                                {{--class="far fa-eye"></i>--}}
                                                    {{--</a>--}}
                                                {{--@endcan--}}
                                                @can('edit_sipas-suratmasuk')
                                                    <a class="btn btn-sm btn-warning"
                                                       href="{{ url('admin/sipas/workspace-suratmasuk/'. $suratmasuk->id .'/edit')}}"><i
                                                                class="far fa-edit"></i>
                                                    </a>
                                                @endcan
                                                {{--@can('delete_sipas-suratmasuk')--}}
                                                    {{--<a href="{{ url('admin/sipas/suratmasuk/'. $suratmasuk->id) }}"--}}
                                                       {{--class="btn btn-sm btn-danger" onclick="--}}
                                                            {{--event.preventDefault();--}}
                                                            {{--if (confirm('Do you want to remove this?')) {--}}
                                                            {{--document.getElementById('delete-role-{{ $suratmasuk->id }}').submit();--}}
                                                            {{--}">--}}
                                                        {{--<i class="far fa-trash-alt"></i>--}}
                                                    {{--</a>--}}
                                                    {{--<form id="delete-role-{{ $suratmasuk->id }}"--}}
                                                          {{--action="{{ url('admin/sipas/suratmasuk/'. $suratmasuk->id) }}"--}}
                                                          {{--method="POST">--}}
                                                        {{--<input type="hidden" name="_method" value="DELETE">--}}
                                                        {{--@csrf--}}
                                                    {{--</form>--}}
                                                {{--@endcan--}}
                                            </td>
                                        </tr>
                                    @empty

                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="card-header">
                                    <h4 class="text-md-right">
                                        Showing
                                        {{ $workspacesuratmasuks->firstItem() }}
                                        to
                                        {{ $workspacesuratmasuks->lastItem() }}
                                        of
                                        {{ $workspacesuratmasuks->total() }}
                                        Entries
                                    </h4>
                                    <div class="card-header-action">
                                        {{ $workspacesuratmasuks->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection