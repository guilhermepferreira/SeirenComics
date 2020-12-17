<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->id();
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
        Schema::dropIfExists('series');
    }

    public function setupData()
    {
        $data = [
            ['name' => 'Parodia'],
            ['name' => 'Oh, Família'],
            ['name' => 'Natal'],
            ['name' => 'Tarado'],
            ['name' => 'Priminha'],
            ['name' => 'Colegial'],
            ['name' => 'Aline'],
            ['name' => 'Paradox'],
            ['name' => 'Familia'],
            ['name' => 'Curtas'],
            ['name' => 'Esportista'],
            ['name' => 'Colegiais'],
            ['name' => 'Outra Chance'],
            ['name' => 'Outra'],
            ['name' => 'Paralelas'],
            ['name' => 'Ana Lucia'],
            ['name' => 'Professora'],
            ['name' => 'Amor em Familia'],
            ['name' => 'Princesinha'],
            ['name' => 'Esportista Sportswoman'],
            ['name' => 'Desconfiança'],
            ['name' => 'Darksands'],
            ['name' => 'Pequenos Dramas'],
            ['name' => 'Lia']
        ];
        foreach ($data as $item){
            DB::table('series')->insert([
                'name' => $item['name']
            ]);
        }
    }
}
