<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductObserver
{
    public function created(Product $product): void
    {
        try {
            ProductLog::create([
                'id' => \Illuminate\Support\Str::ulid(),
                'product_id' => $product->id,
                'action' => 'created',
                'changed_by' => Auth::id() ?? null,
                'changes' => json_encode(['new' => $product->toArray()], JSON_THROW_ON_ERROR),
                'created_at' => now(),
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to log product creation', [
                'product_id' => $product->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function updated(Product $product): void
    {
        $changes = [
            'old' => [],
            'new' => [],
        ];

        foreach ($product->getDirty() as $key => $value) {
            $changes['old'][$key] = $product->getOriginal($key);
            $changes['new'][$key] = $value;
        }

        if (! empty($changes['old'])) {
            try {
                ProductLog::create([
                    'id' => \Illuminate\Support\Str::ulid(),
                    'product_id' => $product->id,
                    'action' => 'updated',
                    'changed_by' => Auth::id() ?? null,
                    'changes' => json_encode($changes, JSON_THROW_ON_ERROR),
                    'created_at' => now(),
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to log product update', [
                    'product_id' => $product->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }

    public function deleted(Product $product): void
    {
        try {
            ProductLog::create([
                'id' => \Illuminate\Support\Str::ulid(),
                'product_id' => $product->id,
                'action' => 'deleted',
                'changed_by' => Auth::id() ?? null,
                'changes' => json_encode(['old' => $product->toArray()], JSON_THROW_ON_ERROR),
                'created_at' => now(),
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to log product deletion', [
                'product_id' => $product->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
