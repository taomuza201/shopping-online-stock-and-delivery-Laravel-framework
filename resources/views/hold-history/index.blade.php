@extends('layouts.app')

@section('content')
@include('layouts.headers.title')
<style>
    table tr {
        cursor: pointer;
    }

</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->


                <div class="card-header border-0">

                    <div class="row">
                        <div class="col">
                            <h2 class="mb-4 " style="font-weight: 600">ประวัติการสั่งซื้อ </h2>
                        </div>
                        <div class="col-12 col-md-5  text-md-right">
                        </div>
                    </div>
                </div>

                <hr>
                <div class="table-responsive p-3">
                    <table class="table table-hover table-flush table-striped" id="maintable">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับที่</th>
                                <th scope="col">เลขที่สั่งซื้อ</th>
                                <th scope="col">ชื่อ - นามสกุล</th>
                                <th scope="col">เบอร์โทร</th>
                                <th scope="col">ผู้ทำรายการ</th>
                                <th scope="col">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($hold as $row)
                            <tr href="{{url('hold-details/'.$row->holds_id)}}" class="href">
                                <td class="td-center"></td>
                                <td>{{$row->holds_code}}</td>
                                <td>{{$row->holds_name}}</td>
                                <td>{{$row->holds_tel}}</td>
                                <td>{{$row->name}}</td>
                                <td>
                                    @switch($row->holds_status)
                                    @case('start')
                                    1. อยู่ระหว่างการตกลง
                                    @break
                                    @case('n2')
                                    2. สั่งซื้อเก็บเงินปลายทาง - กรอกข้อมูลการจัดส่ง
                                    @break
                                    @case('n3')
                                    3. จัดส่งสินค้า
                                    @break
                                    @case('n4')
                                    4. แจ้งเลขขนส่งให้ลูกค้า
                                    @break
                                    @case('n5')
                                    5. อยู่ระหว่างการจัดส่งสินค้า
                                    @break
                                    @case('n6')
                                    6. ลูกค้าได้รับสินค้า - พร้อมจ่ายเงิน
                                    @break
                                    @case('n7')
                                    7. คอมเม้นต์
                                    @break
                                    @case('n8')
                                    8. โอนเงินให้เจ้าของผลิตภัณท์
                                    @break
                                    @case('n9')
                                    9. เก็บหลักฐานการโอนเงิน
                                    @break
                                    @case('n10')
                                    10. ทำรายการสำเร็จ
                                    @break
                                    @case('p2')
                                    2. สั่งซื้อจ่ายล่วงหน้าและเก็บเงินแล้ว -
                                    ออกบิล/กรอกข้อมูลการจัดส่งข้อมูลการจัดส่ง
                                    @break
                                    @case('p3')
                                    3. เก็บหลักฐานการจ่ายเงิน
                                    @break
                                    @case('p4')
                                    4. จัดส่งสินค้า
                                    @break
                                    @case('p5')
                                    5. แจ้งเลขขนส่งให้ลูกค้า
                                    @break
                                    @case('p6')
                                    6. อยู่ระหว่างการจัดส่งสินค้า
                                    @break
                                    @case('p7')
                                    7. ลูกค้าได้รับสินค้า
                                    @break
                                    @case('p8')
                                    8. คอมเม้นต์
                                    @break
                                    @case('p9')
                                    9. โอนเงินให้เจ้าของผลิตภัณท์
                                    @break
                                    @case('p10')
                                    10. เก็บหลักฐานการโอนเงิน
                                    @break
                                    @case('p11')
                                    11. ทำรายการสำเร็จ
                                    @break

                                    @default


                                    @endswitch

                                    @if (substr($row->holds_status, 0, 1)=='p')
                                        - ชำระเงินโอนจ่าย
                                    @endif
                                    @if (substr($row->holds_status, 0, 1)=='n')
                                        - ชำระเงินปลายทาง
                                    @endif

                                </td>

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
    $('table .href').click(function () {
        window.location = $(this).attr('href');
        return false;
    });

    let status = 'store';

    $(document).ready(function () {


        showmodal = () => {
            $('#mainform').prop('action', "{{route('hold.store')}}");
            $('#mainModal').modal('show');

            $('#name').val('');
            $('#email').val('');
            $('#position').val('');
            $("#password").val('');
            $("#password").prop("required", true);
        }



        var table = $('#maintable').DataTable({
            "ordering": false,
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
                    "targets": [2],
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
