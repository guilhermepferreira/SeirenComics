<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('stripe_id');
            $table->string('pagseguro_id');
            $table->string('name');
            $table->double('value');
            $table->timestamps();
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
        Schema::dropIfExists('plans');
    }

    private function setupData()
    {
        DB::table('plans')->insert([
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
}
