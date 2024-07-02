<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads_remeasurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->nullable()->comment('Идентификатор заявки')->constrained();
            $table->timestamp('date')->nullable()->comment('Дата перезамера');
            $table->timestamp('date_actual')->nullable()->comment('Фактическая дата перезамера');
            $table->foreignId('employee_id')->nullable()->comment('Сотрудник, которому назначили перезамер');
            $table->string('comment', 500)->nullable()->comment('Комментарий');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('leads')
            ->where('date_remeasurement', '!=', null)
            ->orWhere('date_remeasurement_actual', '!=', null)
            ->get()
            ->each(function ($item) {
                DB::table('leads_remeasurements')->isert([
                    'lead_id' => $item->id,
                    'date' => $item->date_remeasurement,
                    'date_actual' => $item->date_remeasurement_actual,
                    'employee_id' => $item->employee_id,
                ]);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads_remeasurements');
    }
};
