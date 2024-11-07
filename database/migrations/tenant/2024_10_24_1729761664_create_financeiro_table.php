<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceiroTable extends Migration
{
    public function up()
    {
        Schema::create('financeiro', function (Blueprint $table) {

            $table->id();
            $table->integer('conta')->nullable()->description('conta ou fonte id de origem da previsão da despesa');
            $table->integer('ano')->nullable()->description('ano de exercício');
            $table->integer('numero')->nullable();
            $table->float('valor');
            $table->float('valor_pago')->nullable();
            $table->text('obs')->nullable();
            $table->text('obs_pagamento')->nullable();
            $table->integer('autor')->nullable();
            $table->integer('categoria')->nullable();
            $table->date('vencimento')->nullable();
            $table->date('data_pagamento');
            $table->date('emissao');
            $table->integer('id_cliente')->nullable();
            $table->integer('id_responsavel')->nullable();
            $table->enum('pago',['n','s']);
            // $table->datetime('data');
            $table->string('token',50)->nullable();;
            $table->datetime('atualizado')->default("1900-01-01 00:00:00");
            $table->enum('repetir',['n','s']);
            $table->string('vezes',10)->nullable();
            $table->string('nome',300)->nullable();
            $table->string('tipo',100)->nullable()->description('se é despesa, empenho ou receita');
            $table->text('tag')->nullable();
            $table->text('descricao')->nullable();
            $table->text('historico_estorno')->nullable();
            $table->enum('fixa',['n','s'])->nullable();
            $table->enum('dividi',['n','s'])->nullable();
            $table->text('dividir')->nullable();
            $table->integer('parcela')->nullable();
            $table->integer('prazo')->nullable();
            $table->string('periodo_repete',20)->nullable();
            $table->json('config')->nullable();
            $table->integer('id_fatura_fixa')->nullable()->descriptio('identificador para agrupamento e segmetação de resulta');
            $table->string('token_fatura_dividir',50)->nullable();
            $table->integer('forma_pagameto')->nullable();
            $table->string('token_transf',50)->nullable();
            $table->string('ref_compra',80)->nullable();
            $table->string('local',5)->nullable();
            $table->text('reg_asaas')->nullable();
            $table->datetime('data_recorrencia')->nullable();
            $table->enum('cobrar',['s','n']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('financeiro');
    }
}
