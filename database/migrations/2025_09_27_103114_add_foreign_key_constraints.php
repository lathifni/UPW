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
        Schema::table('donations', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('set null');
        });

        Schema::table('fund_transactions', function (Blueprint $table) {
            $table->foreign('fund_id')->references('id')->on('funds');
            $table->foreign('donation_id')->references('id')->on('donations')->onDelete('set null');
        });

        Schema::table('aid_requests', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['program_id']);
        });

        Schema::table('fund_transactions', function (Blueprint $table) {
            $table->dropForeign(['fund_id']);
            $table->dropForeign(['donation_id']);
        });

        Schema::table('aid_requests', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
};
