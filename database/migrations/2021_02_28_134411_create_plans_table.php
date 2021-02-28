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
            $table->string('api_id');
            $table->string('name');
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
            ['id' => 1, 'api_id' => getenv('MONTHLY_SUBSCRIPTION_ID'), 'name' => 'Mensal'],
            ['id' => 2, 'api_id' => getenv('QUARTERLY_SUBSCRIPTION_ID'), 'name' => 'Trimestral'],
            ['id' => 3, 'api_id' => getenv('SEMIANNUAL_SUBSCRIPTION_id'), 'name' => 'Semestral'],
        ]);
    }
}
