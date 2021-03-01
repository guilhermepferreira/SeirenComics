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
        Schema::table('plans', function (Blueprint $table) {
           $table->string('stripe_id')->nullable()->change();
           $table->string('pagseguro_id')->nullable()->change();
        });
        $this->setupData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->string('stripe_id')->nullable(false)->change();
            $table->string('pagseguro_id')->nullable(false)->change();
        });
    }

    private function setupData()
    {
        DB::table('plans')->insert([
            [
                'id' => 4,
                'stripe_id' => getenv('STRIPE_MONTHLY_CHECKOUT_ID'),
                'pagseguro_id' => null,
                'name' => 'Mensal pagamento único',
                'value' => 12
            ],
            [
                'id' => 5,
                'stripe_id' => getenv('STRIPE_QUARTERLY_CHECKOUT_ID'),
                'pagseguro_id' => null,
                'name' => 'Trimestral pagamento único',
                'value' => 33
            ],
            [
                'id' => 6,
                'stripe_id' => getenv('STRIPE_SEMIANNUAL_CHECKOUT_ID'),
                'pagseguro_id' => null,
                'name' => 'Semestral pagamento único',
                'value' => 62
            ],
        ]);
    }
}
