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
                            <h2 class="mb-4 " style="font-weight: 600">จัดการข้อมูลแท็ก / หมวดหมู่</h2>
                        </div>
                        <div class="col-12 col-md-5  text-md-right">
                            <button type="button" class="btn btn-primary" onclick="showmodal()">เพิ่มข้อมูลแท็ก /
                                หมวดหมู่</button>
        


                                <div class="modal fade" id="mainModal" tabindex="-1" role="dialog" aria-labelledby="mainModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="mainModalLabel">เพิ่มข้อมูลแท็ก / หมวดหมู่</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
        
                                            <form id="mainform" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="control-label">มูลแท็ก / หมวดหมู่:</label>
                                                    <input type="text" class="form-control" id="tags_name" name="tags_name"
                                                        required>
                                                </div>
        
        
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
                </div>

                <hr>
                <div class="table-responsive p-3">
                    <table class="table table-hover table-flush" id="maintable">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับที่</th>
                                <th scope="col">แท็ก / หมวดหมู่</th>
                                <th scope="col">จัดการข้อมูล</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($tags as $row)
                            <tr>
                                <td class="td-center"></td>
                                <td>{{$row->tags_name}}</td>

                                <td class="td-center"><button type="button" class="btn btn-primary btn-sm"
                                        data-id="{{$row->tags_id}}" onclick="editmodal(this)">แก้ไขข้อมูล</button>
                                    <a href="{{url('tags/delete/'.$row->tags_id)}}" class="btn btn-danger btn-sm"
                                        onclick="return confirm('คุณต้องการลบรายการ ? {{$row->tags_name }}')">ลบข้อมูล</a>
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
            $('#mainform').prop('action', "{{route('tags.store')}}");
            $('#mainModal').modal('show');
            $('#tags_name').val('');
        }


        editmodal = (data) => {
            let id = $(data).data('id');
            $('#mainform').prop('action', "{{url('tags/update')}}/" + id);
            $('#mainModal').modal('show');
            $.ajax({
                url: "{{url('tags/get')}}/" + id,
                success: function (response) {
                    $('#tags_name').val(response.tags_name);
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
