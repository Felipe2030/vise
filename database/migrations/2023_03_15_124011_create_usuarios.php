<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('email', 150)->unique();
            $table->string('password', 255);
            $table->string('fullname', 255)->nullable();
            $table->string('telefone', 255)->nullable();
            $table->string('estabelecimento', 255)->nullable();
            $table->string('documento', 255)->nullable();
            $table->string('numero_documento', 255)->nullable();
            $table->string('cidade', 255)->nullable();
            $table->string('endereco', 255)->nullable();
            $table->string('numero', 255)->nullable();
            $table->string('cep', 255)->nullable();
            $table->unsignedBigInteger('id_status_usuarios')->nullable();
            $table->foreign('id_status_usuarios')->references('id')->on('status_usuarios');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
