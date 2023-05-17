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
        Schema::create('exercises_set', function (Blueprint $table) {
            $table->id();
            $table->integer("points");
            $table->unsignedBigInteger("exercises_lists_id");
            $table->foreign("exercises_lists_id")
                    ->references("id")
                    ->on("exercises_lists")
                    ->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises_set');
    }
};
