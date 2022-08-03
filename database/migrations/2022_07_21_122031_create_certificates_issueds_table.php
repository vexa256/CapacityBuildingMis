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
        Schema::create('certificates_issueds', function (Blueprint $table) {
            $table->id();
            $table->string('CID');
            $table->string('UserID');
            $table->bigInteger('Score');
            $table->string('Type');
            $table->bigInteger('CertNo');
            $table->bigInteger('PostTestScore')->nullable();
            $table->bigInteger('PreTestScore')->nullable();
            $table->bigInteger('PracticalTestScore')->nullable();
            $table->bigInteger('AttendanceScore')->nullable();
            $table->bigInteger('ModularScore')->nullable();
            $table->bigInteger('CEUs')->nullable();
            $table->date('From')->nullable();
            $table->date('To')->nullable();
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
        Schema::dropIfExists('certificates_issueds');
    }
};