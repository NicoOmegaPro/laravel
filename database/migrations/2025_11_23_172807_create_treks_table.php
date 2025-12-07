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
        Schema::create('treks', function (Blueprint $table) {
            $table->id();
            $table->string('regNumber')->unique();
            $table->string('name');
            $table->foreignId('municipality_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->ENUM('status', ['yes', 'no'])->default('no');
            $table->integer('totalScore')->nullable()->default(0);
            $table->integer('countScore')->nullable()->default(0);
            $table->float('avgScore')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treks');
    }
};
