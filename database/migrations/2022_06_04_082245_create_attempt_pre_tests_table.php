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
        Schema::create('attempt_pre_tests', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('PretestID');
            $table->string('PretestQuestionID');
            $table->string('status')->nullable();
            $table->string('CID')->nullable();
            $table->string('StudentID');
            $table->string('StudentAnswer');
            $table->bigInteger('Score')->default(0);
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
        Schema::dropIfExists('attempt_pre_tests');
    }
};
