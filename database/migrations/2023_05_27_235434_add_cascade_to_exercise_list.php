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
        foreach (['exercises', 'exercises_lists', 'instructions'] as $table_name) {
            Schema::table($table_name, function (Blueprint $table) {
                $table->dropForeign($table->getTable() === 'instructions' ? 'pdfs_created_by_foreign' : ['created_by']);

                $table->foreign('created_by')
                    ->references('id')
                    ->on('users')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach (['exercises', 'exercises_lists', 'instructions'] as $table_name) {
            Schema::table($table_name, function (Blueprint $table) {
                $table->dropForeign(['created_by']);

                if ($table->getTable() === 'instructions')
                    $table->foreign('created_by', 'pdfs_created_by_foreign')
                        ->references('id')
                        ->on('users')
                        ->nullOnDelete()
                        ->cascadeOnUpdate();
                else
                    $table->foreign('created_by')
                        ->references('id')
                        ->on('users')
                        ->nullOnDelete()
                        ->cascadeOnUpdate();
            });
        }
    }
};
