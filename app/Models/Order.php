<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use HasUlids;
    use SoftDeletes;

    protected $fillable = [
        'id', 'full_name', 'phone', 'address', 'total', 'date', 'status', 'payment_method',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
