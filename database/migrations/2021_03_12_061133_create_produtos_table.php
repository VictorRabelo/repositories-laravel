<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id('id_produto');
            $table->foreignId('categoria_id');
            $table->foreignId('data_id');
            $table->foreignId('valor_id');
            $table->foreignId('frete_id');
            $table->foreignId('fornecedor_id');
            $table->string('img');
            $table->string('path');
            $table->string('name');
            $table->string('descricao')->nullable();
            $table->float('preco', 8, 2);
            $table->float('unitario', 8, 2);
            $table->float('comissao', 8, 2)->nullable();
            $table->float('valor_total', 8, 2);
            $table->enum('tipo', ['br', 'usa', 'py']);
            $table->enum('status', ['ok', 'pendente', 'pago', 'vendido']);
            $table->enum('tipo_entrega', ['navio', 'aviao'])->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
