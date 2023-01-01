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
                                    {{--<th>Kategori Surat</th>--}}
                                    {{--<th>Nomor Surat</th>--}}
                                    {{--<th>Tanggal Surat</th>--}}
                                    {{--<th>Dari</th>--}}
                                    {{--<th>Kepada</th>--}}
                                    {{--<th>Perihal</th>--}}
                                    {{--<th>Status</th>--}}
                                    <th>@sortablelink('kategori','Kategori Surat')</th>
                                    <th>@sortablelink('nomor_surat','Nomor Surat')</th>
                                    <th>@sortablelink('tanggal_surat','Tanggal Surat')</th>
                                    <th>@sortablelink('dari','Dari')</th>
                                    <th>@sortablelink('kepada','Kepada')</th>
                                    <th>@sortablelink('perihal','Perihal')</th>
                                    <th>@sortablelink('status','Status')</th>
                                    <th>File</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    @forelse ($suratkeluars as $suratkeluar)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $suratkeluar->kategori }}</td>
                                            <td>{{ $suratkeluar->nomor_surat }}</td>
                                            <td>{{ $suratkeluar->tanggal_surat }}</td>
                                            <td>{{ $suratkeluar->dari }}</td>
                                            <td>{{ $suratkeluar->kepada }}</td>
                                            <td>{{ $suratkeluar->perihal }}</td>
                                            <td>{{ $suratkeluar->status }}</td>
                                            <td>
                                            @if($suratkeluar->status_id == 4)
                                            <a class="btn btn-sm btn-outline-secondary"
                                                       href="{{ url('admin/sipas/suratkeluar/'. $suratkeluar->id .'/download')}}"><i
                                                                class="far fa-save"></i>
                                                    </a>
                                                    @endif
                                            </td>
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
                                                       href="{{ url('admin/sipas/suratkeluar/'. $suratkeluar->id .'/edit')}}"><i
                                                                class="far fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete_sipas-suratkeluar')
                                                    <a href="{{ url('admin/sipas/suratkeluar/'. $suratkeluar->id) }}"
                                                       class="btn btn-sm btn-danger" onclick="
                                                            event.preventDefault();
                                                            if (confirm('Do you want to remove this?')) {
                                                            document.getElementById('delete-role-{{ $suratkeluar->id }}').submit();
                                                            }">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                    <form id="delete-role-{{ $suratkeluar->id }}"
                                                          action="{{ url('admin/sipas/suratkeluar/'. $suratkeluar->id) }}"
                                                          method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        @csrf
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty

                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="card-header">
                                    <h4 class="text-md-right">
                                        Showing
                                        {{ $suratkeluars->firstItem() }}
                                        to
                                        {{ $suratkeluars->lastItem() }}
                                        of
                                        {{ $suratkeluars->total() }}
                                        Entries
                                    </h4>
                                    <div class="card-header-action">
                                        {{ $suratkeluars->links() }}
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
