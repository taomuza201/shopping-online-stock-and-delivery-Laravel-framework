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
                            <h2 class="mb-4 " style="font-weight: 600">รายการสินค้าของฉัน</h2>
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

                                <td class="text-center align-middle"> <button type="button" class="btn btn-info"
                                        onclick="editproduct(this)"
                                        data-product_id="{{$row->products_id}}">แก้ไขจำนวนสินค้า</button> </td>




                            </tr>
                            @endforeach

                            <div class="modal fade" id="MainModal" tabindex="-1" role="dialog"
                                aria-labelledby="MainModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="MainModalLabel">New message</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="" id="Mainform">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="col-form-label">แก้ไขจำนวนคงเหลือสินค้า :</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control" id="products_amount"
                                                            name="products_amount" min=0>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">ชื้น</span>
                                                        </div>
                                                        <p class="text-red">** สามารถทำการลดจำนวนสินค้าได้เท่านั้น ถ้าหากต้องการเพิ่มจำนวนสินค้ากรุณาติดต่อแอดมิน</p>
                                                    </div>
                                                </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">ยกเลิก</button>
                                            <button type="submit" class="btn btn-primary">แก้ไขสินค้า</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    function editproduct(data) {
        let product_id = $(data).data('product_id');
        $('#Mainform').attr('action', "{{url('/products-owner/update')}}/" + product_id);
        $.ajax({
            url: "{{url('/products-owner')}}/" + product_id,
            success: function (response) {
            
                $('#MainModalLabel').text(response.products_name);
                $('#products_amount').val(response.products_amount);
                $("#products_amount").attr({
                    "max": response.products_amount,
                });
            }
        });
        $("#MainModal").modal('show');

    }


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
