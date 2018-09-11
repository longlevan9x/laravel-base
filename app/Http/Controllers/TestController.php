<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function mail() {
    	Mail::to('longvan1296@gmail.com')->send(new OrderMail('longvan1296@gmail.com', '098766', 3, 444));

    }
}
