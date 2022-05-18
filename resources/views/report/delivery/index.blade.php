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
            font-size: 20px;
            margin: 0;
            padding: 0;
        }

      

    </style>
</head>

<body>

    <p>
        <b>จาก</b> octus logicus 389/39 ถนนรอบเมืองเชียงใหม่ ป่าข่อยใต้ หมู่ 2 ตำบลสันผีเสื้อ อำเภอเมือง จังหวัด เชียงใหม่ 50300 เบอร์โทร ...............
    </p>
    <p>
        <b>ถึง </b> {{$hold->holds_name}} บ้านเลขที่ {{$hold->holds_house_number}} หมู่ {{$hold->holds_village}} ซอย
        {{$hold->holds_alley}} ถนน {{$hold->holds_road}}
        จังหวัด {{$hold->name_th}} อำเภอ {{$hold->name_th}} ตำบล {{$hold->holds_districts}} รหัสไปรษณีย์
        {{$hold->holds_zip_code}} เบอร์โทร {{$hold->holds_tel}}
    </p>
</body>

</html>
