<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    public function scopeMonthly(Builder $query)
    {
        return $query->where('api_id', getenv('MONTHLY_SUBSCRIPTION_ID'));
    }

    public function scopeQuarterly(Builder $query)
    {
        return $query->where('api_id', getenv('QUARTERLY_SUBSCRIPTION_ID'));
    }

    public function scopeSemiannual(Builder $query)
    {
        return $query->where('api_id', getenv('SEMIANNUAL_SUBSCRIPTION_id'));
    }
}
