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
        Schema::create('employee_evaluation_level_item_sub_criterias', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_evaluation_level_item_criteria_id');
            $table->tinyInteger('rating');
            $table->string('remarks', 50);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_evaluation_level_item_sub_criterias');
    }
};
