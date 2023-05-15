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
        Schema::create('exercises_lists_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_title');
            $table->string('task');
            $table->string('solution');
            $table->string('picture_name')->nullable();
            $table->unsignedBigInteger('exercises_lists_id');
            $table->foreign('exercises_lists_id')
                ->references('id')
                ->on('exercises_lists')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises_lists_sections');
    }
};
