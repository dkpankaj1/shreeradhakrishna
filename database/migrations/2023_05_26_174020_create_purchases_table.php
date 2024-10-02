<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('trans_id')->unique();
            $table->string('product')->nullable();
            $table->string('volume')->nullable();
            $table->string('amt')->nullable();
            $table->string('reward')->default(0);
            $table->tinyInteger('isredeem')->default(0);
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->on('customers')->references('id');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('purchases');
    }
};
