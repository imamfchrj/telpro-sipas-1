@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Surat Keluar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a
                            href="{{ url('admin/sipas/workspace') }}">Workspace Surat Keluar</a></div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">List of Surat Keluars</h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @include('sipas::admin.shared.flash')
                            @include('sipas::admin.suratkeluar._filter')
                            <div class="table-responsive">
                                <table id="suratkeluar" class="table table-bordered table-striped table-sm ">
                                    <thead>
                                    <th>No</th>
                                    <th>Kategori Surat</th>
                                    <th>Nomor Surat</th>
                                    <th>Tanggal Surat</th>
                                    <th>Dari</th>
                                    <th>Kepada</th>
                                    <th>Perihal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    @forelse ($workspaces as $workspace)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $workspace->kategori }}</td>
                                            <td>{{ $workspace->nomor_surat }}</td>
                                            <td>{{ $workspace->tanggal_surat }}</td>
                                            <td>{{ $workspace->dari }}</td>
                                            <td>{{ $workspace->kepada }}</td>
                                            <td>{{ $workspace->perihal }}</td>
                                            <td>{{ $workspace->status }}</td>
                                            <td>
                                                {{--@can('view_sipas-suratkeluar')--}}
                                                    {{--<a class="btn btn-sm btn-primary"--}}
                                                        {{--href="{{ url('admin/sipas/suratkeluar/'. $suratkeluar->id )}}"><i--}}
                                                                {{--class="far fa-eye"></i>--}}
                                                        {{--Show--}}
                                                    {{--</a>--}}
                                                {{--@endcan--}}
                                                @can('edit_sipas-suratkeluar')
                                                    <a class="btn btn-sm btn-warning"
                                                       href="{{ url('admin/sipas/workspace/'. $workspace->id .'/edit')}}"><i
                                                                class="far fa-edit"></i>
                                                    </a>
                                                @endcan
                                                    {{--@can('delete_sipas-suratkeluar')--}}
                                                    {{--<a href="{{ url('admin/sipas/suratkeluar/'. $workspace->id) }}"--}}
                                                       {{--class="btn btn-sm btn-danger" onclick="--}}
                                                            {{--event.preventDefault();--}}
                                                            {{--if (confirm('Do you want to remove this?')) {--}}
                                                            {{--document.getElementById('delete-role-{{ $workspace->id }}').submit();--}}
                                                            {{--}">--}}
                                                        {{--<i class="far fa-trash-alt"></i>--}}
                                                    {{--</a>--}}
                                                    {{--<form id="delete-role-{{ $workspace->id }}"--}}
                                                          {{--action="{{ url('admin/sipas/suratkeluar/'. $workspace->id) }}"--}}
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
                                        {{ $workspaces->firstItem() }}
                                        to
                                        {{ $workspaces->lastItem() }}
                                        of
                                        {{ $workspaces->total() }}
                                        Entries
                                    </h4>
                                    <div class="card-header-action">
                                        {{ $workspaces->links() }}
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