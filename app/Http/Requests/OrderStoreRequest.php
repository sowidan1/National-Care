<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'full_name'        => 'required|string|max:255',
            'phone'            => 'required|string|max:20',
            'address'          => 'required|string',
            'items'            => 'required|array',
            'items.*.id'       => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price'    => 'required|numeric|min:0'
        ];
    }
}
