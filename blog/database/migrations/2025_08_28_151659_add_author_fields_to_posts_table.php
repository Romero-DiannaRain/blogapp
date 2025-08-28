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
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('author_student_id')->nullable()->after('user_id');
            $table->unsignedBigInteger('author_faculty_id')->nullable()->after('author_student_id');
            $table->string('author_name')->nullable()->after('author_faculty_id');
            $table->enum('author_role', ['student', 'faculty'])->nullable()->after('author_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['author_student_id', 'author_faculty_id', 'author_name', 'author_role']);
        });
    }
};
