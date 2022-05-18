<table class="table table-hover  table-bordered" id="maintable">
    <thead>
        <tr>
            <th scope="col">ลำดับที่</th>
            <th scope="col">รูป</th>
            <th scope="col">รายการสินค้า</th>
            <th scope="col">จำนวน</th>
            <th scope="col">ราคา</th>
            <th scope="col">ราคารวม</th>
            <th scope="col">จัดการข้อมูล</th>
        </tr>
    </thead>
    <tbody>
        @php
        $total =0;
        $number = 1 ;
        @endphp

        @foreach ($hold_detail as $row)
        @php
             $check_product =  DB::table('products')->where('products_id',$row->hold_details_products_id)->first();
           
        @endphp

        @if ($check_product->products_amount < $row->hold_details_products_amount && $row->holds_status  == 'start')
        <tr class="align-middle"  style="background-color:rgb(214, 211, 211)">
         
                <td class="td-center align-middle">{{$number}}</td>
                <td class="align-middle">
                    <center> <img src="{{ asset('uploads_image/'.$row->products_cover_photo) }}"
                            class="img-fluid img-responsive" style="width: 150px"> </center>
                </td>
                <td class="align-middle text-center" colspan="4">  <h4 style="color: red"> 
                    
                    @if ($check_product->products_amount < $row->hold_details_products_amount && $check_product->products_amount != 0 )
                    {{$row->products_name}} - จำนวนสินค้าไม่เพียงพอต่อความต้องการ</h4></td>
                    @else
                    {{$row->products_name}} - สินค้าหมด</h4></td>
                    @endif
                    
                   
      
        
                    @php
                 
                        $total +=    $row->hold_details_products_amount * $row->hold_details_products_price;
                    @endphp
                <td class="td-center align-middle" >
                      
                     @if ($hold->holds_status != 'start')
                     <style>
                        .disabled-click {
                               pointer-events: none;
                               cursor: default;
                               opacity: 0.7;
                               }
                    </style>
                     @endif                                                          
                    <button type="button"   class="btn btn-primary btn-sm disabled-click"  data-id="{{$row->hold_details_id}}"  
                        onclick="editmodal(this)"><i class="fas fa-wrench"></i>
                        แก้ไขข้อมูล</button>
                    <a href="{{url('delete/holddetail/'.$row->hold_details_id)}}"   
                        class="btn btn-danger btn-sm disabled-click"
                        onclick="return confirm('คุณต้องการลบรายการ ? {{$row->products_name }}')"><i
                            class="fas fa-trash-alt"></i> ลบข้อมูล</a>
                </td>
            </tr>
        @else    
        <tr class="align-middle">
            <td class="td-center align-middle">{{$number}}</td>
            <td class="align-middle">
                <center> <img src="{{ asset('uploads_image/'.$row->products_cover_photo) }}"
                        class="img-fluid img-responsive" style="width: 150px"> </center>
            </td>
            <td class="align-middle">{{$row->products_name}}</td>
            <td class="align-middle">{{$row->hold_details_products_amount}}</td>
            <td class="align-middle">{{$row->hold_details_products_price}}</td>
            <td class="align-middle">
                {{ $row->hold_details_products_amount * $row->hold_details_products_price}}
                บาท.</td>
                @php
             
                    $total +=    $row->hold_details_products_amount * $row->hold_details_products_price;
                @endphp
            <td class="td-center align-middle" >
                  
                 @if ($hold->holds_status != 'start')
                 <style>
                    .disabled-click {
                           pointer-events: none;
                           cursor: default;
                           opacity: 0.7;
                           }
                </style>
                 @endif                                                          
                <button type="button"   class="btn btn-primary btn-sm disabled-click"  data-id="{{$row->hold_details_id}}"  
                    onclick="editmodal(this)"><i class="fas fa-wrench"></i>
                    แก้ไขข้อมูล</button>
                <a href="{{url('delete/holddetail/'.$row->hold_details_id)}}"   
                    class="btn btn-danger btn-sm disabled-click"
                    onclick="return confirm('คุณต้องการลบรายการ ? {{$row->products_name }}')"><i
                        class="fas fa-trash-alt"></i> ลบข้อมูล</a>
            </td>
        </tr>
        @endif
     
       
        @php
            $number ++;
        @endphp
        @endforeach
    </tbody>
  
</table> 
<div class="text-right">
    <span class="text-red" style="font-size: 20px">  ราคาสุทธิ : {{$total}} บาท</span>
</div>