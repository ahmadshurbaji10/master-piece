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
    Schema::create('coupons', function (Blueprint $table) {
        $table->id();
        $table->string('code')->unique(); // كود الكوبون
        $table->enum('discount_type', ['fixed', 'percentage']); // نوع الخصم
        $table->decimal('discount_amount', 8, 2); // قيمة الخصم
        $table->integer('usage_limit')->nullable(); // عدد مرات الاستخدام
        $table->integer('used_times')->default(0); // كم مرة تم استخدامه
        $table->date('expires_at')->nullable(); // تاريخ الانتهاء
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
