<?php

namespace App\Repositories\Contracts;

use App\Helpers\TransactionDataAdapter;
use App\Models\Order;

interface OrderRepositoryContract
{
    public function create(array $request, float $total): Order|bool;

    public function setTransaction(string $transactionOrderId, TransactionDataAdapter $adapter): Order;
}
