<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('type_name');
            $table->string('short_name');
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
        Schema::dropIfExists('user_types');
    }

    public function setupData()
    {
        $data = [
            ['type_name' => 'Admin', 'short_name' => 'ADM'],
            ['type_name' => 'User', 'short_name' => 'USR'],
        ];

        foreach ($data as $item) {
            \Illuminate\Support\Facades\DB::table('user_types')->insert($item);
        }
    }
}
