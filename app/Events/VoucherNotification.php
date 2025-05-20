<?php

namespace App\Events;

use App\Models\Voucher;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VoucherNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $voucher;
    /**
     * Create a new event instance.
     */
    public function __construct(Voucher $voucher)
    {
        $this->voucher = $voucher;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        return new Channel('voucher-notification');
    }

    public function broadcastWith(): array
    {
        return [
            'code' => $this->voucher->code,
            'discount_type' => $this->voucher->discount_type,
            'discount_value' => $this->voucher->discount_value,
            'max_discount_amount' => $this->voucher->max_discount_amount,
            'min_order_value' => $this->voucher->min_order_value,
            'start' => $this->voucher->start,
            'end' => $this->voucher->end,
        ];
    }
}
