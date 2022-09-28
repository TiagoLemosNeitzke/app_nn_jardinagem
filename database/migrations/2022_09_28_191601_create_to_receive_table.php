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
        Schema::create('to_receive', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->date('expiration_day'); // data do vencimento
            $table->string('value'); // valor que o cliente me deve
            $table->boolean('paid_out'); // 1-> pago | 0 -> à pagar || no caso se o cliente pagou ou não
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('to_receive', function (Blueprint $table) {
            $table->dropForeign('client_id');
        });
        Schema::dropIfExists('to_receive');
    }
};
