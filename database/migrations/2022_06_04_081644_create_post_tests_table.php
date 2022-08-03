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
        Schema::create('post_tests', function (Blueprint $table) {
            $table->id();
            $table->string('CID');
            $table->string('uuid');
            $table->string('PostTestTitle');
            $table->string('BriefDescription');
            // $table->string('Active')->default('false');
            $table->string('TestQuestion');
            $table->string('Active')->default('false');
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
        Schema::dropIfExists('post_tests');
    }
};
