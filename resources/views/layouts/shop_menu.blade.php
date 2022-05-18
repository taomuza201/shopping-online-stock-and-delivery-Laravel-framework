<!-- preloader
    ================================================== -->
<div id="preloader">
    <div id="loader"></div>
</div>


<!-- header
    ================================================== -->
<header class="s-header">

    <div class="row s-header__content">

        <div class="s-header__logo">
            <a class="logo" href="{{url('/')}}">
                <img src="{{ asset('masonry/images/logo.svg') }}" alt="Homepage">
            </a>
        </div>

        <nav class="s-header__nav-wrap">

            <h2 class="s-header__nav-heading h6">Site Navigation</h2>

            <ul class="s-header__nav">
                <li class=""><a href="{{url('/')}}" title="">Home</a></li>
                {{-- <li class="current"><a href="{{url('/')}}" title="">Home</a></li> --}}
                <li class="has-children">
                    <a href="#0" title="">Categories</a>
                    <ul class="sub-menu">
                        <li><a href="{{url('/')}}">ทั้งหมด</a></li>
                        @php

                        $tags= DB::table('tags')->get();

                        @endphp
                        @foreach ( $tags as $row)
                        <li><a href="{{url('/?tags='.$row->tags_id)}}">{{$row->tags_name}}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="{{url('/about')}}" title="">About</a></li>
                <li><a href="{{url('/contact')}}" title="">Contact</a></li>
                @auth()
                <li><a  href="{{ route('login') }}">Dashboard</a></li>
                @endauth
                @guest()
                <li><a href="{{ route('login') }}">Login</a></li>
                @endguest

            </ul> <!-- end header__nav -->

            <a href="#0" title="Close Menu" class="s-header__overlay-close close-mobile-menu">Close</a>

        </nav> <!-- end header__nav-wrap -->

        <a class="s-header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>

        <div class="s-header__search">

            <form role="search" method="get" class="s-header__search-form" action="{{url('/')}}">
                @csrf
                <label>
                    <span class="hide-content">Search for:</span>
                    <input type="search" class="s-header__search-field" placeholder="Type Your Keywords" value=""
                        name="search" title="Search for:" autocomplete="off">
                </label>
                <input type="submit" class="s-header__search-submit" value="Search">
            </form>

            <a href="#0" title="Close Search" class="s-header__overlay-close">Close</a>

        </div> <!-- end search wrap -->

        <a class="s-header__search-trigger" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M10 18a7.952 7.952 0 004.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0018 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z">
                </path>
            </svg>
        </a>

    </div> <!-- end s-header__content -->

</header> <!-- end header -->
