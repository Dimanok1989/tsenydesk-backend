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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->comment('Идентификатор пользователя')->constrained();
            $table->foreignId('employee_id')->nullable()->comment('Идентификатор мастера')->constrained();
            $table->string('number')->nullable()->comment('Номер заявки');
            $table->timestamp('date_sale')->nullable()->comment('Дата продажи');
            $table->timestamp('date_sent_documents')->nullable()->comment('Дата поступления документов');
            $table->timestamp('date_inspection')->nullable()->comment('Дата проверки');
            $table->timestamp('date_remeasurement')->nullable()->comment('Дата проведенного перезамера');
            $table->timestamp('date_start')->nullable()->comment('Дата запуска');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
