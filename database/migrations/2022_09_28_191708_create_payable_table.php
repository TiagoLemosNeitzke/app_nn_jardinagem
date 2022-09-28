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
        Schema::create('payable', function (Blueprint $table) {
            $table->id();
            $table->date('expiration_day'); // dia que tenho que pagar a conta
            $table->boolean('paid_out'); // 1-> pago | 0-> á pagar
            $table->string('value'); // valor que tenho que pagar
            $table->boolean('recurrent'); // 1 -> todo mês tenho que pagar | 0 -> apenas uma parcela
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
        Schema::dropIfExists('payable');
    }
};
