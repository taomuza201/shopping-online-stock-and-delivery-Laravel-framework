<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>proposal</title>





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

        
        .page-break {
            page-break-after: always;
        }



        .h4 {
            display: inline;
            margin-top: 1.33em;
            margin-bottom: 1.33em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
        }
        img{
            width: 300px;
            height: auto;
        }

    </style>
</head>

<body>
    
        <center>
            <h2> ใบร้องขออนุญาติขายสินค้า</h2>
        </center>
        <table style="width: 100%">
            <tr>
                <td><span class="h4">ชื้อสินค้า :</span> <span>{{$proposals->proposals_name}}</span> </td>
            </tr>
            <tr>
                <td><span class="h4" style="width: 50%">ราคาต้นทุน :</span> <span>{{$proposals->proposals_price_cost}}</span></td>
                
            </tr>
            <tr>
                <td><span class="h4">ราคาที่ต้องการขาย :</span> <span>{{$proposals->proposals_price}}</span></td>
            </tr>
            <tr>
                <td><span class="h4" style="width: 50%">จำนวนสินค้า :</span> <span>{{$proposals->proposals_amount}}</span></td>
            </tr>
            <tr>
                <td> <span class="h4" >รายละเอียดแบบย่อ:</span><span>{{$proposals->proposals_about}}</span></td>
            </tr>
           
        </table>




        <span class="h4" >รายละเอียดรายการสินค้า :</span>
       
        <div>
            {!!$story!!}
        </div>
    
        
    
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>

</html>
