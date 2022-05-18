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
                            <h2 class="mb-4 " style="font-weight: 600">แก้ไขรายการสินค้า</h2>
                        </div>

                    </div>
                </div>

                <hr>
                <div class="card-body">

                    <form action="{{url('products/update/'.$product->products_id)}}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label">ชื่อสินค้า :</label>
                                    <input type="text" class="form-control" id="products_name" name="products_name" value="{{$product->products_name}}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label">ชื่อสินค้าแบบย่อ :</label>
                                    <input type="text" class="form-control" id="products_name_short" name="products_name_short"  value="{{$product->products_name_short}}"
                                        required>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label">ราคาที่ต้องการขาย :</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" name="products_price"  value="{{$product->products_price}}"
                                            id="products_price" required min="1">
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
                                        <input type="number" class="form-control" name="products_amount" value="{{$product->products_amount}}"
                                            id="products_amount" required min="0">
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
                                    <label class="col-form-label">รายละเอียดรายการสินค้าแบบย่อ :</label>
                                    <textarea name="products_about_short" id="products_about_short" rows="5"
                                        style="min-height: 100px;" required class="form-control">{{$product->products_about_short}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label">คำอธิบายแบบย่อ เช่น Size :</label>
                                    <textarea name="products_about_size" id="products_about_size" rows="5"
                                        style="min-height: 100px;"  class="form-control">{{$product->products_about_size}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label">รูปปกสินค้า :</label> <br>
                                    <center> <img src="{{ asset('uploads_image') }}/{{$product->products_cover_photo}}" id="show_products_cover_photo"
                                            class="img-fluid img-responsive"> </center>
                                    <br>
                                    <input type="file" name="products_cover_photo" id="products_cover_photo" 
                                        class="form-control" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label">อัลบั้มรูปสินค้า :</label> <br>
                                    {{-- <label class="active">Photos</label> --}}
                                    <div class="input-images-1" id="products_photo" style="padding-top: .5rem;">
                                       
                                    </div>
                                </div>
                            </div>
                        </div>



                        <hr>
                        <div class="row">
                            <div class="col">

                                <label class="col-form-label">ความเป็นมา / เรื่องราว :</label> <br>
                                <textarea name="products_story" id="products_story" rows="20" required>{{$product->products_story}}</textarea>
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
                                style="width: 50%">แก้ไขข้อมูลสินค้า</button>
                        </center>

                </div>
                </form>
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
   let preloaded = [@php
       echo $dataimg;
   @endphp];
   $('#products_photo').imageUploader({
    imagesInputName: 'images',
    preloaded: preloaded,
   });


$(document).ready(function () {
    $("input[name='images[]']").attr('accept', "image/*");
  
});

    tinymce.init({
        selector: '#products_story',
        language: 'th_TH',
        content_css: "{{asset('assets/css/tinymce.css')}}",
        mobile: {
    plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker textpattern noneditable help formatpainter pageembed charmap mentions quickbars linkchecker emoticons advtable'
  },
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
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |fullscreen ",

        image_title: true,
        automatic_uploads: true,
        images_upload_url: "{{route('upload.product.update')}}",
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
                        title: file.name,

                    });
                };
            };
            input.click();
        }
    });




    // let fileInput = document.getElementById("file-input");
    // let imageContainer = document.getElementById("images");
    // let numOfFiles = document.getElementById("num-of-files");

    // function preview() {
    //     imageContainer.innerHTML = "";
    //     numOfFiles.textContent = `${fileInput.files.length} Files Selected`;
    //     let count = `${fileInput.files.length}`;

    //     if (count > 5) {
    //         alert('สามารถเลือกรูปได้สูงสุด 5 รูปเท่านั้น');
    //         var img = document.createElement('img');
    //         img.src =
    //             "{{ asset('img') }}/none.png";
    //         document.getElementById('images').appendChild(img);
    //     } else {
    //         for (i of fileInput.files) {
    //             let reader = new FileReader();
    //             let figure = document.createElement("figure");
    //             let figCap = document.createElement("figcaption");
    //             figCap.innerText = i.name;
    //             figure.appendChild(figCap);
    //             reader.onload = () => {
    //                 let img = document.createElement("img");
    //                 img.setAttribute("src", reader.result);
    //                 figure.insertBefore(img, figCap);
    //             }
    //             imageContainer.appendChild(figure);
    //             reader.readAsDataURL(i);
    //         }
    //     }
    // }

    var uploadField_cover_photo = document.getElementById("products_cover_photo");

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
                $('#show_products_cover_photo').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#products_cover_photo").change(function () {
        readURL(this);
    });

    $(document).ready(function () {
        $("#tags").select2({
        maximumSelectionLength: 3,
    });
    $('#tags').val(@php
echo "[";
 foreach ($products_tags as $key => $value) {
     
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
