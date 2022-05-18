@extends('layouts.shop')

@section('content')

<section class="s-content s-content--single">
    <div class="row">
        <div class="column large-12">

            <article class="s-post entry format-standard">

                <div class="s-content__media">
                    <div class="s-content__post-thumb">

                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @if ($product->products_photo_1 != '' )
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                @endif

                                @if ($product->products_photo_2 != '' )
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                @endif
                                @if ($product->products_photo_3 != '' )
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                @endif
                                @if ($product->products_photo_4 != '' )
                                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                @endif
                                @if ($product->products_photo_5 != '' )
                                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                                @endif
                            </ol>
                            <div class="carousel-inner">
                                @if ($product->products_photo_1 != '' )
                                <div class="carousel-item active">
                                    <img src="{{asset('uploads_image/'.$product->products_photo_1)}}"
                                        class="d-block w-100" alt="...">
                                </div>
                                @endif

                                @if ($product->products_photo_2 != '' )
                                <div class="carousel-item ">
                                    <img src="{{asset('uploads_image/'.$product->products_photo_2)}}"
                                        class="d-block w-100" alt="...">
                                </div>
                                @endif
                                @if ($product->products_photo_3 != '' )
                                <div class="carousel-item ">
                                    <img src="{{asset('uploads_image/'.$product->products_photo_3)}}"
                                        class="d-block w-100" alt="...">
                                </div>
                                @endif
                                @if ($product->products_photo_4 != '' )
                                <div class="carousel-item ">
                                    <img src="{{asset('uploads_image/'.$product->products_photo_4)}}"
                                        class="d-block w-100" alt="...">
                                </div>
                                @endif
                                @if ($product->products_photo_5 != '' )
                                <div class="carousel-item ">
                                    <img src="{{asset('uploads_image/'.$product->products_photo_5)}}"
                                        class="d-block w-100" alt="...">
                                </div>
                                @endif
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>

                </div> <!-- end s-content__media -->

                <div class="">

                    <h3 class="s-content__title s-content__title--post">{{$product->products_name}}</h3>

                    <ul class="s-content__post-meta" style="margin-bottom: 20px;">
                        @php
                        $tags= DB::table('product_tags')->where('products_id', $product->products_id)->get();
                        $len = count($tags);
                        $i = 0;
                        foreach ($tags as $value) {
                        $tags_name = DB::table('tags')->where('tags_id', $value->tags_id )->first();
                        if($i!=$len-1){
                        echo $tags_name->tags_name.',';
                        }else {
                        echo $tags_name->tags_name;
                        }
                        $i++;
                        }
                        @endphp
                    </ul>
                    <span class="h5">ราคา : </span><span>{{$product->products_price}} บาท.</span> <br><br>
                    <span class="h5">จำนวนคงเหลือ : </span><span>{{$product->products_amount}} ชิ้น.</span>
                    <h5>ราละเอียดสินค้า</h5>
                    <p class="">
                        {{$product->products_about_short}} </p>

                    <h5>เรีองราว / ความเป็นมา</h5>
                    <div style="text-align:justify;">
                        {!!$product_story!!}
                    </div>
                </div> <!-- end s-content__primary -->
            </article>

        </div> <!-- end column -->
    </div> <!-- end row -->


    <!-- comments
    ================================================== -->
    <div class="comments-wrap">

        <div id="comments" class="row">
            <div class="column">

                <h3>{{ count($comment)}} คอมเมนต์</h3>

                @if ( count($comment) != 0 )
                    
            
                <!-- START commentlist -->
                <ol class="commentlist">
                    @foreach ($comment as $row )
                        
                    <li class="depth-1 comment">

                        <div class="comment__avatar">
                            <img class="avatar" src="images/avatars/user-01.jpg" alt="" width="50" height="50">
                        </div>

                        <div class="comment__content">

                            <div class="comment__info">
                                <div class="comment__author">{{$row->comments_name}}</div>

                                <div class="comment__meta">
                                    <div class="comment__time">{{  date('d-m-Y', strtotime($row->created_at))}}</div>
                                    <div class="comment__reply">
                                        {{-- <a class="comment-reply-link" href="#0">Reply</a> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="comment__text">
                                <p>{{$row->comments_detail}}</p>
                            </div>

                        </div>

                    </li> <!-- end comment level 1 -->
                    @endforeach
                </ol>
                <!-- END commentlist -->
                @endif
            </div> <!-- end col-full -->
        </div> <!-- end comments -->


        <div class="row comment-respond">

            <!-- START respond -->
            <div id="respond" class="column">

                <h3>
                    คอมเมนต์
                
                </h3>

                <form name="contactForm" id="contactForm" method="post" action="{{route('comments.store',['id' => $product->products_id])}}" autocomplete="off">
                    @csrf
                    <fieldset>
                        <div class="form-field">
                           
                                <select name="comments_sex" id="comments_sex"  class="h-full-width"  required>
                                    <option value="">กรุณาเลือกเพศ</option>
                                    <option value="man">ชาย</option>
                                    <option value="woman">หญิง</option>
                                    <option value="none">ไม่ระบุ</option>

                                </select>
                        </div>

                        <div class="form-field">
                            <input name="comments_name" id="comments_name" class="h-full-width" placeholder="กรุณากรกอกชื่อ" value="" required
                                type="text">
                        </div>

                        <div class="form-field">
                            <input name="comments_email" id="comments_email" class="h-full-width" placeholder="กรุณากรกอกอีเมล" value="" required
                                type="email">
                        </div>

                        <div class="message form-field">
                            <textarea name="comments_detail" id="comments_detail" class="h-full-width" required
                                placeholder="รายละเอียด"></textarea>
                        </div>

                        <input name="submit" id="submit" class="btn btn--primary btn-wide btn--large h-full-width"
                            value="เพิ่ม คอมเมนต์" type="submit">

                    </fieldset>
                </form> <!-- end form -->

            </div>
            <!-- END respond-->

        </div> <!-- end comment-respond -->

    </div> <!-- end comments-wrap -->

</section> <!-- end s-content -->

@endsection
