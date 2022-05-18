<table cellpadding="0" cellspacing="0">
    {{-- <tr class="top">
        <td colspan="2">
            <table>
                <tr>
                    <td class="title" style="text-align: left;">
                        รุ่งเรือง การค้า
                        <br>
                        <p style="font-size: 16px">119/1 หมู่ 10 ตำบลร้องวัวแดง อำเภอสันกำแพง จังหวัดเชียงใหม่ 50130</p>
                    </td>
                    
                    <td style="text-align: right;">
                        เลขที่ใบเสร็จ : {{$last_orders->orders_code}}<br>
                        พิมพ์เมื่อ : {{Carbon\Carbon::now()->format('d-m-Y H:i:s')}}<br>
                        พิมพ์โดย : {{$last_orders->name }}
                    </td>
                </tr>
            </table>
        </td>
    </tr> --}}

    @php
        $page =1;
    @endphp
    @include('repost.pos.billheader')
    
    {{-- <tr class="information">
        <td colspan="2">
            <table>
                <tr>
                    <td style="text-align: left;">
                        119/1 หมู่ 10 ตำบลร้องวัวแดง อำเภอสันกำแพง จังหวัดเชียงใหม่ 50130
                    </td>
                    
                    <td style="text-align: right;">
                        
                    </td>
                </tr>
            </table>
        </td>
    </tr> --}}
    
    {{-- <tr class="heading">
        <td>
            Payment Method
        </td>
        
        <td>
            Check #
        </td>
    </tr> --}}
    
    {{-- <tr class="details">
        <td>
            Check
        </td>
        
        <td>
            1000
        </td>
    </tr> --}}
    {{-- ****************ส่วนหัว********** --}}
    {{-- <tr class="heading">
        <td style="text-align: left;">
            สินค้า
        </td>
        
        <td style="text-align: right;">
            ราคา (บาท)
        </td>
    </tr> --}}
    {{-- ****************ส่วนตัว********** --}}
    
    @php
    $new_num=1;
    $price_page=0;

           for ($i=$num; $i < count($data_repost); $i++) { 

            // $price_page  =     $price_page + $bill_details[$i]->items_price * $bill_details[$i]->bill_details_quantity;

                echo '<tr class="item">';
                   
                   echo '<td style="text-align: center;">'.$new_num.'</td>';
                   echo '<td style="text-align: left;">'.$data_repost[$i]->products_name.'</td>';
                   echo '<td style="text-align: center;">'.$data_repost[$i]->order_detail_amount.'</td>';
                   echo '<td style="text-align: right;">'.$data_repost[$i]->products_price.'</td>';
                echo '</tr>';
                $num ++;
                $new_num++;
                if($num % 8 == 0 &&$num !=0 ){
            $page ++;
            break;

            }

         
    }

    
   
    @endphp
    @php

        if( $new_num  < 8 ){

            for ($i=0; $i <= 8-$new_num  ; $i++) { 

                echo '<tr class="item">';
                    echo '<td>&nbsp;</td>';
                    echo '<td>&nbsp;</td>';
                    echo '<td>&nbsp;</td>';
                    echo '<td>&nbsp;</td>';
             echo '</tr>';
            }
     
        }
    @endphp


    
    
    {{-- ****************ส่วนท้าย********** --}}
    @include('repost.pos.billfooter')
    {{-- <tr class="item">
        <td style="text-align: left;">
            <span>เงินที่รับมา</span><br>
            <span>ยอดสุทธิ</span><br>
            <span>เงินทอน</span><br>
        </td>
        <td style="text-align: right;">
            <span>{{$coin}}</span><br>
            <span>{{$total}}</span><br>
            <span>{{$change}}</span><br>
             
        </td>
    </tr> --}}
</table>

@php
    echo count($data_repost).' /';
    echo $num;
@endphp
@if ($num < count($data_repost))

<div class="page-break"></div>

    @include('repost.pos.page2')

@endif