@extends('layouts.app')

@section('content')
@include('layouts.headers.title')
<style>
    table tr {
        cursor: pointer;
    }

</style>

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->


                <div class="card-header border-0">

                    <div class="row">
                        <div class="col">
                            <h2 class="mb-4 " style="font-weight: 600">รายการสินค้าทั้งหมด</h2>
                        </div>
                        <div class="col-12 col-md-5  text-md-right">
                            {{-- <a  href="proposal-store"" class="btn btn-primary"  style="color: #fff">เพิ่มข้อมูลเสนอรายการสินค้า</a> --}}

                        </div>
                    </div>
                </div>

                <hr>
                <div class="table-responsive p-3">
                    <table class="table table-hover table-flush" id="maintable">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับที่</th>
                                <th scope="col">รูปสินค้า</th>
                                <th scope="col">ชื่อสินค้า</th>
                                <th scope="col">จำนวนคงเหลือ</th>
                                <th scope="col">ราคาขาย</th>
                                <th scope="col">จัดการข้อมูลสินค้า</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($product as $row)
                            <tr>
                                <td class="td-center align-middle link" href=""></td>
                                <td class="td-center align-middle link"> <img
                                        src="{{asset('uploads_image/'.$row->products_cover_photo)}}"
                                        style="height: 80px;"></td>
                                <td class="text-right align-middle link" href="">{{$row->products_name}} </td>
                                <td class="text-right align-middle link" href="">{{$row->products_amount}} ชิ้น.</td>
                                <td class="text-right align-middle link" href="">{{$row->products_price}} บาท.</td>

                                <td class="text-center align-middle"> <a type="button" class="btn btn-info"
                                        href="{{url('/products/edit/'.$row->products_id)}}">แก้ไขข้อมูลสินค้า</a> </td>

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
