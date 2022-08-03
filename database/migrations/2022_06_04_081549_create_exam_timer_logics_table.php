<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_timer_logics', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('AssessmentType')->unique();
            $table->bigInteger('TimeInMinutes')->default(45);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_timer_logics');
    }
};
