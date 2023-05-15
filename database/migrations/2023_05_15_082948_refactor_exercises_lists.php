<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('exercises_lists', function (Blueprint $table) {
            $table->string('file_name')->nullable()->change();
            $table->string('base_path')->nullable();
            $table->string('name');
            $table->jsonb('images')->default('[]');
            $table->dropColumn('section_title');
            $table->dropColumn('task');
            $table->dropColumn('solution');
            $table->dropColumn('picture_name');
            $table->dropColumn('points');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(env('APP_ENV') === 'local')
            DB::statement('TRUNCATE TABLE exercises_lists CASCADE');
        Schema::table('exercises_lists', function (Blueprint $table) {
            $table->renameColumn('name', 'file_name');
            $table->dropColumn('base_path');
            $table->dropColumn('file_name');
            $table->dropColumn('images');
            $table->string('section_title');
            $table->string('task');
            $table->string('solution');
            $table->string('picture_name');
            $table->integer('points');
        });
    }
};
