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
        Schema::table('pdfs', function (Blueprint $table) {
            $table->renameColumn('title' , 'name');
            $table->string('description')->nullable();
            $table->dropColumn('content');
            $table->text('markdown')->nullable();
            $table->enum('for_user_type', ['student', 'teacher', 'all'])->default('all');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
            $table->rename('instructions');
        });
    }

    /**
     * Reverse the migrations.public function up(): void
     */
    public function down(): void
    {
        Schema::table('instructions', function (Blueprint $table) {
            $table->renameColumn('name', 'title');
            $table->string('content');
            $table->dropColumn('markdown');
            $table->dropColumn('description');
            $table->dropColumn('for_user_type');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->rename('pdfs');
        });
    }
};
