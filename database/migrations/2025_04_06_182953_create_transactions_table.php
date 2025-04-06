<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            // Relacionamento com a tabela users
            $table->unsignedBigInteger('user_id');
            // Relacionamento com a tabela categories
            $table->unsignedBigInteger('category_id');
            // Valor da transação (por exemplo, 15 dígitos no total, 2 decimais)
            $table->decimal('amount', 15, 2);
            // Data da transação
            $table->date('date');
            // Descrição opcional
            $table->text('description')->nullable();
            $table->timestamps();

            // Chaves estrangeiras
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}