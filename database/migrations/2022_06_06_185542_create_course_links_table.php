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
        Schema::create('course_links', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('LinkTitle');
            $table->string('LinkUrl');
            $table->string('LinkDescription');
            $table->date('ValidFrom');
            $table->date('ValidTo');
            $table->string('status')->default('active');
            $table->string('CID');
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
        Schema::dropIfExists('course_links');
    }
};
