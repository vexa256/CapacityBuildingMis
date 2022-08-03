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
        Schema::create('student_score_boards', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('CID');
            $table->string('StudentID');
            $table->bigInteger('PreTest')->default(0);
            $table->bigInteger('Attendance')->default(20);
            $table->bigInteger('Practicals')->default(0);
            $table->bigInteger('Exercises')->default(0);
            $table->bigInteger('PostTest')->default(0);
            $table->bigInteger('TotalScore');
            $table->string('Comment')->default('Certificate Of Achievement');
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
        Schema::dropIfExists('student_score_boards');
    }
};
