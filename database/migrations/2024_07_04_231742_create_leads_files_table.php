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
        Schema::create('leads_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->nullable()->constrained();
            $table->string('name')->nullable()->comment('Наименование файла');
            $table->string('path')->nullable()->comment('Каталог расположения файла');
            $table->string('filename')->nullable('Имя файла');
            $table->string('extension')->nullable()->comment('Расширение файла');
            $table->string('mime_type')->nullable()->comment('Mime type файла');
            $table->string('disk')->nullable()->comment('Файловое хранилище');
            $table->string('group')->nullable()->comment('Группа файлов');
            $table->unsignedBigInteger('size')->nullable()->comment('Размер файла');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.s
     */
    public function down(): void
    {
        Schema::dropIfExists('leads_files');
    }
};
