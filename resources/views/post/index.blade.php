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
                            <h2 class="mb-4 " style="font-weight: 600">ประกาศ </h2>
                        </div>
                        <div class="col-12 col-md-5  text-md-right">
                            <a class="btn btn-primary" href="{{route('post.create')}}">เพิ่มประกาศ</a>



                        </div>
                    </div>
                </div>

                <hr>
                <div class="table-responsive p-3">
                    <table class="table table-hover table-flush" id="maintable">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับที่</th>
                                <th scope="col">หัวข้อประกาศ</th>
                                <th scope="col">จัดการข้อมูล</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($product as $row)
                            <tr>
                                <td class="td-center"></td>
                                <td>{{$row->products_name}}</td>

                                <td class="td-center">
                                    <a href="{{url('post/edit/'.$row->products_id)}}" class="btn btn-primary btn-sm"
                                    >แก้ไขข้อมูล</a>
                                <a href="{{url('post/delete/'.$row->products_id)}}" class="btn btn-danger btn-sm"
                                    onclick="return confirm('คุณต้องการลบรายการ ? {{$row->products_name }}')">ลบข้อมูล</a>
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
