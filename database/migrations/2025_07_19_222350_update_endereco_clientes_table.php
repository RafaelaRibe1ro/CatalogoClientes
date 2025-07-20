<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn('endereco');
            $table->string('rua');
            $table->string('bairro');
            $table->string('numero');
            $table->string('complemento')->nullable();
            $table->string('cidade');
            $table->string('estado');
            $table->string('cep');
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn(['rua', 'bairro', 'numero', 'complemento', 'cidade', 'estado', 'cep']);
            $table->string('endereco');
        });
    }

};
