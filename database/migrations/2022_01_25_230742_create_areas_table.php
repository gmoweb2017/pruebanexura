<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',255);
            $table->timestamps();
        });

        DB::table('areas')->insert(array('id'=>'1','nombre'=>'Administrativa y Financiera'));
        DB::table('areas')->insert(array('id'=>'2','nombre'=>'Ingeniería'));
        DB::table('areas')->insert(array('id'=>'3','nombre'=>'Desarrollo de Negocio'));
        DB::table('areas')->insert(array('id'=>'4','nombre'=>'Administrativa y Financiera'));
        DB::table('areas')->insert(array('id'=>'5','nombre'=>'Proyectos'));
        DB::table('areas')->insert(array('id'=>'6','nombre'=>'Servicios'));
        DB::table('areas')->insert(array('id'=>'7','nombre'=>'Calidad'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
