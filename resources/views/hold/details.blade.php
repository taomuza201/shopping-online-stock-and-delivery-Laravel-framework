@extends('layouts.app')

@section('content')
@include('layouts.headers.title')
<style>
    .requiredStar {
        color: #FF0000;
        padding-right: 10px;
        padding-top: 5px;
    }

    .input-block-level {
        display: block;
        width: 100%;
        min-height: 30px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    /** added this CSS code */
    .inline1 {
        display: flex;
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
                        <div class="col-12 col-md-8 ">
                            <h2 class="mb-4 " style="font-weight: 600">รายละเอียดคำสั่งซื้อ </h2>
                        </div>
                        <div class="col-12 col-md-4 text-md-right   text-center pb-2 "> 
                            @if ($hold->holds_status == 'start')
                            <button type="button" class="btn btn-info btn-block"onclick="showmodal()">เพิ่มรายการสินค้า</button>
                            @endif
                            @if ($hold->holds_status != 'start' && $hold->holds_status != 'n2'&& $hold->holds_status != 'p2')
                         <a href="{{url('hold/printbill/'.$hold->holds_id)}}" target="_blank">     <button type="button" class="btn btn-success ">พิมพ์ใบเสร็จ</button>  </a>
                         {{-- <a href="http://">    <button type="button" class="btn btn-success "onclick="printbill()">พิมพ์ใบเสร็จ</button>  </a> --}}
                         <a href="{{url('hold/printdelivery/'.$hold->holds_id)}}" target="_blank"> <button type="button" class="btn btn-default ">พิมพ์ใบส่งของ</button> </a>
                            @endif
                       

                            <div class="modal fade" id="mainModal" role="dialog" aria-labelledby="mainModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="mainModalLabel">เพิ่มรายการสินค้า</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">

                                            <form id="mainform" method="POST" action="{{route('hold.store_details')}}">
                                                @csrf

                                                <div class="form-group">
                                                    <label class="control-label">รายการสินค้า</label>

                                                    <select id="hold_details_products_id"
                                                        name="hold_details_products_id" class="form-control" required
                                                        style="width: 100%">
                                                        <option value="">กรุณาเลือกรายการสินค้า</option>
                                                        @foreach ($product as $row)
                                                        <option value="{{$row->products_id}}">{{$row->products_name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-form-label">รูปสินค้า :</label> <br>
                                                    <center> <img src="{{ asset('img/none.png') }}"
                                                            id="products_cover_photo" class="img-fluid img-responsive">
                                                    </center>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">ราคา :</label>
                                                    <span id="products_price"></span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">จำนวนคงเหลือ : </label>
                                                    <span id="products_amount"></span>
                                                </div>
                                                <hr>

                                                <div class="form-group">
                                                    <label class="col-form-label">จำนวนที่ต้องการซื้อ :</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control" min="0"
                                                            name="hold_details_products_amount" value=""
                                                            id="hold_details_products_amount" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">ชิ้น</span>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">ยกเลิก</button>
                                            <input type="hidden" name="holds_id" value="{{$hold->holds_id}}">
                                            <button type="submit" class="btn btn-primary" @if ($hold->holds_id !=
                                                'start')

                                                @endif>เพิ่มรายการสินค้า</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">เลขที่คำสั่งซื้อ : {{$hold->holds_code}}</div>
                        <div class="col-12  col-md-6">ชื่อผู้สั่งซื้อ : {{$hold->holds_name}}</div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-12 col-md-6">เบอร์โทร : {{$hold->holds_tel}}</div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-12 col-md-12">รายละเอียด : {{$hold->holds_detail}}</div>
                    </div>
                    <hr class="mt-2 pb-2">
                    <div class="row pt-2">

                        @include('hold.status')

                    </div>


                    @if ($hold->holds_status != 'start' )

                    <H3>ข้อมูลที่อยู่การจัดส่ง</H3>

                    <div class="row">

                        <div class="col-12 col-md-4">
                            <div class="form-group row pl-3">
                                <label for="inputEmail3" class="col-form-label col">บ้านเลขที่ : </label>
                                <div class="col-12  col-md-9">
                                    <input type="text" class="form-control" name="house_number" id="house_number" 
                                    @if($hold->holds_status != 'n2' && $hold->holds_status != 'p2' )
                                    disabled
                                    @endif
                                    value="{{$hold->holds_house_number}}">
                                </div>

                            </div>

                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group row pl-3">
                                <label for="inputEmail3" class="col-form-label col">หมู่ : </label>
                                <div class="col-12  col-md-9">
                                    <input type="text" class="form-control" name="village" id="village" 
                                    @if($hold->holds_status != 'n2' && $hold->holds_status != 'p2' )
                                    disabled
                                    @endif
                                    value="{{$hold->holds_village}}">
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group row pl-3">
                                <label for="inputEmail3" class="col-form-label col">ซอย : </label>
                                <div class="col-12  col-md-9">
                                    <input type="text" class="form-control" name="alley" id="alley" 
                                    @if($hold->holds_status != 'n2' && $hold->holds_status != 'p2' )
                                    disabled
                                    @endif
                                    value="{{$hold->holds_alley}}">
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="row">

                        <div class="col-12 col-md-4">
                            <div class="form-group row pl-3">
                                <label for="inputEmail3" class="col-form-label col">ถนน : </label>
                                <div class="col-12  col-md-9">
                                    <input type="text" class="form-control" name="road" id="road"
                                        @if($hold->holds_status != 'n2' && $hold->holds_status != 'p2' )
                                    disabled
                                    @endif
                                    value="{{$hold->holds_road}}">
                                </div>

                            </div>

                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group row pl-3">
                                <label for="inputEmail3" class="col-form-label col">จังหวัด : </label>
                                <div class="col-12  col-md-9">

                                    <select class="form-control" id="provinces" name="provinces" 
                                    @if($hold->holds_status != 'n2' && $hold->holds_status != 'p2' )
                                        disabled
                                        @endif>
                                        @foreach ($provinces as $row )
                                        <option value="{{$row->id}}" @if ($hold->holds_provinces == $row->id)
                                            selected
                                            @endif>{{$row->name_th}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group row pl-3">
                                <label for="inputEmail3" class="col-form-label col">อำเภอ : </label>
                                <div class="col-12  col-md-9">
                                    <select class="form-control" id="amphures" name="amphures" @if ($hold->holds_status
                                        != 'n2' && $hold->holds_status != 'p2' )
                                        disabled
                                        @endif>
                                        @include('hold.amphures')
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="row">

                        <div class="col-12 col-md-4">
                            <div class="form-group row pl-3">
                                <label for="inputEmail3" class="col-form-label col">ตำบล : </label>
                                <div class="col-12  col-md-9">
                                    <input type="text" class="form-control" name="districts" id="districts"
                                        value="{{$hold->holds_districts}}" @if ($hold->holds_status != 'n2' &&
                                    $hold->holds_status != 'p2' )
                                    disabled
                                    @endif>
                                </div>

                            </div>

                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group row pl-3">
                                <label for="inputEmail3" class="col-form-label col">รหัสไปรษณีย์ </label>
                                <div class="col-12  col-md-9">
                                    <input type="text" class="form-control" name="zip_code" id="zip_code"
                                        value="{{$hold->holds_zip_code}}" @if ($hold->holds_status != 'n2' &&
                                    $hold->holds_status != 'p2' )
                                    disabled
                                    @endif>
                                </div>
                            </div>

                        </div>

                    </div>
                    @endif
                    @if ( $hold->holds_status == 'p3' )
                    <hr class="mt-3 mb-2">
                    <H3>อัพโหลดหลังฐานการโอนเงิน</H3>
                    <div class="col-12 col-md-4">
                        <form action="{{url('hold/upload_file_status/p4/'.$hold->holds_id)}}" method="post"
                            id="forn_holds_slip_pay" enctype="multipart/form-data">
                            <div class="form-group row ">
                                <label for="inputEmail3" class="col-form-label col">อัพโหลดไฟล์ : </label>
                                <div class="col-12  col-md-9">
                                    <input type="file" class="form-control" name="holds_slip_pay" id="holds_slip_pay"
                                        value="{{$hold->holds_slip_pay}}" accept="image/*" @if ($hold->holds_status !=
                                    'p3' ) disabled
                                    @endif>
                                </div>

                            </div>

                    </div>
                    <center> <img src="{{ asset('img') }}/none.png" id="holds_slip_pay_img" style="width: 300px"
                            class="img-fluid img-responsive"> </center>

                    @csrf
                    </form>
                    @endif

                    @if ($hold->holds_status == 'p4'|| $hold->holds_status == 'p5' || $hold->holds_status == 'p6'
                    ||$hold->holds_status == 'p7' ||$hold->holds_status == 'p8'
                    ||$hold->holds_status == 'p9'|| $hold->holds_status == 'p10' || $hold->holds_status == 'p11')
                    <hr class="mt-3 mb-2">
                    <H3>หลังฐานการโอนเงิน</H3>
                    <center> <img src="{{ asset('uploads_image/'.$hold->holds_slip_pay) }}" style="width: 300px"
                            class="img-fluid img-responsive"> </center>
                    @endif

                    @if ($hold->holds_status != 'start' && $hold->holds_status != 'n2' && $hold->holds_status != 'n3' &&
                    $hold->holds_status != 'p2' && $hold->holds_status != 'p3' && $hold->holds_status != 'p4' )


                    <hr class="mt-3 mb-2">
                    <H3>ข้อมูลเลขขนส่ง</H3>
                    <div class="col-12 col-md-4">
                        <div class="form-group row ">
                            <label for="inputEmail3" class="col-form-label col">เลขขนส่ง : </label>
                            <div class="col-12  col-md-9">
                                <input type="text" class="form-control" name="holds_transport_number"
                                    id="holds_transport_number" value="{{$hold->holds_transport_number}}" 
                                    @if ($hold->holds_status != 'n4' &&
                                $hold->holds_status != 'p5' ) disabled
                                @endif>
                            </div>

                        </div>

                    </div>
                    @endif


                    @if ($hold->holds_status =='n9'|| $hold->holds_status == 'p10' )

                    <hr class="mt-3 mb-2">
                    <H3>อัพโหลดหลังฐานการโอนเงินให้เจ้าของผลิตภัณท์</H3>
                    <div class="col-12 col-md-4">
                        @if ($hold->holds_status =='n9')
                        <form action="{{url('hold/upload_file_status/n10/'.$hold->holds_id)}}" method="post"
                            id="forn_holds_slip_to_owner" enctype="multipart/form-data">
                            @else
                            <form action="{{url('hold/upload_file_status/p11/'.$hold->holds_id)}}" method="post"
                                id="forn_holds_slip_to_owner" enctype="multipart/form-data">
                                @endif
                                <div class="form-group row ">
                                    <label for="inputEmail3" class="col-form-label col">อัพโหลดไฟล์ : </label>
                                    <div class="col-12  col-md-9">
                                        <input type="file" class="form-control" name="holds_slip_to_owner"
                                            id="holds_slip_to_owner" value="{{$hold->holds_slip_to_owner}}"
                                            accept="image/*">
                                    </div>

                                </div>

                    </div>
                    <center> <img src="{{ asset('img') }}/none.png" id="holds_slip_to_owner_img" style="width: 300px"
                            class="img-fluid img-responsive"> </center>

                    @csrf
                    </form>
                    @endif

                    @if ($hold->holds_status == 'n10' || $hold->holds_status == 'p11')
                    <hr class="mt-3 mb-2">
                    <H3>หลังฐานการโอนเงินให้เจ้าของผลิตภัณท์</H3>
                    <center> <img src="{{ asset('uploads_image/'.$hold->holds_slip_to_owner) }}" style="width: 300px"
                            class="img-fluid img-responsive"> </center>
                    @endif


                    <div class="table-responsive p-3">
                      @include('hold.fetch')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="hold_id" id="hold_id" value="{{$hold->holds_id}}">
    <input type="hidden" name="hold_now_status" id="hold_now_status" value="{{$hold->holds_status}}">

    @include('layouts.footers.auth')
</div>



<div class="modal fade" id="editmodal" role="dialog" aria-labelledby="editmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editmodalLabel">แก้ไขข้อมูลการสั่งซื้อ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">

                <form id="editorm" method="POST" action="">
                    @csrf
                    <center><h4 id="product_name_show"></h4></center>
            
                    <div class="form-group">
                        <label class="col-form-label">รูปสินค้า :</label> <br>
                        <center> <img src="{{ asset('img/none.png') }}"
                                id="products_cover_photo_show" class="img-fluid img-responsive">
                        </center>
                    </div>

                    <div class="form-group">
                        <label class="control-label">ราคา :</label>
                        <span id="products_price_show"></span>
                    </div>

                    <div class="form-group">
                        <label class="control-label">จำนวนคงเหลือ : </label>
                        <span id="products_amount_show"></span>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-form-label">แก้ไขจำนวนที่ต้องการซื้อ :</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control text-right"
                                name="hold_details_products_amount_edit" value="" id="hold_details_products_amount_edit"
                                required min="1">
                            <div class="input-group-append">
                                <span class="input-group-text">ชิ้น</span>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>

                <button type="submit" class="btn btn-primary">เพิ่มรายการสินค้า</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

<script>
    let status = 'store';

    $(document).ready(function () {

         

        $('#provinces').change(function (e) {
            let hold_id = $('#hold_id').val();
            let id = $('#provinces').children("option:selected").val();


            $.ajax({
                url: "{{url('amphures')}}/" + id + '?hold_id=' + hold_id,
                success: function (data) {

                    $('#amphures').html(data);

                }
            });

        });
        backstatus = () =>{
            let hold_id = $('#hold_id').val();
            let hold_now_status = $('#hold_now_status').val()
            let  status = '';

            switch(hold_now_status) {
            case 'n2':
                status = 'start';
                break;
            case 'n3':
                status = 'n2';
                break;
            case 'n4':
                status = 'n3';
                break;
            case 'n5':
                status = 'n4';
                break;
            case 'n6':
                 status = 'n5';
                break;
            case 'n7':
            status = 'n6';
                break;
            case 'n8':
            status = 'n7';
                break;
            case 'n9':
            status = 'n8';
                break;
            case 'p2':
                status = 'start';
                break;
            case 'p3':
            status = 'p2';
                break;
            case 'p4':
            status = 'p3';
                break;
            case 'p5':
            status = 'p4';
                break;
            case 'p6':
            status = 'p5';
                break;
            case 'p7':
            status = 'p6';
                break;
            case 'p8':
            status = 'p7';
                break;
            case 'p9':
            status = 'p8';
                break;
            case 'p10':
            status = 'p9';
                break;
          
            }

            if (confirm("คุณต้องการเปลี่ยนสถานะ?")) {

                $.ajax({
                    url: "{{url('hold/blackstatus')}}" + '/' + status + '/' + hold_id,
                    success: function (response) {

                        location.reload();
                    }
                });
                }
        }

        changestatus = () => {
            let status = $('#status').children("option:selected").val();

            var hold_now_status = $('#hold_now_status').val()

            let hold_id = $('#hold_id').val();

            if (status == 'n2' && hold_now_status == 'start' || status == 'p2' &&
                hold_now_status ==
                'start') { 

                             $.ajax({
                            url: "{{url('check_order')}}/" + hold_id,
                            success: function (response) {
                       
                              if(response=='yes'){
                                alert('กรุณาตรวจสอบรายการสินค้า');
                              }else{

                                var rowCount = $('#maintable tr').length;

                            if(rowCount==1){
                                alert('กรุณาเลือกรายการสินค้า');
                            }else{
                                if (confirm("คุณต้องการเปลี่ยนสถานะ?")) {

                                            $.ajax({
                                                url: "{{url('hold/status')}}" + '/' + status + '/' + hold_id,
                                                success: function (response) {

                                                    location.reload();
                                                }
                                            });
                                            }
                            }

                                

                              }
                            }
                        });
                        
            } else {
                if (status == 'start') {
                    $.ajax({
                            url: "{{url('check_order')}}/" + hold_id,
                            success: function (response) {
              
                              if(response=='yes'){
                                alert('กรุณาตรวจสอบรายการสินค้า');
                              }else{
                                alert('กรุณาเลือกวิธีการชำระเงิน');
                              }
                            }
                        });
                
                }
            }


            if (hold_now_status != 'start') {

                switch (status) {
                    case 'p2':
                        let house_number = $('#house_number').val();
                        let village = $('#village').val();
                        let alley = $('#alley').val(); //ซอย
                        let road = $('#road').val();
                        let provinces = $('#provinces').val();
                        let amphures = $('#amphures').val();
                        let districts = $('#districts').val();
                        let zip_code = $('#zip_code').val();
                        if (house_number != '' && village != '' && alley != '' && road != '' &&
                            provinces !=
                            '' && amphures != '' && districts != '' && zip_code != '') {


                            if (confirm("คุณต้องการเปลี่ยนสถานะ?")) {

                                $.ajax({
                                    url: "{{url('hold/status')}}" + '/p3/' + hold_id +
                                        '?house_number=' + house_number + '&&village=' +
                                        village +
                                        '&&alley=' + alley + '&&road=' + road +
                                        '&&provinces=' +
                                        provinces + '&&amphures=' + amphures +
                                        '&&districts=' +
                                        districts + '&&zip_code=' + zip_code,
                                    success: function (response) {
                                        location.reload();
                                    }
                                });
                            }

                        } else {
                            alert('กรุณากรอกข้อมูลให้ครบถ้วน !!');
                            $('#house_number').focus();
                        }
                        break;
                    case 'p3':
                        let holds_slip_pay = $('#holds_slip_pay').val();
                        if (holds_slip_pay == '') {
                            alert('กรุณาเลือกไฟล์หลังฐานการโอนเงิน');
                        } else {
                            if (confirm("คุณต้องการเปลี่ยนสถานะ?")) {
                                $('#forn_holds_slip_pay').submit();
                            }
                        }
                        break;
                    case 'p4':
                        if (confirm("คุณต้องการเปลี่ยนสถานะ?")) {
                            $.ajax({
                                url: "{{url('hold/status')}}" + '/p5/' + hold_id,
                                success: function (response) {
                                    location.reload();
                                }
                            });
                        }
                        break;
                    case 'p5':
                        let holds_transport_number = $('#holds_transport_number').val();
                        if (holds_transport_number == '') {
                            alert('กรุณากรอกเลขขนส่ง');
                            $('#holds_transport_number').focus();
                        } else {
                            if (confirm("คุณต้องการเปลี่ยนสถานะ?")) {
                                $.ajax({
                                    url: "{{url('hold/status')}}" + '/p6/' + hold_id +
                                        '?holds_transport_number=' + holds_transport_number,
                                    success: function (response) {
                                        location.reload();
                                    }
                                });
                            }
                        }
                        break;
                    case 'p6':
                        if (confirm("คุณต้องการเปลี่ยนสถานะ?")) {
                            $.ajax({
                                url: "{{url('hold/status')}}" + '/p7/' + hold_id,
                                success: function (response) {
                                    location.reload();
                                }
                            });
                        }
                        break;
                    case 'p7':
                        if (confirm("คุณต้องการเปลี่ยนสถานะ?")) {
                            $.ajax({
                                url: "{{url('hold/status')}}" + '/p8/' + hold_id,
                                success: function (response) {
                                    location.reload();
                                }
                            });
                        }
                        break;
                    case 'p8':
                        if (confirm("คุณต้องการเปลี่ยนสถานะ?")) {
                            $.ajax({
                                url: "{{url('hold/status')}}" + '/p9/' + hold_id,
                                success: function (response) {
                                    location.reload();
                                }
                            });
                        }
                        break;
                    case 'p9':
                        if (confirm("คุณต้องการเปลี่ยนสถานะ?")) {
                            $.ajax({
                                url: "{{url('hold/status')}}" + '/p10/' + hold_id,
                                success: function (response) {
                                    location.reload();
                                }
                            });
                        }
                        break;
                    case 'p10':
                        let holds_slip_to_owner = $('#holds_slip_to_owner').val();
                        if (holds_slip_to_owner == '') {
                            alert('กรุณาเลือกไฟล์หลังฐานการโอนเงิน');
                        } else {
                            if (confirm("คุณต้องการเปลี่ยนสถานะ?")) {
                                $('#forn_holds_slip_to_owner').submit();
                            }
                        }
                        break;
                }



                switch (status) {
                    case 'n2':
                        let house_number = $('#house_number').val();
                        let village = $('#village').val();
                        let alley = $('#alley').val(); //ซอย
                        let road = $('#road').val();
                        let provinces = $('#provinces').val();
                        let amphures = $('#amphures').val();
                        let districts = $('#districts').val();
                        let zip_code = $('#zip_code').val();
                        if (house_number != '' && village != '' && alley != '' && road != '' &&
                            provinces !=
                            '' && amphures != '' && districts != '' && zip_code != '') {


                            if (confirm("คุณต้องการเปลี่ยนสถานะ?")) {

                                $.ajax({
                                    url: "{{url('hold/status')}}" + '/n3/' + hold_id +
                                        '?house_number=' + house_number + '&&village=' +
                                        village +
                                        '&&alley=' + alley + '&&road=' + road +
                                        '&&provinces=' +
                                        provinces + '&&amphures=' + amphures +
                                        '&&districts=' +
                                        districts + '&&zip_code=' + zip_code,
                                    success: function (response) {
                                        location.reload();
                                    }
                                });
                            }

                        } else {
                            alert('กรุณากรอกข้อมูลให้ครบถ้วน !!');
                            $('#house_number').focus();
                        }
                        break;
                    case 'n3':
                        if (confirm("คุณต้องการเปลี่ยนสถานะ?")) {
                            $.ajax({
                                url: "{{url('hold/status')}}" + '/n4/' + hold_id,
                                success: function (response) {
                                    location.reload();
                                }
                            });
                        }
                        break;
                    case 'n4':
                        let holds_transport_number = $('#holds_transport_number').val();
                        if (holds_transport_number == '') {
                            alert('กรุณากรอกเลขขนส่ง');
                            $('#holds_transport_number').focus();
                        } else {
                            if (confirm("คุณต้องการเปลี่ยนสถานะ?")) {
                                $.ajax({
                                    url: "{{url('hold/status')}}" + '/n5/' + hold_id +
                                        '?holds_transport_number=' + holds_transport_number,
                                    success: function (response) {
                                        location.reload();
                                    }
                                });
                            }
                        }

                        break;
                    case 'n5':
                        if (confirm("คุณต้องการเปลี่ยนสถานะ?")) {
                            $.ajax({
                                url: "{{url('hold/status')}}" + '/n6/' + hold_id,
                                success: function (response) {
                                    location.reload();
                                }
                            });
                        }
                        break;
                    case 'n6':
                        if (confirm("คุณต้องการเปลี่ยนสถานะ?")) {
                            $.ajax({
                                url: "{{url('hold/status')}}" + '/n7/' + hold_id,
                                success: function (response) {
                                    location.reload();
                                }
                            });
                        }
                        break;
                    case 'n7':
                        if (confirm("คุณต้องการเปลี่ยนสถานะ?")) {
                            $.ajax({
                                url: "{{url('hold/status')}}" + '/n8/' + hold_id,
                                success: function (response) {
                                    location.reload();
                                }
                            });
                        }
                        break;
                    case 'n8':
                        if (confirm("คุณต้องการเปลี่ยนสถานะ?")) {
                            $.ajax({
                                url: "{{url('hold/status')}}" + '/n9/' + hold_id,
                                success: function (response) {
                                    location.reload();
                                }
                            });
                        }

                        break;
                    case 'n9':

                        let holds_slip_to_owner = $('#holds_slip_to_owner').val();
                        if (holds_slip_to_owner == '') {
                            alert('กรุณาเลือกไฟล์หลังฐานการโอนเงิน');
                        } else {
                            if (confirm("คุณต้องการเปลี่ยนสถานะ?")) {
                                $('#forn_holds_slip_to_owner').submit();
                            }
                        }
                        break;

                }
            }


        }


        $('#hold_details_products_id').select2();

        $('#hold_details_products_id').change(function (e) {


            let id = $(this).children("option:selected").val();

            if (id == '') {
                $('#products_price').text('');
                $('#products_amount').text('');
                $('#hold_details_products_amount').val('');
                $('#products_cover_photo').attr("src", "../img/none.png");


            } else {
                $.ajax({

                    url: "{{url('showproduct')}}" + '/' + id,

                    success: function (response) {
                        $('#hold_details_products_amount').attr('max', response
                            .products_amount);

                        $('#products_price').text(response.products_price);
                        $('#products_amount').text(response.products_amount);
                        $('#products_cover_photo').attr("src",
                            "../uploads_image/" +
                            response
                            .products_cover_photo);


                    }
                });
            }


        });


        showmodal = () => {

            $('#mainModal').modal('show');

            $('#name').val('');
            $('#email').val('');
            $('#position').val('');
            $("#password").val('');
            $("#password").prop("required", true);
        }

        
        printbill = () => {
            let hold_id = $('#hold_id').val();
            $.ajax({
               
                url: "{{url('hold/printbill')}}/"+hold_id,

                success: function (response) {
                    
                }
            });
        }

           
        printdelivery = () => {
            let hold_id = $('#hold_id').val();
            $.ajax({
               
                url: "{{url('hold/printdelivery')}}/"+hold_id,

                success: function (response) {
                    
                }
            });
        }

        editmodal = (data) => {

            let id = $(data).data('id');
            $('#editorm').attr('action', "{{url('/update_details')}}/" + id);
            $('#editmodal').modal('show');
            $.ajax({
                url: "{{url('showproduct_detail')}}" + '/' + id,
                success: function (response) {
                    console.log(response)

                    
                    $('#hold_details_products_amount_edit').attr('max', response[1]
                        .products_amount);

                    $('#hold_details_products_amount_edit').val(response[0]
                        .hold_details_products_amount);

                        
                        $('#products_cover_photo_show').attr("src",
                            "../uploads_image/" +
                            response[1]
                            .products_cover_photo);
                        $('#products_price_show').text(response[1]
                        .products_price);
                        $('#products_amount_show').text(response[1]
                        .products_amount);
                        $('#product_name_show').text(response[1]
                        .products_name);
                }
            });
        }

        // var table = $('#maintable').DataTable({
        //     "ordering": false,
        //     "language": {
        //         "search": "ค้นหา :",
        //         "paginate": {
        //             "first": "หน้าแรก",
        //             "last": "หน้าสุดท้าย",
        //             "next": "หน้าถัดไป",
        //             "previous": "ก่อนหน้า",

        //         },
        //         "info": "แสดงข้อมูล _START_ ถึง _END_ จากข้อมูลทั้งหมด _TOTAL_ รายการ",
        //         "infoFiltered": '',
        //         "infoEmpty": "แสดงข้อมูลทั้งหมด 0  รายการ",
        //         "lengthMenu": "แสดง _MENU_ รายการ",
        //         "zeroRecords": "ไม่มีรายการ",
              
        //     },

        //     "columnDefs": [{
        //             "targets": [2],
        //             "searchable": false
        //         },
        //         {
        //             "targets": 0, 
        //             "className": "text-center",
        //         },
        //     ],


        // });

        // table.on('order.dt search.dt', function () {
        //     table.column(0, {
        //         search: 'applied',
        //         order: 'applied'
        //     }).nodes().each(function (cell, i) {
        //         cell.innerHTML = i + 1;
        //     });


        // }).draw();
        // $('#search').keyup(function () {

        //     table.search($(this).val()).draw();
        // })




    });



    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#holds_slip_to_owner_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#holds_slip_to_owner").change(function () {
        readURL(this);
    });

    function readURLPay(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#holds_slip_pay_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#holds_slip_pay").change(function () {
        readURLPay(this);
    });

</script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
