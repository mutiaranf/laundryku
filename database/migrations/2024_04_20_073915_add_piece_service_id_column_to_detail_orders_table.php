<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('detail_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('piece_service_id')->nullable();
            $table->foreign('piece_service_id')->references('id')->on('piece_services');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_orders', function (Blueprint $table) {
            $table->dropForeign(['piece_service_id']);
            $table->dropColumn('piece_service_id');
        });
    }
};
