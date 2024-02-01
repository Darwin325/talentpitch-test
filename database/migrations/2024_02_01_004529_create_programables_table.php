<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('programables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('programable_id');
            $table->string('programable_type');
            $table->unsignedBigInteger('program_id');
            $table->foreign('program_id')->references('id')
                ->on('programs')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programable');
    }
};
