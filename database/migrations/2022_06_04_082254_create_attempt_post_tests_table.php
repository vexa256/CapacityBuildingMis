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
        Schema::create('attempt_post_tests', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('CID');
            // $table->string('MID');
            $table->string('PostTestUuid');
            $table->text('PostQuestion');
            $table->string('UserID');
            $table->string('StudentAnswer');
            $table->string('Marked')->default('false');
            $table->bigInteger('Score')->nullable();
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
        Schema::dropIfExists('attempt_post_tests');
    }
};
