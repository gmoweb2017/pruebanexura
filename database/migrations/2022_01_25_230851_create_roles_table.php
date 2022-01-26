<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',255);
            $table->timestamps();
        });

        DB::table('roles')->insert(array('id'=>'1','nombre'=>'Desarrollador'));
        DB::table('roles')->insert(array('id'=>'2','nombre'=>'Analista'));
        DB::table('roles')->insert(array('id'=>'3','nombre'=>'Tester'));
        DB::table('roles')->insert(array('id'=>'4','nombre'=>'Diseñador'));
        DB::table('roles')->insert(array('id'=>'5','nombre'=>'Profesional PMO'));
        DB::table('roles')->insert(array('id'=>'6','nombre'=>'Profesional de servicios'));
        DB::table('roles')->insert(array('id'=>'7','nombre'=>'Auxiliar Administrativo'));
        DB::table('roles')->insert(array('id'=>'8','nombre'=>'Codirector'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
