Đơn đặt hàng.
Người đăng ký: {{$name}}
Số điện thoại: {{$phone}}
Câu hỏi: {{$quantity}}
Tổng tiền:{{number_format(intval($quantity) * intval($price))}}
Thời gian:{{\Illuminate\Support\Carbon::now()}}