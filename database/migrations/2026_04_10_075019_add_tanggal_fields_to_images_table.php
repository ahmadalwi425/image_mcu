<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->date('tanggal_lahir')->nullable();
            $table->string('tanggal_pendaftaran')->nullable();
        });
    }

    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn(['tanggal_lahir', 'tanggal_pendaftaran']);
        });
    }
};
