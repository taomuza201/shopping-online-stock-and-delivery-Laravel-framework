@extends('layouts.app')

@section('content')
@include('layouts.headers.cards_dashboard')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="card bg-gradient-default shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="text-white mb-0">ยอดขายย้อนหลัง 5 เดือน</h2>
                        </div>
                        <div class="col">


                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <canvas id="myChart" width="auto" height="100%"></canvas>
                        <script>
                            var ctx = document.getElementById('myChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: [
                                        @php
                                        foreach($arr_month as $arr_month) {
                                            echo "'".$arr_month.
                                            "',";
                                        }
                                        @endphp
                                    ],
                                    datasets: [{
                                        label: '# ',
                                        data: [
                                            @php
                                            foreach($arr_total as $arr_total) {
                                                echo "'".$arr_total.
                                                "',";
                                            }
                                            @endphp
                                        ],
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',

                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',

                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
          plugins:{   
             legend: {
               display: false
                     },
                  }
             }
                            });

                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="mb-0">รายการสินค้าขายดี</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">ชื่อสินค้า</th>
                                    <th scope="col">จำนวน</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ( $topsale as $row)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->index+1 }}
                                    </th>
                                    <td>
                                        {{$row->products_name}}
                                    </td>
                                    <td>
                                        {{$row->total}}
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">สถิติทำรายการขาย</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{route('top_user_sale')}}" class="btn btn-sm btn-primary">ดูทั้งหมด</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ลำดับที่</th>
                                <th scope="col">ชื่อ - นามสกุล</th>
                                <th scope="col">จำนวนรายการ</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($top_user_sale as $top_user_sale)
                            <tr>
                                <th scope="row">
                                    {{$loop->index+1}}
                                </th>
                                <td>
                                    @php $user =
                                    DB::table('users')->where('id',$top_user_sale->holds_users_id)->first()@endphp
                                    {{$user->name}}
                                </td>
                                <td>
                                    {{$top_user_sale->total}}
                                </td>

                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">รายการสินค้าที่ไม่มีการเคลื่อนไหวเกิน 5 เดือน</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{route('product_not_moving')}}" class="btn btn-sm btn-primary">ดูทั้งหมด</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">รายสินค้า</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product_not_moving as $row)
                            @php
                            $now = time(); // or your date as well
                            $your_date = strtotime( $row->created_at);
                            $datediff = $now - $your_date;
                            $day = round($datediff / (60 * 60 * 24));
                            @endphp

                            @if ( $day> 150)
                            <tr>
                                <th scope="row">
                                    {{$loop->index+1}}
                                </th>
                                <td>
                                    {{$row->products_name}}
                                </td>

                            </tr>
                            @endif
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>

@endsection
