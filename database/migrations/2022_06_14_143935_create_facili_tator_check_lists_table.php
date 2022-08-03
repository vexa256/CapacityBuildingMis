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
        Schema::create('facili_tator_check_lists', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('UserID');
            $table->string('CID');
            $table->string('MID');
            $table->string('FacilitatorGuideTitle');
            $table->string('url');
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
        Schema::dropIfExists('facili_tator_check_lists');
    }
};
