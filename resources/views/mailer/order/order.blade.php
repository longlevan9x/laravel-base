@extends('mailer.index')
@section('content')
    <h3>Cảm ơn bạn đã sử dụng dịch vụ hiệu chuẩn của chúng tôi.</h3>
    <p>Thông tin đơn hàng của bạn</p>
    <p>Email: {{$email}}</p>
    <p>Tên: {{$name}}</p>
    <p>Số điện thoại: {{$phone}}</p>
    <p>Địa chỉ: {{$address}}</p>
    <p>Ghi chú: {{$note}}</p>
    <p>Xem chi tiết tại <a href="{{url('customer/order', $code)}}">Chi tiêt đơn hàng</a></p>
@endsection