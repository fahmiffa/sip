@extends('layout.base')
@section('main')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Dokumen</h3>
                    {{-- <p class="text-subtitle text-muted">Navbar will appear on the top of the page.</p> --}}
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-4 col-lg-4 col-md-4">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-start mb-3">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldPaper"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="text-muted font-semibold">Done</h6>
                                        <h6 class="font-extrabold mb-0">{{$head->where('finish',1)->count()}}</h6>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-start">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldPaper"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="text-muted font-semibold">Progress</h6>
                                        <h6 class="font-extrabold mb-0">{{$head->where('finish',0)->count()}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8 col-lg-8 col-md-8">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-6 d-flex justify-content-start mb-3">
                                    <div class="stats-icon mb-2" style="background-color: darkgray">
                                        <i class="iconly-boldPaper"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="text-muted font-semibold">Verifikasi</h6>
                                        <h6 class="font-extrabold mb-0">{{$verif}}</h6>
                                    </div>
                                </div>
                                <div class="col-6 d-flex justify-content-start mb-3">
                                    <div class="stats-icon dark mb-2">
                                        <i class="iconly-boldPaper"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="text-muted font-semibold">Konsultasi</h6>
                                        <h6 class="font-extrabold mb-0">{{$kons}}</h6>
                                    </div>
                                </div>
                                <div class="col-6 d-flex justify-content-start">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldPaper"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="text-muted font-semibold">BAK</h6>
                                        <h6 class="font-extrabold mb-0">{{$bak}}</h6>
                                    </div>
                                </div>
                                <div class="col-6 d-flex justify-content-start">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldPaper"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="text-muted font-semibold">BARP</h6>
                                        <h6 class="font-extrabold mb-0">{{$barp}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Grafik Dokumen</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-profile-visit" style="min-height: 315px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        var optionsProfileVisit = {
            annotations: {
                position: "back",
            },
            dataLabels: {
                enabled: false,
            },
            chart: {
                type: "bar",
                height: 300,
            },
            fill: {
                opacity: 1,
            },
            plotOptions: {},
            series: [{
                name: "sales",
                data: [9, 20, 30, 20, 10, 20, 30, 20, 10, 20, 30, 20],
            }, ],
            colors: "#435ebe",
            xaxis: {
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
            },
        }
        var chartProfileVisit = new ApexCharts(
            document.querySelector("#chart-profile-visit"),
            optionsProfileVisit
        )

        chartProfileVisit.render()
    </script>
@endpush
