@extends('layouts.app')

@section('content')
@include('layouts.headers.title')


<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->


                <div class="card-header border-0">

                    <div class="row">
                        <div class="col">
                            <h2 class="mb-4 " style="font-weight: 600">สถิติทำรายการขาย </h2>
                        </div>
                        <div class="col-12 col-md-5  text-md-right">
                        </div>
                    </div>
                </div>

                <hr>
                <div class="table-responsive p-3">
                    <table class="table table-hover table-flush" id="maintable">
                        <thead>
                            <tr>
                                <th >ลำดับที่</th>
                                <th >ชื่อ - นามสกุล</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $number = 1 ;
                            @endphp
                            @foreach ($product_not_moving as $row)
                            @php
                            $now = time(); // or your date as well
                            $your_date = strtotime( $row->created_at);
                            $datediff = $now - $your_date;
                            $day = round($datediff / (60 * 60 * 24));

                            @endphp

                            @if ( $day> 150)
                            <tr>
                                <td>
                                    {{$number}}
                                </td>
                                <td>
                                    {{$row->products_name}}
                                </td>

                            </tr>
                            @php
                            $number ++ ;
                            @endphp
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

@push('js')

<script>
    $(document).ready(function () {




        var table = $('#maintable').DataTable({
            "ordering": true,
            "language": {
                "search": "ค้นหา :",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "หน้าถัดไป",
                    "previous": "ก่อนหน้า",

                },
                "info": "แสดงข้อมูล _START_ ถึง _END_ จากข้อมูลทั้งหมด _TOTAL_ รายการ",
                "infoFiltered": '',
                "infoEmpty": "แสดงข้อมูลทั้งหมด 0  รายการ",
                "lengthMenu": "แสดง _MENU_ รายการ",
                "zeroRecords": "ไม่มีรายการ",
                // "serverSide": false,
            },

            "columnDefs": [{
                
                    "searchable": false
                },
                {
                    "targets": 0, // your case first column
                    "className": "text-center",
                },
            ],


        });

        table.on('order.dt search.dt', function () {
            table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });


        }).draw();
        $('#search').keyup(function () {

            table.search($(this).val()).draw();
        })


    });

</script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
