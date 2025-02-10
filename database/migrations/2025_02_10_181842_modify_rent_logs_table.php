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
        Schema::table('rent_logs', function (Blueprint $table) {
            // Mengubah kolom user_id dan book_id menjadi foreignId dengan cascade
            $table->dropForeign(['user_id']);
            $table->dropForeign(['book_id']);
            $table->dropColumn(['user_id', 'book_id']);

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('book_id')->constrained()->onDelete('cascade');

            // Menambahkan kolom baru
            $table->string('rent_code')->unique()->after('book_id');
            $table->enum('status', ['On Process', 'Ready', 'Completed'])->default('On Process')->after('return_date');

            // Menghapus kolom yang tidak dibutuhkan
            $table->dropColumn('actual_return_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rent_logs', function (Blueprint $table) {
            // Rollback ke struktur sebelumnya
            $table->dropColumn('rent_code');
            $table->dropColumn('status');

            $table->unsignedBigInteger('user_id')->after('id');
            $table->unsignedBigInteger('book_id')->after('user_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('book_id')->references('id')->on('books');

            $table->date('actual_return_date')->nullable()->after('return_date');
        });
    }
};
