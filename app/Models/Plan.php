<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    const ID_PAGSEGURO = 'PAGSEGURO';
    const ID_STRIPE = 'STRIPE';

    protected $fillable =[
        'stripe_id',
        'pagseguro_id',
        'name',
        'value',
    ];

    use HasFactory;

    public function scopeMonthly(Builder $query, string $tipo)
    {
        return $query->where('api_id', getenv($tipo . '_MONTHLY_SUBSCRIPTION_ID'));
    }

    public function scopeQuarterly(Builder $query, string $tipo)
    {
        return $query->where('api_id', getenv($tipo . '_QUARTERLY_SUBSCRIPTION_ID'));
    }

    public function scopeSemiannual(Builder $query, string $tipo)
    {
        return $query->where('api_id', getenv($tipo . '_SEMIANNUAL_SUBSCRIPTION_id'));
    }
}
