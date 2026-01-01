<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('member_profiles', function (Blueprint $table) {
            if (! Schema::hasColumn('member_profiles', 'date_of_appointment')) {
                $table->date('date_of_appointment')->nullable();
            }
            if (! Schema::hasColumn('member_profiles', 'grade_level')) {
                $table->string('grade_level')->nullable();
            }
            if (! Schema::hasColumn('member_profiles', 'department')) {
                $table->string('department')->nullable();
            }
            if (! Schema::hasColumn('member_profiles', 'retirement_year')) {
                $table->string('retirement_year')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('member_profiles', function (Blueprint $table) {
            $table->dropColumn(['date_of_appointment', 'grade_level', 'department', 'retirement_year']);
        });
    }
};
