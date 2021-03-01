<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddPlansStripeCheckout extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->setupData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('plans')->insert([
            [
                'id' => 1,
                'stripe_id' => getenv('STRIPE_MONTHLY_CHECKOUT_ID'),
                'pagseguro_id' => getenv('PAGSEGURO_MONTHLY_SUBSCRIPTION_ID'),
                'name' => 'Mensal',
                'value' => 12
            ],
            [
                'id' => 2,
                'stripe_id' => getenv('STRIPE_QUARTERLY_CHECKOUT_ID'),
                'pagseguro_id' => getenv('PAGSEGURO_QUARTERLY_SUBSCRIPTION_ID'),
                'name' => 'Trimestral',
                'value' => 33
            ],
            [
                'id' => 3,
                'stripe_id' => getenv('STRIPE_SEMIANNUAL_CHECKOUT_ID'),
                'pagseguro_id' => getenv('PAGSEGURO_SEMIANNUAL_SUBSCRIPTION_id'),
                'name' => 'Semestral',
                'value' => 62
            ],
        ], [
            [
                'id' => 1,
                'stripe_id' => getenv('STRIPE_MONTHLY_SUBSCRIPTION_ID'),
                'pagseguro_id' => getenv('PAGSEGURO_MONTHLY_SUBSCRIPTION_ID'),
                'name' => 'Mensal',
                'value' => 12
            ],
            [
                'id' => 2,
                'stripe_id' => getenv('STRIPE_QUARTERLY_SUBSCRIPTION_ID'),
                'pagseguro_id' => getenv('PAGSEGURO_QUARTERLY_SUBSCRIPTION_ID'),
                'name' => 'Trimestral',
                'value' => 33
            ],
            [
                'id' => 3,
                'stripe_id' => getenv('STRIPE_SEMIANNUAL_SUBSCRIPTION_id'),
                'pagseguro_id' => getenv('PAGSEGURO_SEMIANNUAL_SUBSCRIPTION_id'),
                'name' => 'Semestral',
                'value' => 62
            ],
        ]);
    }

    private function setupData()
    {
        DB::table('plans')->truncate();
        DB::table('plans')->insert([
            [
                'id' => 1,
                'stripe_id' => getenv('STRIPE_MONTHLY_CHECKOUT_ID'),
                'pagseguro_id' => getenv('PAGSEGURO_MONTHLY_SUBSCRIPTION_ID'),
                'name' => 'Mensal',
                'value' => 12
            ],
            [
                'id' => 2,
                'stripe_id' => getenv('STRIPE_QUARTERLY_CHECKOUT_ID'),
                'pagseguro_id' => getenv('PAGSEGURO_QUARTERLY_SUBSCRIPTION_ID'),
                'name' => 'Trimestral',
                'value' => 33
            ],
            [
                'id' => 3,
                'stripe_id' => getenv('STRIPE_SEMIANNUAL_CHECKOUT_ID'),
                'pagseguro_id' => getenv('PAGSEGURO_SEMIANNUAL_SUBSCRIPTION_ID'),
                'name' => 'Semestral',
                'value' => 62
            ],
        ]);
    }
}
