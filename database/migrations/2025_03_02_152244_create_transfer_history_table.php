<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transfer_history', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 100)->nullable();
            $table->decimal('transfer_amount', 19, 2)->nullable();
            $table->string('acc_name', 100)->nullable();
            $table->string('acc_number', 100)->nullable();
            $table->timestamp('created')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
            $table->string('created_by', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_history');
    }
};
