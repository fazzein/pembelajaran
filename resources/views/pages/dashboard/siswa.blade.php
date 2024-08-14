@push('css')
    <style>
        .card-custom {
            height: 95%;
        }

        .avatar.avatar-xl {
            width: 170px;
            height: 170px;
            font-size: 2rem;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .avatar-content.enlarged {
            font-size: 2rem;
        }

        .btn-blue {
            background-color: #050C9C;
            color: white;
            border-color: #050C9C;
        }

        .btn-blue:hover {
            background-color: darken(#050C9C, 10%);
            border-color: darken(#050C9C, 10%);
        }
    </style>
@endpush

@extends('layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb')
    @parent
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-4 col-4">
            <div class="card earnings-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <h4 class="card-title mb-1">Progress</h4>
                            <div class="font-small-2">Pelaksanaan PKL</div>
                            <p class="card-text text-muted font-small-2">
                                <span class="font-weight-bolder" id="cont"></span><span> % Progress</span>
                            </p>
                            <a href="" class="btn btn-sm btn-primary w-100">Lihat Sertifikat</a>
                        </div>
                        <div class="col-8">
                            <div id="earningsChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card bg-primary text-white">
                <div class="card-body d-flex align-items-center">
                    <i data-feather='users' class="mr-1" style="width: 70px; height: 70px;"></i>
                    <div>
                        <h4 class="card-title text-white"><span></span>{{$data->nama_pembimbing ?? ''}}</h4>
                        <p class="card-text">Nama Pembimbing</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card bg-secondary text-white">
                <div class="card-body d-flex align-items-center">
                    <i data-feather='briefcase' class="mr-1" style="width: 70px; height: 70px;"></i>
                    <div>
                        <h4 class="card-title text-white"><span></span>{{$data->nama_instansi ?? ''}}</h4>
                        <p class="card-text">Tempat PKL (Magang)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card card-transaction">
                <div class="card-header">
                    <h4 class="card-title">Total Jumlah Jurnal - ({{$totalKegitan ?? 0}})</h4>
                   
                </div>
                <div class="card-body">
                    <div class="transaction-item">
                        <div class="media">
                            <div class="avatar bg-light-success rounded">
                                <div class="avatar-content">
                                    <i data-feather="check" class="avatar-icon font-medium-3"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h6 class="transaction-title">Approve</h6>
                            </div>
                        </div>
                        <div class="font-weight-bolder text-success">{{$approve ?? 0}} Jurnal</div>
                    </div>
                    <div class="transaction-item">
                        <div class="media">
                            <div class="avatar bg-light-danger rounded">
                                <div class="avatar-content">
                                    <i data-feather="x" class="avatar-icon font-medium-3"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h6 class="transaction-title">Belum Approve</h6>
                            </div>
                        </div>
                        <div class="font-weight-bolder text-danger">{{$belumapprove ?? 0}} Jurnal</div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!--/ Transaction Card -->
        {{-- <div class="col-lg-3">
        <div class="card card-custom d-flex flex-column">
            <div class="card-header text-center">
                <h5 class="w-100">Title Here</h5>
            </div>
            <div class="card-body flex-grow-1">

            </div>
            <div class="card-footer text-center">
                <a href="" class="btn btn-sm btn-primary w-100">Lihat Sertifikat</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-custom d-flex flex-column">
            <div class="card-header text-center">
                <h5 class="w-100">Title Here</h5>
            </div>
            <div class="card-body flex-grow-1">
                <div class="divider divider-primary">
                    <div class="divider-text">Nama Perushaaan</div>
                </div>
                <div class="text-center">
                    <h4>PT.BURNOK TbK</h4>
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="" class="btn btn-sm btn-primary w-100">Detail Tempat PKL</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-custom d-flex flex-column">
            <div class="card-header text-center">
                <h5 class="w-100">Title Here</h5>
            </div>
            <div class="card-body text-center flex-grow-1">
                <div class="avatar bg-light-danger avatar-xl">
                    <span class="avatar-content">AR</span>
                </div>
                <h4>Abdul Rohman</h4>
            </div>
            <div class="card-footer text-center">
                <a href="" class="btn btn-sm btn-primary w-100">Detail Pembimbing</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-custom d-flex flex-column">
            <div class="card-header text-center">
                <h5 class="w-100">Laporan</h5>
            </div>
            <div class="card-body flex-grow-1">
                <div class="divider divider-primary">
                    <div class="divider-text">Ringkasan</div>
                </div>
                <table>
                    <tr>
                        <td>Sudah Terisi</td>
                        <td>:</td>
                        <td>
                            <span>
                                <b>
                                    33 Laporan
                                </b>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Belum terisi</td>
                        <td>:</td>
                        <td>
                            <span>
                                <b>
                                    0 Laporan
                                </b>
                            </span>
                        </td>
                    </tr>
                </table>
                <div class="divider divider-primary">
                    <div class="divider-text"> Apporove</div>
                </div>
                <table>
                    <tr>
                        <td>Sudah Apporove</td>
                        <td>:</td>
                        <td>
                            <span>
                                <b>
                                    33 Laporan
                                </b>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td> Apporove terisi</td>
                        <td>:</td>
                        <td>
                            <span>
                                <b>
                                    0 Laporan
                                </b>
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="#" class="btn btn-sm btn-primary w-100">Detail Laporan</a>
            </div>
        </div>
    </div> --}}
    </div>
@endsection
@push('script_vendor')
<script src="{{asset('template/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
@endpush
@push('script')
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '{{ route('kegiatan.getPersentase') }}', 
                type: 'GET',
                success: function(response) {
                    var totalPersentase = response.totalPersentase;
                    $('#cont').text(response.totalPersentase);
                    var earningsChartOptions = {
                        chart: {
                            type: 'donut',
                            height: 120,
                            toolbar: {
                                show: false
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        series: [totalPersentase, 100 -
                        totalPersentase], // Use the percentage from backend
                        labels: ['Approve', 'Belum Approve'],
                        colors: ['#478CCF', '#36C2CE'], // Colors for "approve" and "remaining"
                        plotOptions: {
                            pie: {
                                donut: {
                                    labels: {
                                        show: true,
                                        name: {
                                            offsetY: 15
                                        },
                                        value: {
                                            offsetY: -15,
                                            formatter: function(val) {
                                                return val.toFixed(2) + '%';
                                            }
                                        },
                                        total: {
                                            show: true,
                                            offsetY: 15,
                                            label: 'Approve',
                                            formatter: function(w) {
                                                return totalPersentase.toFixed(2) + '%';
                                            }
                                        }
                                    }
                                }
                            }
                        },
                        responsive: [{
                                breakpoint: 1325,
                                options: {
                                    chart: {
                                        height: 100
                                    }
                                }
                            },
                            {
                                breakpoint: 1200,
                                options: {
                                    chart: {
                                        height: 120
                                    }
                                }
                            },
                            {
                                breakpoint: 1045,
                                options: {
                                    chart: {
                                        height: 100
                                    }
                                }
                            },
                            {
                                breakpoint: 992,
                                options: {
                                    chart: {
                                        height: 120
                                    }
                                }
                            }
                        ]
                    };

                    var earningsChart = new ApexCharts(document.querySelector("#earningsChart"),
                        earningsChartOptions);
                    earningsChart.render();
                },
                error: function(response) {
                    console.error('Error fetching data:', response);
                }
            });
        });
    </script>
@endpush
