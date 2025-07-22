<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('cpf')->nullable()->change();
            $table->string('telefone')->nullable()->change();
            $table->string('rua')->nullable()->change();
            $table->string('bairro')->nullable()->change();
            $table->string('numero')->nullable()->change();
            $table->string('complemento')->nullable()->change();
            $table->string('cidade')->nullable()->change();
            $table->string('estado')->nullable()->change();
            $table->string('cep')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('cpf')->nullable(false)->change();
            $table->string('telefone')->nullable(false)->change();
            $table->string('rua')->nullable(false)->change();
            $table->string('bairro')->nullable(false)->change();
            $table->string('numero')->nullable(false)->change();
            $table->string('complemento')->nullable()->change();
            $table->string('cidade')->nullable(false)->change();
            $table->string('estado')->nullable(false)->change();
            $table->string('cep')->nullable(false)->change();
        });
    }
};
