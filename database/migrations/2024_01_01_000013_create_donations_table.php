<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            // المتبرع ممكن يكون مستخدم مسجل أو زائر (guest)
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('donor_name')->nullable();
            $table->string('donor_email')->nullable();
            $table->string('donor_phone')->nullable();

            // null = تبرع عام لصندوق الجمعية (مش لمشروع محدد)
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();

            $table->decimal('amount', 12, 2);
            $table->string('currency', 10)->default('USD');

            // بيانات بوابة الدفع (تتعبى لما نربط البوابة فعلياً)
            $table->string('payment_gateway')->nullable();     // stripe, paytabs, hyperpay...
            $table->string('transaction_id')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
