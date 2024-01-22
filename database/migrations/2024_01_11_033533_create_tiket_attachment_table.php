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
        Schema::create('tiket_attachment', function (Blueprint $table) {
            $table->foreignId('tiket_balasan_id')->constrained('tiket_balasan');
            $table->foreignId('file_id')->constrained('files');
            $table->primary(['tiket_balasan_id', 'file_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tiket_attachment');
    }
};
