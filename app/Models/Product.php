<?php

namespace App\Models;

use App\Events\ProductChanged;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use HasUlids;
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = ['id', 'name', 'description', 'price', 'stock', 'category_id', 'image_url'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getImageUrlAttribute($value)
    {
        if ($value && !filter_var($value, FILTER_VALIDATE_URL)) {
            return asset('storage/' . $value);
        }

        return $value;
    }

    protected static function booted(): void
    {

        static::created(function ($product) {
            event(new ProductChanged($product, 'created', ['new' => $product->toArray()]));
        });

        static::updated(function ($product) {
            $changes = [
                'old' => [],
                'new' => [],
            ];
            foreach ($product->getDirty() as $key => $value) {
                $changes['old'][$key] = $product->getOriginal($key);
                $changes['new'][$key] = $value;
            }
            if (! empty($changes['old'])) {
                event(new ProductChanged($product, 'updated', $changes));
            }
        });

        static::deleted(function ($product) {
            event(new ProductChanged($product, 'deleted', ['old' => $product->toArray()]));
        });
    }
}
