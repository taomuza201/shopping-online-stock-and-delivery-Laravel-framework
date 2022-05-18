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
                            <h2 class="mb-4 " style="font-weight: 600">รายการร้องขออนุญาติขายสินค้า</h2>
                        </div>
                        <div class="col-12 col-md-5  text-md-right">
                            <a  href="proposal-store"" class="btn btn-primary"  style="color: #fff">เพิ่มข้อมูลเสนอรายการสินค้า</a>
        
                        </div>
                    </div>
                </div>

                <hr>
                <div class="table-responsive p-3">
                    <table class="table table-hover table-flush" id="maintable">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับที่</th>
                                <th scope="col">ชื้อสินค้า</th>
                                <th scope="col">ราคาต้นทุน</th>
                                <th scope="col">ราคาขาย</th>
                                <th scope="col">รายละเอียดสินค้า</th>
                                <th scope="col">สถานะ</th>
                               
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($proposal as $row)
                            <tr  href="{{url('proposal-detail/'.$row->proposals_id)}}">
                                <td class="td-center"></td>
                                <td>{{$row->proposals_name}}</td>
                                <td class="text-right">{{$row->proposals_price_cost}} บาท.</td>
                                <td class="text-right">{{$row->proposals_price}} บาท.</td>
                                <td>
                                    <div data-toggle="tooltip" data-placement="top" title=" {{$row->proposals_about}}">
                                        {{ \Illuminate\Support\Str::limit($row->proposals_about, 30, $end='...') }}
                            
                                        </div>  
                                   
                                </td>
                                <td class="text-center">
                                    @if ($row->proposals_status == 1)
                                    <span class="badge badge-info">อยู่ระหว่างตรวจสอบคำร้อง</span>
                                    @elseif ($row->proposals_status == 2)
                                    <span class="badge badge-default" style="color: rgb(73, 70, 70)">ผ่านการตรวจสอบ/อยู่ระหว่างดำเดินการเพิ่มสินค้าเข้าสู่ระบบ</span>
                                    @elseif ($row->proposals_status == 3)
                                    <span class="badge badge-warning">อยู่ระหว่างการแก้ไข</span>
                                    @elseif ($row->proposals_status == 4)
                                    <span class="badge badge-danger">ไม่อนุมัติ</span>
                                    @elseif ($row->proposals_status == 5)
                                    <span class="badge badge-success">เพิ่มสินค้าเข้าสู่ระบบสำเร็จ</span>
                                    @endif
                                    {{-- <span class="badge badge-default">Default</span>

                                    <span class="badge badge-primary">Primary</span>
                                    
                                    <span class="badge badge-secondary">Secondary</span>
                                    
                                    <span class="badge badge-info">Info</span>
                                    
                                    <span class="badge badge-success">Success</span>
                                    
                                    <span class="badge badge-danger">Danger</span>
                                    
                                    <span class="badge badge-warning">Warning</span> --}}
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


    $(document).ready(function () {

        $('table tr').click(function(){
        window.location = $(this).attr('href');
        return false;
    });

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
