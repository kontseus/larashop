<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;


    protected $fillable = [
        "status_id",
        "user_id",
        "name",
        "surname",
        "phone",
        "email",
        "country",
        "city",
        "address",
        "total",
        "vendor_order_id",
        "transaction_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['quantity', 'single_price']);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
