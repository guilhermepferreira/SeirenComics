<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends \Laravel\Cashier\Subscription
{
    protected $with = ['plan'];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}