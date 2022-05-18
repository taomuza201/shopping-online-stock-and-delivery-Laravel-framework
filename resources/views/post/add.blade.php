@extends('layouts.app')

@section('content')
@include('layouts.headers.title')
<link rel="stylesheet" href="{{asset('images_preview/image-uploader.min.css')}}">
<style>
    img,
    .img-responsive {
        max-width: 100%;
        height: auto;
    }

</style>
<div class="container-fluid mt--6" style="background-color: ">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->

                <div class="card-header border-0">

                    <div class="row">
                        <div class="col">
                            <h2 class="mb-4 " style="font-weight: 600">ประกาศ</h2>
                        </div>

                    </div>
                </div>

                <hr>
                <div class="card-body">

                    <form action="{{url('/post-store')}}" method="POST" enctype="multipart/form-data" id="Mainform">

                        @csrf

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label">หัวข้อประกาศ:</label>
                                    <input type="text" class="form-control" id="products_name" name="products_name"
                                        value="" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label">อัพโหลดรูปประกาศ :</label> <br>
                                    <div class="input-images-1" id="products_photo" style="padding-top: .5rem;"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <center> <button class="btn btn-primary mb-3" style="width: 50%" onclick="count()">ประกาศ</button>
                    </center>
                </div>


            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>


@endsection

@push('js')
<script src="{{asset('images_preview/image-uploader.min.js')}}"></script>

<script src="https://cdn.tiny.cloud/1/96knb3qrcnx6302vv67otnbrjsnch2xswg86g1d3flc4bhyb/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
<script>
    $(document).ready(function () {
        $("input[name='images[]']").attr('required', true);
        $("input[name='images[]']").prop('required', true);
        $("input[name='images[]']").attr('accept', "image/*");
    });


    $('#products_photo').imageUploader();


    function count() {
        var len = $(".uploaded img").length;
        let products_name = $('#products_name').val();
        
        if (len > 5) {
            alert('สามารเลือกรูปสูงสุดได้เพียง 5 รูปเท่านั้น');
        } else {

            if(products_name == '' || len==0){
                alert('กรุณากรอกข้อมูลหัวข้อประกาศ หรือ อัพโหลดรูปภาพ !');
            }
            else{
                $('#Mainform').submit();
            }
           
        }
    }

</script>

@endpush
