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
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom setelah kolom 'email' agar rapi
            $table->string('phone_number')->unique()->nullable()->after('email');
            $table->enum('gender', ['Laki-laki', 'Perempuan'])->nullable()->after('phone_number');
            $table->text('address')->nullable()->after('gender');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone_number', 'gender', 'address']);
        });
    }
};