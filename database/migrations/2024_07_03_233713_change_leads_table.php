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
        Schema::table('leads', function (Blueprint $table) {
            $table->timestamp('dismantling_date')->nullable()->comment('Дата предварительного демонтажа')->after('date_inspection_actual');
            $table->foreignId('dismantling_employee_id')->nullable()->comment('Сотрудник, назначенный на демонтаж')->after('dismantling_date');
            $table->string('dismantling_comment', 500)->nullable()->comment('Комментарий к предварительному демонтажу')->after('dismantling_employee_id');
            $table->dropColumn(['date_remeasurement', 'date_remeasurement_actual']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->timestamp('date_remeasurement')->nullable()->comment('Дата проведенного перезамера')->after('date_inspection_actual');
            $table->timestamp('date_remeasurement_actual')->nullable()->comment('Фактическая дата проведенного перезамера')->after('date_remeasurement');
            $table->dropColumn(['dismantling_date', 'dismantling_employee_id', 'dismantling_comment']);
        });
    }
};
