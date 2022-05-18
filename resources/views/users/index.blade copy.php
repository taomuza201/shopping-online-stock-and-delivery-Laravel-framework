@extends('layouts.app')

@section('content')
@include('layouts.headers.title')

<div class="container-fluid mt--7">


    <div class="row justify-content-center">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h2 class="mb-4 " style="font-weight: 600">จัดการข้อมูลผู้ใช้งาน </h2>
                </div>
                <div class="col-12 col-md-5  text-right">
                    <button type="button" class="btn btn-primary" onclick="showmodal()">เพิ่มข้อมูลผู้ใช้งาน</button>


                    <div class="modal fade" id="mainModal" tabindex="-1" role="dialog" aria-labelledby="mainModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mainModalLabel">เพิ่มข้อมูลผู้ใช้งาน</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-left">

                                    <form id="mainform" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label">ชื่อ - นามสกุล:</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">อีเมล:</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">รหัสผ่าน:</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                required>
                                        </div>
                                        <label class="control-label">ตำแหน่ง:</label>
                                        <select name="position" id="position" class="form-control" required>
                                            <option value="">กรุณาเลือกตำแหน่ง</option>
                                            <option value="admin">ผู้ดูแลระบบ</option>
                                            <option value="productowner">เจ้าของสินค้า</option>
                                            <option value="sale">เจ้าหน้าที่ฝ่ายขาย</option>
                                        </select>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" class="btn btn-primary">บันทึก</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card shadow ">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

            <div class="card-body">

                <div class="table-responsive pt-3">
                    <table class="table table-hover" id="maintable">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับที่</th>
                                <th scope="col">ชื่อ - นามสกุล</th>
                                <th scope="col">อีเมล</th>
                                <th scope="col">ตำแหน่ง</th>
                                <th scope="col">จัดการข้อมูล</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $row)
                            <tr>
                                <td class="td-center"></td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->position}}</td>
                                <td class="td-center"><button type="button" class="btn btn-primary btn-sm"
                                        data-id="{{$row->id}}" onclick="editmodal(this)">แก้ไขข้อมูล</button>
                                    <a href="{{url('users/delete/'.$row->id)}}" class="btn btn-danger btn-sm"
                                        data-email="{{$row->email}}"
                                        onclick="return confirm('คุณต้องการลบรายการ ? {{$row->name }}')">ลบข้อมูล</a>
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
@include('layouts.footers.auth')
</div>
@endsection

@push('js')

<script>
    let status = 'store';

    $(document).ready(function () {


        showmodal = () => {
            $('#mainform').prop('action', "{{route('users.store')}}");
            $('#mainModal').modal('show');

            $('#name').val('');
            $('#email').val('');
            $('#position').val('');
            $("#password").val('');
            $("#password").prop("required", true);
        }


        editmodal = (data) => {
            let id = $(data).data('id');
            $('#mainform').prop('action', "{{url('users/update')}}/" + id);
            $('#mainModal').modal('show');
            $.ajax({
                url: "{{url('users/get')}}/" + id,
                success: function (response) {
                    $('#name').val(response.name);
                    $('#email').val(response.email)
                    $('#position').val(response.position);
                    $("#password").prop("required", false);
                }
            });
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
