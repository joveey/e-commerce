<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->after('name')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->dropColumn('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('category')->after('name')->nullable();
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
