<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Living roots</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />



    <style>
    @font-face {
        font-family: 'THSarabun';
        font-style: normal;
        font-weight: normal;
        src: url("{{ asset('fonts/TH SarabunPSK/THSarabun.ttf') }}") format('truetype');
    }

    @font-face {
        font-family: 'THSarabun';
        font-style: normal;
        font-weight: bold;
        src: url("{{ asset('fonts/TH SarabunPSK/THSarabun Bold.ttf') }}") format('truetype');
    }

    @font-face {
        font-family: 'THSarabun';
        font-style: italic;
        font-weight: normal;
        src: url("{{ asset('fonts/TH SarabunPSK/THSarabun Italic.ttf') }}") format('truetype');
    }

    @font-face {
        font-family: 'THSarabun';
        font-style: italic;
        font-weight: bold;
        src: url("{{ asset('fonts/TH SarabunPSK/THSarabun Bold Italic.ttf') }}") format('truetype');
    }

    body {
        font-family: "THSarabun";
        font-size: 16px;
        margin: 0;
        padding: 0;
    }

    /* //////////////////////////////////////////////////// */
    invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: 'THSarabun';
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    .page-break {
        page-break-after: always;
    }
        </style>
</head>

<body>
    <div class="invoice-box ">
        <table cellpadding="0" cellspacing="0">
 

            @php
                $page =1;
                $nuumber = 0;
                $total = 0;
            @endphp
            @include('report.bill.billheader')
            
            
            <tbody>
                 @foreach ( $hold_detail as $row)
                 @php
                       $nuumber ++;
                 @endphp
                     <tr class="">
                 <td align="center"> {{ $nuumber}}</td>
                 <td>{{$row->products_name}}</td>
                 <td align="right">{{$row->hold_details_products_amount}}</td>
                 <td align="right">{{$row->hold_details_products_price}}</td>
                 <td align="right">{{$row->hold_details_products_amount *$row->hold_details_products_price}} </td>
                        
                </tr>

                 @php
                    $total +=  $row->hold_details_products_amount *$row->hold_details_products_price;
                 if($nuumber % 12 == 0 && $nuumber !=0 ){
                 $page ++;
                 break;
     
                 }
                 @endphp
                 @endforeach
            </tbody>
       
           
{{-- 
            @php
            if(count($hold_detail) <12 ){

                for ($i=0; $i < 12-count($hold_detail) ; $i++) { 

                    echo '<tr class="">';
                    echo '<td>&nbsp;</td>';
                    echo '<td>&nbsp;</td>';
                    echo '<td>&nbsp;</td>';
                    echo '<td>&nbsp;</td>';
                    echo '<td>&nbsp;</td>';

                 echo '</tr>';
                }
         
            }
         @endphp --}}
            
            
            {{-- ****************ส่วนท้าย********** --}}
            @include('report.bill.billfooter')

        </table>
        @if ($nuumber < count($hold_detail))

        <div class="page-break"></div>

            {{-- @include('repost.pos.page2') --}}

        @endif
    </div>

    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>

</html>