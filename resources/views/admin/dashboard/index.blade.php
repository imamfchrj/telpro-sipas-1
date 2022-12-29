@extends('layouts.dashboard')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Surat</h4>
                        </div>
                        <div class="card-body">
                            {{ $suratmasuk + $suratkeluar }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Surat Masuk</h4>
                        </div>
                        <div class="card-body">
                            {{ $suratmasuk }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Surat Keluar</h4>
                        </div>
                        <div class="card-body">
                            {{ $suratkeluar }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Surat Harian</h4>
                        </div>
                        <div class="card-body">
                            {{ 0 }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Summary</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart3"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Status </h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart4"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
        <script>
            const d_chart = document.getElementById('myChart3').getContext('2d');
            const suratmasuk = {!! json_encode($suratmasuk) !!};
            const suratkeluar = {!! json_encode($suratkeluar) !!};
            const allocation_chart = new Chart(d_chart, {
                type: 'doughnut',
                data: {
                    labels: ['Surat Masuk', 'Surat Keluar'],
                    datasets: [{
                        // label: [
                        //     enabled: true,
                        //     formatter: function(val, opt) {
                        //         return parseInt(val) + '%';
                        //     }
                        // ],
                        data: [
                            {{ $suratmasuk }},
                            {{ $suratkeluar }},

                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                }
            });


            const ctx1 = document.getElementById('myChart4').getContext('2d');
            const surat_masuk = {!! json_encode($suratmasuk) !!};
            const surat_keluar = {!! json_encode($suratkeluar) !!};

            const myChart1 = new Chart(ctx1, {
                type: 'doughnut',
                data: {
                    labels: ['Surat Masuk', 'Surat Keluar'],
                    datasets: [{
                        label: '# of Votes',
                        data: [
                            {{$suratmasuk}},
                            {{$suratkeluar}}
                        ],
                        backgroundColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        hoverOffset: 2
                    }]
                },
                options: {
                    responsive: true,
                }
            });
        </script>
    </section>

@endsection

