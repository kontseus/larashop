<?php

namespace App\Helpers;

class TransactionDataAdapter
{
    public function __construct(public string $payment_system, public int $user_id, public string $status) {}
}
