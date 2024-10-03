<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('messenger_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('messenger_id');
            $table->string('location');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('messenger_attachments');
    }
};
