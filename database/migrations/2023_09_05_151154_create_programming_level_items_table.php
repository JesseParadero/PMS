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
        Schema::create('programming_level_items', function (Blueprint $table) {
            $table->id();
            $table->integer('language_id');
            $table->tinyInteger('language_type')->comment('0 = Invalid, 1= Programming Language, 2 = Framework');
            $table->string('item_name', 50);
            $table->integer('rank_number');
            $table->decimal('total_score', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programming_level_items');
    }
};
