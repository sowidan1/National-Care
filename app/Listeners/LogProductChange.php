<?php

namespace App\Listeners;

use App\Events\ProductChanged;
use App\Models\ProductLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogProductChange
{
    public function handle(ProductChanged $event): void
    {
        try {
            $changedBy = Auth::id();

            ProductLog::create([
                'id' => \Illuminate\Support\Str::ulid(),
                'product_id' => $event->product->id,
                'action' => $event->action,
                'changed_by' => $changedBy,
                'changes' => json_encode($event->changes, JSON_THROW_ON_ERROR),
                'created_at' => now(),
            ]);
        } catch (\Exception $e) {
            Log::error("Failed to log product {$event->action}", [
                'product_id' => $event->product->id,
                'action' => $event->action,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
