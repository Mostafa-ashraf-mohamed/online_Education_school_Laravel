@extends('layout')
@section('mycss')
    <link href="{{ url('css/admin/a_home.css') }}" rel="stylesheet">
@endsection

@section('navbar')
    @include('admin.adminNavBar')
@endsection

@section('contant')

    <div class="container main mt-5" style="transition: all 500ms;">
        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">@lang('lang.Students')</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user-friends"></i>
                                        </div>
                                        <div class="px-3">
                                            <h6>{{ $studentsCount }}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xl-4 col-md-6">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">@lang('lang.Departments')</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fas fa-code-branch"></i>
                                        </div>
                                        <div class="px-3">
                                            <h6>{{ count($departments) }}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-md-12 col-xl-4">

                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">@lang('lang.Teachers')</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fas fa-chalkboard-teacher"></i>
                                        </div>
                                        <div class="px-3">
                                            <h6>{{ count($teachers) }}</h6>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->

                        <!-- Reports -->
                        <div class="col-12">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">@lang('lang.Report about materials & videos')</h5>
                                    <!-- Line Chart -->
                                    <div id="reportsChart"></div>
                                    <script>
                                        document.addEventListener(
                                            "DOMContentLoaded", () => {
                                                new ApexCharts(document
                                                    .querySelector(
                                                        "#reportsChart"), {
                                                        series: [{
                                                            name: '@lang('lang.number of materials')',
                                                            data: [
                                                                @foreach ($teachers as $data)
                                                                    @php
                                                                        $materials = DB::table('teachers')
                                                                            ->join('units', 'teachers.T_id', '=', 'units.T_id')
                                                                            ->join('materials', 'units.U_id', '=', 'materials.U_id')
                                                                            ->where('teachers.T_id', '=', $data->T_id)
                                                                            ->get();
                                                                        $num = count($materials);
                                                                    @endphp
                                                                    {{$num}},
                                                                @endforeach
                                                            ],
                                                        }, {
                                                            name: '@lang('lang.number of videos')',
                                                            data: [
                                                                @foreach ($teachers as $data)
                                                                    @php
                                                                        $videos = DB::table('teachers')
                                                                            ->join('units', 'teachers.T_id', '=', 'units.T_id')
                                                                            ->join('videos', 'units.U_id', '=', 'videos.U_id')
                                                                            ->where('teachers.T_id', '=', $data->T_id)
                                                                            ->get();
                                                                        $num = count($videos);
                                                                    @endphp
                                                                    {{$num}},
                                                                @endforeach

                                                            ]
                                                        }],
                                                        chart: {
                                                            height: 350,
                                                            type: 'area',
                                                            toolbar: {
                                                                show: false
                                                            },
                                                        },
                                                        markers: {
                                                            size: 4
                                                        },
                                                        colors: ['#4154f1',
                                                            '#ff771d'
                                                        ],
                                                        fill: {
                                                            type: "gradient",
                                                            gradient: {
                                                                shadeIntensity: 1,
                                                                opacityFrom: 0.3,
                                                                opacityTo: 0.4,
                                                                stops: [0,
                                                                    90,
                                                                    100
                                                                ]
                                                            }
                                                        },
                                                        dataLabels: {
                                                            enabled: false
                                                        },
                                                        stroke: {
                                                            curve: 'smooth',
                                                            width: 2
                                                        }
                                                    }).render();
                                            });
                                    </script>
                                    <!-- End Line Chart -->

                                </div>

                            </div>
                        </div><!-- End Reports -->

                        <!-- Top Selling -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">@lang('lang.number of teachers')</h5>
                                    <!-- Bar Chart -->
                                    <canvas id="barChart" style="max-height: 400px;"></canvas>
                                    <script>
                                        document.addEventListener(
                                            "DOMContentLoaded", () => {
                                                new Chart(document
                                                    .querySelector(
                                                        '#barChart'), {
                                                        type: 'bar',
                                                        data: {
                                                            labels: [
                                                                @foreach ( $subjects as $data)
                                                                    "{{$data->S_name}}",
                                                                @endforeach
                                                            ],
                                                            datasets: [{
                                                                label: '@lang('lang.number of teachers'),@lang('lang.subject')',
                                                                data: [
                                                                    @foreach ($subjects as $data)
                                                                        @php
                                                                            $teachers = DB::table('teachers')
                                                                                ->where('S_id', $data->S_id)
                                                                                ->get();
                                                                            $num = count($teachers);
                                                                            echo $num . ',';
                                                                        @endphp
                                                                    @endforeach

                                                                ],
                                                                backgroundColor: [
                                                                    'rgba(255, 99, 132, 0.2)'
                                                                ],
                                                                borderColor: [
                                                                    'rgb(255, 99, 132)'
                                                                ],
                                                                borderWidth: 1
                                                            }]
                                                        },
                                                        options: {
                                                            scales: {
                                                                y: {
                                                                    beginAtZero: true
                                                                }
                                                            }
                                                        }
                                                    });
                                            });
                                    </script><!-- End Bar CHart -->
                                </div>
                            </div>
                        </div><!-- End Top Selling -->
                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">

                    <!-- Website Traffic -->
                    <div class="card">

                        <div class="card-body pb-0">
                            <h5 class="card-title">@lang('lang.number of Department')</h5>

                            <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded",
                                    () => {
                                        echarts.init(document.querySelector(
                                            "#trafficChart")).setOption({
                                            tooltip: {
                                                trigger: 'item'
                                            },
                                            legend: {
                                                top: '5%',
                                                left: 'center'
                                            },
                                            series: [{
                                                name: 'Access From',
                                                type: 'pie',
                                                radius: ['40%',
                                                    '70%'
                                                ],
                                                avoidLabelOverlap: false,
                                                label: {
                                                    show: false,
                                                    position: 'center'
                                                },
                                                emphasis: {
                                                    label: {
                                                        show: true,
                                                        fontSize: '18',
                                                        fontWeight: 'bold'
                                                    }
                                                },
                                                labelLine: {
                                                    show: false
                                                },
                                                data: [
                                                    @foreach ($departments as $data)
                                                        @php
                                                        $students = DB::table('students')->where('D_id',$data->D_id)->get();
                                                        $num = count($students);
                                                        @endphp,{
                                                            value: {{ $num }},
                                                            name: '{{ $data->D_name }}'
                                                        },
                                                    @endforeach

                                                ]
                                            }]
                                        });
                                    });
                            </script>

                        </div>
                    </div><!-- End Website Traffic -->

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">@lang('lang.Gender')</h5>

                            <!-- Pie Chart -->
                            <canvas id="pieChart" style="max-height: 400px;"></canvas>
                            <script>
                                document.addEventListener("DOMContentLoaded",
                                    () => {
                                        new Chart(document.querySelector(
                                            '#pieChart'), {
                                            type: 'pie',
                                            data: {
                                                labels: [
                                                    '@lang('lang.female')',
                                                    '@lang('lang.male')'
                                                ],
                                                datasets: [{
                                                    label: 'My Dataset',
                                                    data: ["{{$femaleCount}}","{{$maleCount}}"],
                                                    backgroundColor: [
                                                        'rgb(255, 99, 132)',
                                                        'rgb(54, 162, 235)'
                                                    ],
                                                    hoverOffset: 4
                                                }]
                                            }
                                        });
                                    });
                            </script>
                            <!-- End Pie CHart -->
                        </div>
                    </div>

                </div><!-- End Right side columns -->

            </div>
        </section>
    </div>
@endsection

@section('myjs')
    <script src="{{ url('js/admin/chart.min.js') }}"></script>
    <script src="{{ url('js/admin/apexcharts.min.js') }}"></script>
    <script src="{{ url('js/admin/echarts.min.js') }}"></script>
@endsection
