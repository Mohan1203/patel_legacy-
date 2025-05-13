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
        Schema::table('blogs', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('content')->comment('Foreign key to blog_category table');

            // Add foreign key constraint
            $table->foreign('category_id')->references('id')->on('blog_category')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['category_id']);

            // Then drop the column
            $table->dropColumn('category_id');
        });
    }
};
