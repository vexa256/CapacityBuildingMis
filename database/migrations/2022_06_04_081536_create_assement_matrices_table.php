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
        Schema::create('assement_matrices', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('CID');
            $table->string('StudentID');
            $table->bigInteger('Attendance');
            $table->bigInteger('Practicals');
            $table->bigInteger('Exercises');
            $table->bigInteger('PostTest');
            $table->bigInteger('TotalScore');
            $table->string('Comment')->default('Certificate Of Participation');
            $table->string('certify')->default('false');
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
        Schema::dropIfExists('assement_matrices');
    }
};