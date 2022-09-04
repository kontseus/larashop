<?php

namespace App\Services;

use App\Models\Order;
use App\Services\Contracts\InvoicesServiceContract;
use Illuminate\Database\Eloquent\Collection;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Facades\Invoice as InvoiceFacade;
use LaravelDaily\Invoices\Invoice;

class InvoicesService implements InvoicesServiceContract
{

    public function generate(Order $order): Invoice
    {
        $customer = new Buyer([
            'name' => ucfirst($order->name) . ' ' . ucfirst($order->surname),
            'custome_fields' => [
                'email' => $order->email,
                'phone' => $order->phone,
                'country' => $order->country,
                'city' => $order->city,
                'address' => $order->address,
            ]
        ]);
        $items = $this->getInvoicesItems($order->products);

        $serialNumber = $order->transaction?->id ?? $order->vendor_order_id;

        $invoice = InvoiceFacade::make()
            ->status($order->status->name)
            ->serialNumberFormat($serialNumber)
            ->buyer($customer)
            ->taxRate(config('cart.tax'))
            ->filename($serialNumber)
            ->logo('https://assets.ithillel.ua/images/companies/_transform_partnerlogo/Dataart.png')
            ->addItems($items);

        if ($order->in_process) {
            $invoice->payUntilDays(3);
        }

        return $invoice;
    }

    protected function getInvoicesItems(Collection $products): array
    {
        $items = [];

        foreach ($products as $product) {
            $items[] = (new InvoiceItem())
                ->title($product->title)
                ->pricePerUnit($product->pivot->single_price)
                ->quantity($product->pivot->quantity)
                ->units('од');
        }

        return $items;
    }
}
