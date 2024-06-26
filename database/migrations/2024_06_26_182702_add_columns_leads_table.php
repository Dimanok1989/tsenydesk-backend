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
            $table->timestamp('date_sale_term')->nullable()->comment('Срок продажи')->after('date_sale');
            $table->timestamp('date_sent_documents_actual')->nullable()->comment('Фактическая дата поступления документов')->after('date_sent_documents');
            $table->timestamp('date_inspection_actual')->nullable()->comment('Фактическая дата проверки')->after('date_inspection');
            $table->timestamp('date_remeasurement_actual')->nullable()->comment('Фактическая дата проведенного перезамера')->after('date_remeasurement');
            $table->timestamp('date_start_actual')->nullable()->comment('Фактическая дата запуска')->after('date_start');
            $table->jsonb('inspection_types')->nullable()->comment('Выбранные критерии проверки');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn([
                'date_sale_term',
                'date_sent_documents_actual',
                'date_inspection_actual',
                'date_remeasurement_actual',
                'date_start_actual',
                'inspection_types',
            ]);
        });
    }
};
