<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();

            $table->string('no_mr');
            $table->string('reg_no');
            $table->string('nama');
            $table->string('file_path'); // path file gambar
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            // optional tapi sangat disarankan

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
