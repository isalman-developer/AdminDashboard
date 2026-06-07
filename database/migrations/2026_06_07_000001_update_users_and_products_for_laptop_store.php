<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('default');
            $table->dropColumn(['referral_code', 'parent_id', 'wallet_balance']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['bv', 'pv']);
            $table->unsignedInteger('warranty_months')->default(12)->after('stock_quantity');
            $table->unsignedInteger('discount_percent')->default(0)->after('warranty_months');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('referral_code')->unique('default');
            $table->foreignId('parent_id')->nullable()->constrained('users')->onDelete('set null');
            $table->decimal('wallet_balance', 15, 2)->default(0);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->unsignedInteger('bv')->default(0);
            $table->unsignedInteger('pv')->default(0);
            $table->dropColumn(['warranty_months', 'discount_percent']);
        });
    }
};
