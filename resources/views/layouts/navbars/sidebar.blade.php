<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ URL('/') }}">
            <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('icon') }}/profile.png">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>

                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended"
                        placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('หน้าแรก') }}
                    </a>
                </li>


                @if (Auth::user()->position=='admin')


                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users') }}">
                        <i class="ni ni-single-02 text-orange"></i> {{ __('จัดการข้อมูลผู้ใช้งาน') }}
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('tags') }}">
                        <i class="ni ni-bullet-list-67 text-orange"></i> {{ __('จัดการข้อมูลหมวดหมู่') }}
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="{{ route('proposal.request.list') }}">
                        <i class="ni ni-basket text-orange"></i>
                        <span class="nav-link-text">รายการร้องขออนุญาติขายสินค้า</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('post.index') }}">

                        <i class="fas fa-bullhorn text-orange"></i>
                        <span class="nav-link-text">ประกาศ-รูป</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.list') }}">

                        <i class="fas fa-store text-orange"></i>
                        <span class="nav-link-text">รายการสินค้า</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('hold.all') }}">
                        <i class="fas fa-dollar-sign text-orange"></i>
                        <span class="nav-link-text">คำสั่งซื้อ-ทั้งหมด</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('hold_report') }}">
                  
                        <i class="fas fa-file-alt text-orange"></i>
                        <span class="nav-link-text">รายงานการขาย</span>
                    </a>
                </li>

                @endif

                @if (Auth::user()->position=='productowner' ||Auth::user()->position=='admin')

                @if (Auth::user()->position=='admin')
                <hr>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('proposal.list') }}">
                        <i class="ni ni-basket text-blue"></i>
                        <span class="nav-link-text">เสนอรายการสินค้า</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.owner.index') }}">

                        <i class="fas fa-store text-blue"></i>
                        <span class="nav-link-text">รายการสินค้าของฉัน</span>
                    </a>
                </li>
                @endif
                @if (Auth::user()->position=='sale' ||Auth::user()->position=='admin' )

                @if (Auth::user()->position=='admin')
                <hr>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('hold.index') }}">
                        <i class="fas fa-dollar-sign text-blue"></i>
                        <span class="nav-link-text">คำสั่งซื้อ</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('holdhistor.index') }}">

                        <i class="fas fa-history text-blue"></i>
                        <span class="nav-link-text">ประวัติคำสั่งซื้อ-รายงานคำสั่งซื้อ</span>
                    </a>
                </li>


                @endif

            </ul>



            {{-- <h6 class="navbar-heading text-muted">Documentation</h6>
           
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link"
                        href="https://argon-dashboard-laravel.creative-tim.com/docs/getting-started/overview.html">
                        <i class="ni ni-spaceship"></i> Getting started
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="https://argon-dashboard-laravel.creative-tim.com/docs/foundation/colors.html">
                        <i class="ni ni-palette"></i> Foundation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="https://argon-dashboard-laravel.creative-tim.com/docs/components/alerts.html">
                        <i class="ni ni-ui-04"></i> Components
                    </a>
                </li>
            </ul> --}}
        </div>
    </div>
</nav>
