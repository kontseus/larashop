<?php

namespace App\Repositories;

use App\Helpers\TransactionDataAdapter;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\Transaction;
use App\Repositories\Contracts\OrderRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Services\ImagesService;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryContract
{

    const ORDER_STATUSES = [
        'completed' => 'COMPLETED'
    ];

    /**
     * @param array $request
     * @param float $total
     * @return Order|bool
     * @throws Exception
     */
    public function create(array $request, float $total): Order|bool
    {
        $user = auth()->user();
        $status = OrderStatus::defaultStatus()->first();

        $request = array_merge($request, [
            'status_id' => $status->id,
            'total' => $total
        ]);

        $order = $user->orders()->create($request);

        $this->addProductsToOrder($order);

        return $order;
    }

    public function setTransaction(string $transactionOrderId, TransactionDataAdapter $adapter): Order
    {
        $order = Order::where('vendor_order_id', $transactionOrderId)->firstOrFail();

        if ($adapter->status === self::ORDER_STATUSES['completed']) {
            $order->update(['status_id' => OrderStatus::paidStatus()->firstOrFail()?->id]);
        }

        $order->transaction()->create((array) $adapter);

        return $order;
    }

    /**
     * @param Order $order
     * @throws Exception
     */
    public function addProductsToOrder(Order $order)
    {
        Cart::instance('cart')->content()->each(function($cartItem) use ($order) {
            $order->products()->attach(
                $cartItem->model,
                [
                    'quantity' => $cartItem->qty,
                    'single_price' => $cartItem->price
                ]
            );

            $inStock = $cartItem->model->in_stock - $cartItem->qty;

            if (!$cartItem->model->update(['in_stock' => $inStock])) {
                throw new Exception("Smth went wrong with product ID({$cartItem->id}) while updating qty");
            }
        });
    }
}
