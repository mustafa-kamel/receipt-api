<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Shipping;

class Offer extends Model
{
    protected $table = 'offers';
    protected $fillable = [
        'title', 'applied_on_type', 'applied_on_id', 'count_range_min', 'count_range_max',
        'discount_on_type', 'discount_on_id', 'discount_type', 'discount_value', 'valid_from', 'expires_at'
    ];

    public function appliedOn()
    {
        return $this->morphTo(__FUNCTION__, 'applied_on_type', 'applied_on_id');
    }

    public function discountOn()
    {
        return $this->morphTo(__FUNCTION__, 'discount_on_type', 'discount_on_id');
    }

    public function isShippingDiscount()
    {
        if (app($this->discount_on_type) instanceof Shipping)
            return TRUE;
        return False;
    }
}
