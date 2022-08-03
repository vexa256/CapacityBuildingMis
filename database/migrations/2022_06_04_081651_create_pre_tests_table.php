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
        Schema::create('pre_tests', function (Blueprint $table) {
            $table->id();
            $table->string('CID');
            $table->string('uuid');
            $table->string('Marked')->default('false');
            $table->string('PreTestTitle');
            $table->string('TestQuestion');
            $table->string('BriefDescription');
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
        Schema::dropIfExists('pre_tests');
    }
};
