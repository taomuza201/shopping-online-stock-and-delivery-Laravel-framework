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
                                <th scope="col">ลำดับที่</th>
                                <th scope="col">ชื่อ - นามสกุล</th>
                                <th scope="col">จำนวนรายการ</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($top_user_sale as $row )
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td> @php $user =
                                        DB::table('users')->where('id',$row->holds_users_id)->first()@endphp
                                        {{$user->name}}</td>
                                    <td>{{$row->total}}</td>
                                </tr>
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
