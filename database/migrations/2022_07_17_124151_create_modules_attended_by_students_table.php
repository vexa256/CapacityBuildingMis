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
        Schema::create('modules_attended_by_students', function (Blueprint $table) {
            $table->id();
            $table->string('CID');
            $table->string('UserID');
            $table->string('status')->default('false');
            $table->bigInteger('ModulesExpected');
            $table->bigInteger('ModulesAttended');
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
        Schema::dropIfExists('modules_attended_by_students');
    }
};