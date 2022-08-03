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
        Schema::create('overall_training_evaluations', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('CID');
            $table->string('OverTrainingEvaluationTitle');
            $table->longText('Evaluation');
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
        Schema::dropIfExists('overall_training_evaluations');
    }
};