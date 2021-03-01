<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StripeCheckoutRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function stripeCheckout(StripeCheckoutRequest $request)
    {
        $plan = Plan::query()->where('stripe_id', $request->get('price_id'))->first();

        $stripeCheckout = auth('api')
            ->user()
            ->checkout($plan->stripe_id, $plan->value)
            ->asStripeCheckoutSession();

        $stripeKey = getenv('STRIPE_KEY');

        return response()->json([
            'key' => $stripeKey,
            'session_id' => $stripeCheckout->id
        ]);
    }
}
