@extends('layouts.app_for_date_table')

@section('content')
@include('layouts.headers.title')
<style>
    table tr {
        cursor: pointer;
    }
    .dataTables_filter, .dataTables_info { display: none; }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->


                <div class="card-header border-0">

                    <div class="row">
                        <div class="col">
                            <h2 class="mb-4 " style="font-weight: 600">รายงานการขาย </h2>
                        </div>
                        <div class="col-12 col-md-5  text-md-right">
                        </div>
                    </div>
                </div>

                <hr>
                <div class="row pl-3 pb-2">
                    <div class="col">
                        วันที่เริ่มต้นค้นหา:
                        <input type="text" id="min" name="min" readonly>
                    </div>
                </div>
                <div class="row pl-3 pb-2">
                    <div class="col">
                        วันสิ้นสุดการค้นหา:
                        <input type="text" id="max" name="max" readonly>
                    </div>
                </div>



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
                                <th scope="col">วันที่ขาย</th>
                                <th scope="col">วันที่ขาย</th>
                                <th scope="col">ราคาสุทธิ</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($hold as $row)
                            <tr href="{{url('hold-details/'.$row->holds_id)}}" class="href">
                                <td class="td-center"> {{$loop->index +1 }}</td>
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
                                <td>
                                    {{  date('Y/m/d', strtotime($row->created_at)) }}
                                </td>
                                <td>
                                    {{    formatDateThat( date('Y/m/d', strtotime($row->created_at)) )}}
                                </td>

                                <td>
                                    @php
                                    $detail =
                                    DB::table('hold_details')->where('hold_details_hold_id',$row->holds_id)->get();
                                    $price = 0;
                                    foreach ($detail as $key => $value) {
                                    $price += $value->hold_details_products_amount *
                                    $value->hold_details_products_price;
                                    }
                                    @endphp
                                    {{$price  }}
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="9" class="text-right">
                                    <h4 class="text-red"> <span> ราคาสุทธิทั้งหมด : </span><span id="price"></span> บาท
                                    </h4>
                                </td>
                            </tr>
                        </tfoot>
                    </table>



                </div>


            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

<script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"
    integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/plug-ins/1.11.1/api/sum().js"></script>
<script>
    $('table .href').click(function () {
        window.location = $(this).attr('href');
        return false;
    });

</script>

<script>
    var minDate, maxDate;

    // Custom filtering function which will search data in column four between two values
    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = minDate.val();
            var max = maxDate.val();
            var date = new Date(data[6]);

            if (
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;

        }
    );

    $(document).ready(function () {
       

        minDate = new DateTime($('#min'), {
            format: 'Do MMMM YYYY',
            locale: 'th',
            lang: 'th',
        });

        maxDate = new DateTime($('#max'), {
            format: 'Do MMMM YYYY',
            locale: 'th',
            lang: 'th',
        });

        // DataTables initialisation
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

            "columnDefs": [

                {
                    "targets": 0, // your case first column
                    "className": "text-center",
                },
                {
                    "targets": [6],
                    "visible": false
                }
            ],


        });
        let sum = table.column(8, {
            "filter": "applied"
        }).data().sum()
        $('#price').text(sum);
        // Refilter the table
        $('#min, #max').on('change', function () {

            table.draw();
            let sum = table.column(8, {
                "filter": "applied"
            }).data().sum()
            $('#price').text(sum);
        });
    });

</script>

@endsection
