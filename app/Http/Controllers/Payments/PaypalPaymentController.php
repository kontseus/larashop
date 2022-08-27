<?php

namespace App\Http\Controllers\Payments;

use App\Events\OrderCreatedEvent;
use App\Helpers\TransactionDataAdapter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Notifications\OrderCreatedNotification;
use App\Repositories\Contracts\OrderRepositoryContract;
use App\Repositories\OrderRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalPaymentController extends Controller
{
    const PAYMENT_SYSTEM = 'PAYPAL';
    protected PayPalClient $payPalClient;

    public function __construct()
    {
        $this->payPalClient = $this->getClient();
        $this->payPalClient->setApiCredentials(config('paypal'));
        $this->payPalClient->setAccessToken($this->payPalClient->getAccessToken());
    }

    public function create(CreateOrderRequest $request, OrderRepositoryContract $orderRepository)
    {
        try {
            DB::beginTransaction();

            $total = Cart::instance('cart')->total(2, '.', '');
            $invoiceId = 'invoice_id_' . time() . '_' . auth()->id();
            $paypalOrder = $this->createPaymentOrder($total, $invoiceId);
            $request = $request->validated();
            $request['vendor_order_id'] = $paypalOrder['id'];
            $request['invoice_id'] = $invoiceId;

            $order = $orderRepository->create($request, $total);

            DB::commit();

            return response()->json($order);
        } catch (\Exception $exception) {
            DB::rollBack();
            logs()->warning($exception);

            return response()->json(['error' => $exception->getMessage()]);
        }
    }

    public function capture(string $orderId, OrderRepositoryContract $orderRepository)
    {
        try {
            DB::beginTransaction();

            $result = $this->payPalClient->capturePaymentOrder($orderId);

            $order = $orderRepository->setTransaction($orderId, new TransactionDataAdapter(
                self::PAYMENT_SYSTEM,
                auth()->id(),
                $result['status']
            ));
            $result['orderId'] = $order->id;

            OrderCreatedEvent::dispatch($order);

            DB::commit();

            return response()->json($result);
        } catch (\Exception $exception) {
            DB::rollBack();
            logs()->warning($exception);

            return response()->json(['error' => $exception->getMessage()], 422);
        }
    }

    protected function getClient()
    {
        return new PayPalClient();
    }

    protected function createPaymentOrder($total, $invoiceId)
    {
        return $this->payPalClient->createOrder([
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => config('paypal.currency'),
                        'value' => $total
                    ],
                    'invoice_id' => $invoiceId
                ]
            ]
        ]);
    }
}
