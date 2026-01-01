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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            // Link to the User (Applicant)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // Application Details
            $table->decimal('amount', 15, 2);
            $table->integer('duration_months');
            $table->text('purpose');
            
            // Approval Workflow
            $table->enum('status', ['pending', 'approved', 'rejected', 'running', 'paid'])->default('pending');
            $table->text('admin_remark')->nullable(); // Reason for rejection or notes
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
