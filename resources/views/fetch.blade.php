@foreach ($product as $row )

@if ($row->products_type=='post')
<article class="brick entry format-gallery animate-this">
    {{--
    <div class="entry__thumb slider{{$row->products_name}}">
    <div class="slider__slides">
        @if ($row->products_photo_1 != '')
        <div class="slider__slide">
            <img src="{{ asset('uploads_image/'.$row->products_photo_1) }}" alt="">
        </div>
        @endif

        @if ($row->products_photo_2 != '')
        <div class="slider__slide">
            <img src="{{ asset('uploads_image/'.$row->products_photo_2) }}" alt="">
        </div>
        @endif
        @if ($row->products_photo_3 != '')
        <div class="slider__slide">
            <img src="{{ asset('uploads_image/'.$row->products_photo_3) }}" alt="">
        </div>
        @endif
        @if ($row->products_photo_4 != '')
        <div class="slider__slide">
            <img src="{{ asset('uploads_image/'.$row->products_photo_4) }}" alt="">
        </div>
        @endif
        @if ($row->products_photo_5 != '')
        <div class="slider__slide">
            <img src="{{ asset('uploads_image/'.$row->products_photo_5) }}" alt="">
        </div>
        @endif
    </div>
    </div> <!-- end entry__thumb --> --}}

    <div id="carouselExampleIndicators{{$row->products_id}}" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @if ($row->products_photo_1 != '')
            <li data-target="#carouselExampleIndicators{{$row->products_id}}" data-slide-to="0" class="active"></li>
            @endif
            @if ($row->products_photo_2 != '')
            <li data-target="#carouselExampleIndicators{{$row->products_id}}" data-slide-to="1"></li>
            @endif
            @if ($row->products_photo_3 != '')
            <li data-target="#carouselExampleIndicators{{$row->products_id}}" data-slide-to="2"></li>
            @endif
            @if ($row->products_photo_4 != '')
            <li data-target="#carouselExampleIndicators{{$row->products_id}}" data-slide-to="3"></li>
            @endif
            @if ($row->products_photo_5 != '')
            <li data-target="#carouselExampleIndicators{{$row->products_id}}" data-slide-to="4"></li>
            @endif

        </ol>
        <div class="carousel-inner">


            @if ($row->products_photo_1 != '')
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('uploads_image/'.$row->products_photo_1) }}" alt="First slide">
            </div>
            @endif
            @if ($row->products_photo_2 != '')
            <div class="carousel-item ">
                <img class="d-block w-100" src="{{ asset('uploads_image/'.$row->products_photo_2) }}"
                    alt="Second slide">
            </div>
            @endif
            @if ($row->products_photo_3 != '')
            <div class="carousel-item ">
                <img class="d-block w-100" src="{{ asset('uploads_image/'.$row->products_photo_3) }}" alt="Third slide">
            </div>
            @endif
            @if ($row->products_photo_4 != '')
            <div class="carousel-item ">
                <img class="d-block w-100" src="{{ asset('uploads_image/'.$row->products_photo_4) }}" alt="g slide">
            </div>
            @endif
            @if ($row->products_photo_5 != '')
            <div class="carousel-item ">
                <img class="d-block w-100" src="{{ asset('uploads_image/'.$row->products_photo_5) }}"
                    alt="Firsght slide">
            </div>
            @endif

        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators{{$row->products_id}}" role="button"
            data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators{{$row->products_id}}" role="button"
            data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

</article> <!-- end article -->
@else

<article class="brick entry format-standard animate-this">

    <div class="entry__thumb">
        <a href="{{url('/products-detail/'.$row->products_id)}}" class="thumb-link">
            <img src="{{ asset('uploads_image/'.$row->products_cover_photo) }}" style="width: 100%" alt="">
        </a>
    </div> <!-- end entry__thumb -->

    <div class="entry__text" style="padding-bottom: 5px;">
        <div class="entry__header">
            <h2 class="entry__title"><a
                    href="{{url('/products-detail/'.$row->products_id)}}">{{$row->products_name}}</a></h2>

        </div>
        {{-- <hr style="padding: 0px;margin:0px;margin-bottom: 10px;"> --}}
        <div class="entry__excerpt">
            <p>
                {{$row->products_about_short}}
            </p>
        </div>
        <div class="entry__meta " style="text-align:right">
            <p class="entry__cat-links" style="line-height: 15px; font-size: 12px;margin-top:10px;margin-bottom:10px; ">
                <i> @php
                    $tags= DB::table('product_tags')->where('products_id', $row->products_id)->get();
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
                    @endphp</i>
            </p>
        </div>

    </div> <!-- end entry__text -->

</article> <!-- end entry -->
@endif


@endforeach

@if($product == '[]' )
<center> <span style="color: red"> ไม่พบรายการสินค้าที่คุณค้นหา !!!</span> </center>
@endisset
