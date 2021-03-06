@extends('layouts.shop')

@section('content')

<!-- masonry
    ================================================== -->
<section class="s-bricks">

    <div class="masonry">
        <div class="bricks-wrapper h-group">

            <div class="grid-sizer"></div>


            <div id="fetch">
                @include('fetch')
            </div>
            




        </div> <!-- end brick-wrapper -->

    </div> <!-- end masonry -->

    {{-- <div class="row">
        <div class="column large-12">
            <nav class="pgn">
                <ul>
                    <li>
                        <a class="pgn__prev" href="#0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12.707 17.293L8.414 13H18v-2H8.414l4.293-4.293-1.414-1.414L4.586 12l6.707 6.707z">
                                </path>
                            </svg>
                        </a>
                    </li>
                    <li><a class="pgn__num" href="#0">1</a></li>
                    <li><span class="pgn__num current">2</span></li>
                    <li><a class="pgn__num" href="#0">3</a></li>
                    <li><a class="pgn__num" href="#0">4</a></li>
                    <li><a class="pgn__num" href="#0">5</a></li>
                    <li><span class="pgn__num dots">…</span></li>
                    <li><a class="pgn__num" href="#0">8</a></li>
                    <li>
                        <a class="pgn__next" href="#0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M11.293 17.293l1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z">
                                </path>
                            </svg>
                        </a>
                    </li>
                </ul>
            </nav> <!-- end pgn -->
        </div> <!-- end column -->
    </div> <!-- end row --> --}}

</section> <!-- end s-bricks -->


<script>

    
</script>


@endsection
