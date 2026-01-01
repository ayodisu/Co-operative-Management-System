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
        Schema::table('member_profiles', function (Blueprint $table) {
            // 1. The Commitment (How much they save monthly)
            $table->decimal('monthly_contribution', 15, 2)->default(0.00)->after('retirement_year');
            
            // 2. The Equity (Total savings accumulated)
            $table->decimal('total_contributions', 15, 2)->default(0.00)->after('monthly_contribution');
            
            // 3. The Debt (Current outstanding loan balance)
            $table->decimal('current_loan_balance', 15, 2)->default(0.00)->after('total_contributions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('member_profiles', function (Blueprint $table) {
            $table->dropColumn(['monthly_contribution', 'total_contributions', 'current_loan_balance']);
        });
    }
};
