<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
</head>
<body>
<div style="width: 100%;">
    <caption><h2>Đơn đặt hàng.</h2></caption>
    <table border="0" cellpadding="10" cellspacing="0">
        <tr>
            <th style="text-align: right">Người đặt hàng:</th>
            <td>{{$name}}</td>
        </tr>
        <tr>
            <th style="text-align: right">Số điện thoại:</th>
            <td>{{$phone}}</td>
        </tr>
        <tr>
            <th style="text-align: right">Số lượng:</th>
            <td>{{$quantity}}</td>
        </tr>
        <tr>
            <th style="text-align: right">Tổng tiền:</th>
            <td>{{number_format(intval($quantity) * intval($price))}}</td>
        </tr>
        <tr>
            <th style="text-align: right">Thời gian:</th>
            <td>{{\Illuminate\Support\Carbon::now()}}</td>
        </tr>
    </table>
</div>
</body>
</html>