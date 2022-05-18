@extends('layouts.app')

@section('content')
@include('layouts.headers.title')
<style>
    img,.img-responsive{
    max-width: 100%;
    height: auto;
}
</style>

@if ($proposals->proposals_status == 3)
<div class="container-fluid mt--6"  >
@else



        <style>
            input,textarea,select,button ,.select2 {
            pointer-events: none;
            opacity: 0.7;
        } 
        </style>
      <div class="container-fluid mt--6 "  >      
@endif

    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->


                <div class="card-header border-0">

                    <div class="row">
                        <div class="col">
                            <h2 class="mb-4 " style="font-weight: 600">เสนอรายการสินค้า      @if ($proposals->proposals_status == 1)
                                <span class="badge badge-info">อยู่ระหว่างตรวจสอบคำร้อง</span>
                                @elseif ($proposals->proposals_status == 2)
                                <span class="badge badge-default" style="color: rgb(73, 70, 70)">ผ่านการตรวจสอบ/อยู่ระหว่างดำเดินการเพิ่มสินค้าเข้าสู่ระบบ</span>
                                @elseif ($proposals->proposals_status == 3)
                                <span class="badge badge-warning">อยู่ระหว่างการแก้ไข</span>
                                @elseif ($proposals->proposals_status == 4)
                                <span class="badge badge-danger">ไม่อนุมัติ</span>
                                @elseif ($proposals->proposals_status == 5)
                                <span class="badge badge-success">เพิ่มสินค้าเข้าสู่ระบบสำเร็จ</span>
                                @endif</h2>
                        </div>

                    </div>
                </div>

                <hr>
                <div class="card-body">

                    <form action="{{url('proposal-update/'.$proposals->proposals_id)}}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label">ชื่อสินค้า :</label>
                                    <input type="text" class="form-control" id="proposals_name" name="proposals_name" value="{{$proposals->proposals_name}}"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label">ราคาต้นทุน :</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" name="proposals_price_cost"  value="{{$proposals->proposals_price_cost}}"
                                            id="proposals_price_cost" required min="1">
                                        <div class="input-group-append">
                                            <span class="input-group-text">บาท</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label">ราคาที่ต้องการขาย :</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" name="proposals_price" value="{{$proposals->proposals_price}}"
                                            id="proposals_price" required min="1">
                                        <div class="input-group-append">
                                            <span class="input-group-text">บาท</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label">จำนวนสินค้า :</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" name="proposals_amount"  value="{{$proposals->proposals_amount}}"
                                            id="proposals_amount" required min="1">
                                        <div class="input-group-append">
                                            <span class="input-group-text">ชิ้น</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label">รายละเอียดรายการสินค้า :</label>
                                    <textarea name="proposals_about" id="proposals_about" rows="5"
                                        style="min-height: 100px;" required class="form-control">{{$proposals->proposals_about}}</textarea>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label">รูปปกสินค้า :</label> <br>
                                    <center> <img src="{{ asset('uploads_image') }}/{{$proposals->proposals_cover_photo}}" id="show_proposals_cover_photo"
                                            class="img-fluid img-responsive"> </center>
                                    <br>
                                    <input type="file" name="proposals_cover_photo" id="proposals_cover_photo" 
                                        class="form-control" accept="image/*">
                                </div>
                            </div>
                        </div>



                        <hr>
                        <div class="row">
                            <div class="col">

                                <label class="col-form-label">ความเป็นมา :</label> <br>
                                <textarea name="proposals_story" id="proposals_story" rows="20" required>{{$proposals->proposals_story}}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label class="col-form-label">แท็ก / หมวดหมู่ :</label>
                                <div class="input-group mb-3">
                                    <select name="tags[]" id="tags" class="form-control" multiple="multiple" required>
                                        @foreach ($tags as $tags)
                                        <option value="{{$tags->tags_id}}">{{$tags->tags_name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <center> <button class="btn btn-primary mb-3" type="submit"
                                style="width: 50%">บันทึก</button>
                        </center>

                </div>
                </form>

                <input type="hidden" name="check_status" id="check_status" value="{{$proposals->proposals_status}}">
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>


@endsection

@push('js')


<script src="https://cdn.tiny.cloud/1/96knb3qrcnx6302vv67otnbrjsnch2xswg86g1d3flc4bhyb/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
<script>
  var status =$('#check_status').val()

    tinymce.init({
        selector: '#proposals_story',
        language: 'th_TH',
  
        content_css: "{{asset('assets/css/tinymce.css')}}",
        image_class_list: [{
            title: 'img-responsive',
            value: 'img-responsive'
        }, ],
        height: 900,
        setup: function (editor) {
            editor.on('init change', function () {
                editor.save();
            });
        },
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste imagetools"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | fullscreen",
        image_title: true,
        automatic_uploads: true,
        images_upload_url: "{{route('upload')}}",
        file_picker_types: 'image',
        file_picker_callback: function (cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function () {
                var file = this.files[0];

                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), {
                        title: file.name
                    });
                };
            };
            input.click();
        }
    });

    

    let fileInput = document.getElementById("file-input");
    let imageContainer = document.getElementById("images");
    let numOfFiles = document.getElementById("num-of-files");

    function preview() {
        imageContainer.innerHTML = "";
        numOfFiles.textContent = `${fileInput.files.length} Files Selected`;
        let count = `${fileInput.files.length}`;

        if (count > 5) {
            alert('สามารถเลือกรูปได้สูงสุด 5 รูปเท่านั้น');
            var img = document.createElement('img');
            img.src =
                "{{ asset('img') }}/none.png";
            document.getElementById('images').appendChild(img);
        } else {
            for (i of fileInput.files) {
                let reader = new FileReader();
                let figure = document.createElement("figure");
                let figCap = document.createElement("figcaption");
                figCap.innerText = i.name;
                figure.appendChild(figCap);
                reader.onload = () => {
                    let img = document.createElement("img");
                    img.setAttribute("src", reader.result);
                    figure.insertBefore(img, figCap);
                }
                imageContainer.appendChild(figure);
                reader.readAsDataURL(i);
            }
        }
    }



    var uploadField_cover_photo = document.getElementById("proposals_cover_photo");

    uploadField_cover_photo.onchange = function () {
        if (this.files[0].size > 2000000) {
            alert("ไฟล์รูปต้องขนาดไม่เกิน 2 mb");
            this.value = "";
        };
    };

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#show_proposals_cover_photo').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#proposals_cover_photo").change(function () {
        readURL(this);
    });


 
    $(document).ready(function () {
        $("#tags").select2({
        maximumSelectionLength: 3,
    });
    $('#tags').val(@php
echo "[";
 foreach ($proposals_tags as $key => $value) {
     
  echo   "'".$value->tags_id."',";
 }
 echo "]";
@endphp);
    $('#tags').trigger('change');

    });
   
</script>

<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
