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
        Schema::table('exercises_lists', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->decimal("points");
            $table->text('description');
            $table->boolean('is_active')->default(false);
            $table->timestamp('initiation')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('updated_by')
                ->references('id')
                ->on('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });
        Schema::dropIfExists('exercises_sets');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exercises_lists', function (Blueprint $table) {
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('description');
            $table->dropColumn('deadline');
            $table->dropColumn('points');
            $table->dropColumn('initiation');
            $table->dropColumn('is_active');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
        Schema::create('exercises_sets', function (Blueprint $table) {
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
};
