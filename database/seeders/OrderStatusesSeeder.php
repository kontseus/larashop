<?php

namespace Database\Seeders;

use App\Helpers\Enums\OrderStatusesEnum;
use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = collect(OrderStatusesEnum::cases());
        $statuses->each(fn($status) => OrderStatus::firstOrCreate(['name' => $status->value]));
    }
}
