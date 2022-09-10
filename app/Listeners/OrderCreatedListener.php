<?php

namespace App\Listeners;

use App\Events\OrderCreatedEvent;
use App\Jobs\OrderCreatedNotificationJob;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderCreatedEvent  $event
     * @return void
     */
    public function handle(OrderCreatedEvent $event)
    {
        OrderCreatedNotificationJob::dispatchSync($event->order)->onQueue('telegram');
    }
}
