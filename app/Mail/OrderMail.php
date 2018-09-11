<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderMail extends Mailable
{
	use Queueable, SerializesModels;

	public $name;
	public $phone;
	public $quantity;
	public $price;

	/**
	 * Create a new message instance.
	 * @param $name
	 * @param $phone
	 * @param $quantity
	 */
	public function __construct($name, $phone, $quantity, $price) {
		$this->name     = $name;
		$this->phone    = $phone;
		$this->quantity = $quantity;
		$this->price = $price;
	}

	/**
	 * Build the message.
	 * @return $this
	 * @throws \Exception
	 */
	public function build() {
		return $this->subject("Tin nhắn đơn đặt hàng từ: " . $this->name)->from(setting(KEY_ADMIN_EMAIL) ?? config('mail.username'))->view("mailer.order")->text("mailer.order-text");
	}
}
