<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('photo');
            $table->string('name', 250);
            $table->string('email');
            $table->string('address'); // todos os dados juntos aqui.
            $table->string('type_service'); // jardinagem / piscina / jardiangem e piscina.
            $table->string('service_price'); // valor do serviço
            $table->boolean('is_monthly'); // 1 -> mensal | 0 -> não é mensal
            $table->date('expiration_day')->nullable(); // dia que vence a mensalidade
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
