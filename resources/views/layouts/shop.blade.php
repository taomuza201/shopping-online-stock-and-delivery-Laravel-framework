<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="canonical" href="{{url('/')}}">
    <meta name="description" content="livingroots.,ลิฟวิ่งรูท">
    <meta name="keywords" content="livingroots.,ลิฟวิ่งรูท">
    <meta name="robots" content="noindex, nofollow">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- <meta name="description" content="แม่บ้านห้วยกานเบเกอรี่">
    <meta name="keywords" content="กลุ่มวิสาหกิจชุมชนแม่บ้านห้วยกานเบเกอรี่
      เริ่มจากการรวมตัวของแม่บ้านเกษตรกรที่ได้ร่วมกันปรึกษาหารือถึงปัญหาในชุมชน
      ที่มีอาชีพหลักในการปลูกลำไยกันเป็นส่วนใหญ่แต่ประสบปัญหาราคาลำไยตกต่ำ
      จึงคิดแปรรูปลำไยซึ่งเป็นสินค้าที่มีมากในชุมชน"> --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('masonry/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('masonry/css/vendor.css') }}">

    <!-- script
    ================================================== -->
    <script src="{{ asset('masonry/js/modernizr.js') }}"></script>

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('masonry/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('masonry/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('masonry/favicon-16x16.png') }}">
    {{-- <link rel="manifest" href="{{ asset('masonry/site.webmanifest') }}"> --}}
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
</head>

<style>
    body {
        font-family: 'Prompt';
        overflow: auto !important;
    }

    p {
        font-family: 'Prompt';
        font-weight: 200;
        color: #000;
    }

    .float {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 40px;
        right: 40px;
        background-color: #0C9;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        box-shadow: 2px 2px 3px #999;
        margin-right: -15px;
        /* margin-bottom:-16px; */
        margin-bottom: 48px;
    }

    .my-float {
        margin-top: 22px;
    }

    a:hover {
        color: white;
    }

    /* a:active {
        color: black;
    } */

</style>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>

<body>
    <div>

        @include('layouts.shop_menu')
        <main class="py-4">
            @yield('content')




            <a href="https://line.me/R/ti/p/%40667jdkls" class="float" id="line">

                <i class="fab fa-line " style="font-size: 35px;padding-top: 13px"></i>
            </a>

            <script>
                $(document).ready(function () {
                    $('#line').fadeIn();
                });

            </script>




            <!-- Messenger ปลั๊กอินแชท Code -->
            <div id="fb-root"></div>

            <!-- Your ปลั๊กอินแชท code -->
            <div id="fb-customer-chat" class="fb-customerchat">
            </div>

            <script>
                var chatbox = document.getElementById('fb-customer-chat');
                chatbox.setAttribute("page_id", "106581661758964");
                chatbox.setAttribute("attribution", "biz_inbox");

                window.fbAsyncInit = function () {
                    FB.init({
                        xfbml: true,
                        version: 'v11.0'
                    });
                };

                (function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = 'https://connect.facebook.net/th_TH/sdk/xfbml.customerchat.js';
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));

            </script>

        </main>

        @include('layouts.shop_footer')
    </div>
</body>

<script src="{{ asset('masonry/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('masonry/js/plugins.js') }}"></script>
<script src="{{ asset('masonry/js/main.js') }}"></script>



<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
</script>


</html>
