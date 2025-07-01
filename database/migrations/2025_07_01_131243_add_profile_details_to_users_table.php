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
            $table->string('business_name')->nullable()->after('name');
            $table->string('phone_number')->nullable()->after('business_name');
            $table->text('address')->nullable()->after('phone_number');
            $table->text('business_description')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('business_name');
            $table->dropColumn('phone_number');
            $table->dropColumn('address');
            $table->dropColumn('business_description');
        });
    }
};