@extends('master-dashboard')
@section('title', 'Dashboard')
@section('main')
    <div class="dashboard-content">
        <div class="row">

            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-3">
                    <div class="dashboard-stat-content"><h4>{{$user->transactions->where('status', 'Pending')->count()}}</h4> <span>Pending Booking</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Shopping-Cart"></i></div>
                </div>
            </div>

            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-1">
                    <div class="dashboard-stat-content"><h4>{{$user->transactions->where('status', 'Active')->count()}}</h4> <span>Active Booking</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Check"></i></div>
                </div>
            </div>

            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-2">
                    <div class="dashboard-stat-content"><h4>{{$user->transactions->where('status', 'Finished')->count()}}</h4> <span>Finished Booking</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Check-2"></i></div>
                </div>
            </div>

            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-4">
                    <div class="dashboard-stat-content"><h4>{{$user->transactions->where('status', 'Cancelled')->count()}}</h4> <span>Cancelled Booking</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Close"></i></div>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- site traffic -->
            <div class="col-lg-12 col-md-12 traffic">
                <div class="dashboard-list-box">
                    <h4>Booking Statistics</h4>
                    <canvas id="canvas" style="width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
    <script>
        @php
        $months=array();
            for ($i = 0; $i < 12; $i++) {
                $months[0][$i] = date("M Y", strtotime( date( 'Y-m-01' )." -$i months"));
                $yearMonth = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));
                $months[1][$i] = $user->transactions->where('yearMonth', $yearMonth)->where('status', 'Finished')->count();
                $months[2][$i] = $user->transactions->where('yearMonth', $yearMonth)->count();
            }
        @endphp
        var config = {
            type: 'line',
            data: {
                labels: @json(array_reverse($months[0])),
                datasets: [{
                    label: 'Finished Booking',
                    backgroundColor: window.chartColors.black,
                    borderColor: window.chartColors.black,
                    data: @json(array_reverse($months[1])),
                    fill: false,
                }, {
                    label: 'Total Booking',
                    fill: false,
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: @json(array_reverse($months[2])),
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: '12-Months Booking Chart'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Booking'
                        }
                    }]
                }
            }
        };

        window.onload = function() {
            var ctx = document.getElementById('canvas').getContext('2d');
            window.myLine = new Chart(ctx, config);
        };
    </script>
@endsection
