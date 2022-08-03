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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('CID');
            $table->string('uuid');
            $table->string('CourseName');
            $table->string('Thumbnail');
            $table->string('CourseCode');
            $table->longText('CourseDescription');
            $table->bigInteger('TotalPreTests')->default(1);
            $table->bigInteger('TotalPostTests')->default(1);
            $table->bigInteger('TotalPracticals')->default(0);
            $table->bigInteger('TotalExercises')->default(0);
            $table->bigInteger('TotalModules')->default(0);
            $table->string('CEU');
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
        Schema::dropIfExists('courses');
    }
};