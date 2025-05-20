<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Tạo instance mới của mail với đơn hàng.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Xây dựng nội dung email.
     */
    public function build()
    {
        return $this->subject('Xác nhận đơn hàng từ Pinastore')
                    ->markdown('emails.orders.confirmation');
    }
}
