<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComicTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comic_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
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
        Schema::dropIfExists('comic_types');
    }

    public function setupData()
    {
        $data = [
          ['name'=> 'História em Quadrionhos', 'short_name' => "HQ"],
          ['name'=> 'Conto Erotico', 'short_name' => 'Conto'],
        ];

        foreach ($data as $datum) {
            DB::table('comic_types')->insert(
                [
                    'name'=> $datum['name'],
                    'short_name'=> $datum['short_name'],
                ]
            );
        }
    }
}
