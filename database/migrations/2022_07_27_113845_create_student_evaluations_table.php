<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_evaluations', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('CID');
            $table->string('UserID');
            $table->string('Country');
            $table->string('OverallTheTrainingMetMyExpectations');
            $table->string('IWillBeAbleToApplyTheKnowledgeLearned');
            $table->string('TheTrainingOutcomesWereMet');
            $table->string('HowDoYouRateTheTrainingOverall');
            $table->string('TheTrainingWasRelevantToMyWork');
            $table->longText('UseofSkills');
            $table->longText('OtherComments');
            $table->string('InstructorFeedback');
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
        Schema::dropIfExists('student_evaluations');
    }
};
