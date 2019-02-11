<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail Register</title>
</head>
<body>
<div style="width: 100%;">
    <h2>Ban da tao tai khoan tren website <a href="https://vias.com.vn">Cong ty co phan DBHT</a></h2>
    <h3>Thong tin tai khoan cua ban:</h3>
    <p>
        Ten tai khoan: {{$email}}
        Mat khau: {{$password}}
    </p>
    <h3>Bạn cần xác thực email nay: </h3>
    <a href="{{url('verification', [$email, $authen_key])}}">Verification</a>
    <span>(Link co hieu luc trong 3 ngay)</span>
</div>
</body>
</html>