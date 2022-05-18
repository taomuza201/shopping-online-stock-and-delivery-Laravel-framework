<div class="header bg-gradient-warning pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">จำนวนสินค้าทั้งหมด</h5>
                                    @php
                                        $year = date('Y', strtotime(Carbon\Carbon::now()));
                                        $month = date('m', strtotime(Carbon\Carbon::now()));
                                    @endphp
                                    @php
                                        $product = DB::table('products')->where('products_type','normal')->get();
                                        $product = $product->count();

                                        $product_ch = DB::table('products')->where('products_type','normal')->whereYear('created_at', '=', $year)
                                        ->whereMonth('created_at', '=', $month)->get();
                                        $product_ch = $product_ch->count();
                                    @endphp 
                                    <span class="h2 font-weight-bold mb-0">{{$product}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-boxes"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">รายการสินค้าเดือนนี้เพิ่มขึ้น</span>
                                <span class="text-success mr-2">{{$product_ch}} ชิ้น</span>
                             
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">รายการขายทั้งหมด</h5>
                                    @php
                                    $holds = DB::table('holds')->get();
                                    $holds = $holds->count();

                                    $holds_ch = DB::table('holds')->whereYear('created_at', '=', $year)
                                    ->whereMonth('created_at', '=', $month)->get();
                                    $holds_ch = $holds_ch->count();
                                @endphp 
                                    <span class="h2 font-weight-bold mb-0">{{$holds}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                               
                                <span class="text-nowrap">รายการเดือนี้เพิ่มขึ้น </span>
                                <span class="text-danger mr-2">{{   $holds_ch}} รายการ</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">ผู้ใช้งานทั้งหมด</h5>
                                    @php
                                    $users = DB::table('users')->get();
                                    $users = $users->count();

                                    $productowner = DB::table('users')->where('position','productowner')->get();
                                    $productowner = $productowner->count();
                                    $sale = DB::table('users')->where('position','sale')->get();
                                    $sale = $sale->count();
                                    $admin = DB::table('users')->where('position','admin')->get();
                                    $admin = $admin->count();
                                @endphp 
                                    <span class="h2 font-weight-bold mb-0">{{$users}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">เจ้าของสินค้า</span>
                                <span class="text-warning mr-2">{{$productowner}} คน</span>
                                <span class="text-nowrap">พนักงานขาย</span>
                                <span class="text-warning mr-2">{{ $sale}} คน</span>
                                <span class="text-nowrap">แอดมิน</span>
                                <span class="text-warning mr-2">{{ $admin}} คน</span>
                                
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">รายการร้องขออนุญาติขายสินค้า</h5>
                                    @php
                                    $proposals = DB::table('proposals')->get();
                                    $proposals = $proposals->count();

                                    $proposals_ch = DB::table('products')->whereYear('created_at', '=', $year)
                                    ->whereMonth('created_at', '=', $month)->get();
                                    $proposals_ch = $proposals_ch->count();
                                @endphp 
                                    <span class="h2 font-weight-bold mb-0">{{$proposals}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-list-ol"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">รายการร้องขอเดือนนี้เพิ่มขึ้น</span>
                                <span class="text-success mr-2">{{$proposals_ch}} ราย</span>
                          
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>