<?php

use App\Http\Controllers\AdminStatsController;
use App\Http\Controllers\AttemptExams;
use App\Http\Controllers\AttemptPostExamController;
use App\Http\Controllers\AttemptPracticalExamController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\ExamEnablerController;
use App\Http\Controllers\InstructorsController;
use App\Http\Controllers\InstructorTwoController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MarkModularTestController;
use App\Http\Controllers\MarkPostExamController;
use App\Http\Controllers\MarkPracticalTestController;
use App\Http\Controllers\MarkPreTestExamController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\OpenController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ScoreBoardController;
use App\Http\Controllers\StudentEvaluationController;
use App\Http\Controllers\TestSetterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::controller(AttendanceController::class)->group(function () {

    Route::any('StudentAttendance', 'StudentAttendance')->name('StudentAttendance');

    Route::any('MarkStudentAttendance/{id}', 'MarkStudentAttendance')->name('MarkStudentAttendance');

    Route::any('AcceptMarkStudentAttendance', 'AcceptMarkStudentAttendance')->name('AcceptMarkStudentAttendance');

    Route::any('SelectStudentAttend/{id}', 'SelectStudentAttend')->name('SelectStudentAttend');

    Route::any('AcceptCourseAttend', 'AcceptCourseAttend')->name('AcceptCourseAttend');

    Route::any('SelectCourseAttend', 'SelectCourseAttend')->name('SelectCourseAttend');

});

Route::controller(ReportsController::class)->group(function () {

    Route::any('MgtUsers', 'MgtUsers')->name('MgtUsers');

    Route::any('CourseEnrollment', 'CourseEnrollment')->name('CourseEnrollment');

    Route::any('StudentDatabase', 'StudentDatabase')->name('StudentDatabase');

    Route::any('CountryEnrollment', 'CountryEnrollment')->name('CountryEnrollment');

});
Route::controller(OpenController::class)->group(function () {
    Route::any('StudentModules', 'StudentModules')->name('StudentModules');

    Route::any('NewStudent', 'NewStudent')->name('NewStudent');

    Route::any('/', 'ViewCourses')->name('ViewCourses');

    Route::any('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth'])->group(function () {

    Route::controller(StudentEvaluationController::class)->group(function () {

        Route::any('StudentEvaluationReport', 'StudentEvaluationReport')
            ->name('StudentEvaluationReport');

        Route::any('SubmitEvaluation', 'SubmitEvaluation')->name('SubmitEvaluation');

        Route::any('StudentCourseEvaluation', 'StudentCourseEvaluation')->name('StudentCourseEvaluation');

    });

    Route::controller(AdminStatsController::class)->group(function () {

        Route::any('AdminStats', 'AdminStats')->name('AdminStats');

    });

    Route::controller(ScoreBoardController::class)->group(function () {

        Route::any('MarkStudentAttendanceLogic', 'MarkStudentAttendanceLogic')
            ->name('MarkStudentAttendanceLogic');

        Route::get('CertifiedStudents', 'CertifiedStudents')->name('CertifiedStudents');

        Route::get('Certify', 'Certify')->name('Certify');

        Route::get('RunScoreTotal', 'RunScoreTotal')->name('RunScoreTotal');
    });

    Route::controller(MarkPracticalTestController::class)->group(function () {

        Route::post('AcceptMarkPractical', 'AcceptMarkPractical')->name('AcceptMarkPractical');

        Route::get('MarkPracticalTestNow/{id}', 'MarkPracticalTestNow')->name('MarkPracticalTestNow');

        Route::get('SelectCourseToMarkPractical', 'SelectCourseToMarkPractical')->name('SelectCourseToMarkPractical');
    });

    Route::controller(MarkModularTestController::class)->group(function () {

        Route::post('AcceptMarkModular', 'AcceptMarkModular')->name('AcceptMarkModular');

        Route::get('MarkModularTestNow/{id}', 'MarkModularTestNow')->name('MarkModularTestNow');

        Route::get('SelectCourseToMarkModular', 'SelectCourseToMarkModular')->name('SelectCourseToMarkModular');

    });

    Route::controller(MarkPreTestExamController::class)->group(function () {

        Route::post('AcceptMarkPreTest', 'AcceptMarkPreTest')->name('AcceptMarkPreTest');

        Route::get('MarkPreTestTestNow/{id}', 'MarkPreTestTestNow')->name('MarkPreTestTestNow');

        Route::get('SelectCourseToMarkPreTest', 'SelectCourseToMarkPreTest')->name('SelectCourseToMarkPreTest');
    });

    Route::controller(MarkPostExamController::class)->group(function () {

        Route::post('AcceptMarkPost', 'AcceptMarkPost')->name('AcceptMarkPost');

        Route::get('MarkPostTestNow/{id}', 'MarkPostTestNow')->name('MarkPostTestNow');

        Route::get('SelectCourseToMark', 'SelectCourseToMark')->name('SelectCourseToMark');

    });

    Route::controller(AttemptPostExamController::class)->group(function () {

        Route::get('PostTestToAttemptSelected/{id}', 'PostTestToAttemptSelected')->name('PostTestToAttemptSelected');

        Route::post('SubmitPostAnswer', 'SubmitPostAnswer')
            ->name('SubmitPostAnswer');

        Route::get('StartPostExam', 'StartPostExam')->name('StartPostExam');

    });

    Route::controller(AttemptPracticalExamController::class)->group(function () {

        Route::post('SubmitPracticalAnswer', 'SubmitPracticalAnswer')->name('SubmitPracticalAnswer');

        Route::get('PracticalTestToAttemptSelected/{id}', 'PracticalTestToAttemptSelected')->name('PracticalTestToAttemptSelected');

        Route::get('StartPracticalExam', 'StartPracticalExam')->name('StartPracticalExam');
    });

    Route::controller(AttemptExams::class)->group(function () {

        Route::any('SubmitModularAnswer', 'SubmitModularAnswer')->name('SubmitModularAnswer');

        Route::get('ModularTestToAttemptSelected/{id}', 'ModularTestToAttemptSelected')->name('ModularTestToAttemptSelected');

        Route::get('StartModularExam', 'StartModularExam')->name('StartModularExam');
    });

    Route::controller(AttemptExams::class)->group(function () {

        Route::get('ResetTimer/{id}', 'ResetTimer')->name('ResetTimer');

        Route::get('SetTestTimer', 'SetTestTimer')->name('SetTestTimer');

    });

    Route::controller(ExamEnablerController::class)->group(function () {
        Route::any('SelectPracticalTestActivate', 'SelectPracticalTestActivate')->name('SelectPracticalTestActivate');

        Route::any('AcceptPracticalEnable', 'AcceptPracticalEnable')->name('AcceptPracticalEnable');

        Route::any('PracticalTestActivation/{id}', 'PracticalTestActivation')->name('PracticalTestActivation');
    });

    Route::controller(ExamEnablerController::class)->group(function () {

        Route::any('SelectModularTestActivate', 'SelectModularTestActivate')->name('SelectModularTestActivate');

        Route::any('AcceptModularEnable', 'AcceptModularEnable')->name('AcceptModularEnable');

        Route::any('ModularTestActivation/{id}', 'ModularTestActivation')->name('ModularTestActivation');
    });

    Route::controller(ExamEnablerController::class)->group(function () {

        Route::any('DeActivateSelectedTest/{id}/{TableName}', 'DeActivateSelectedTest')->name('DeActivateSelectedTest');

        Route::any('ActivateSelectedTest/{id}/{TableName}', 'ActivateSelectedTest')->name('ActivateSelectedTest');

        Route::any('EnablePostTest/{id}', 'EnablePostTest')->name('EnablePostTest');

        Route::any('AcceptEnablePostTestSelectCourse', 'AcceptEnablePostTestSelectCourse')->name('AcceptEnablePostTestSelectCourse');

        Route::get('EnablePostTestSelectCourse', 'EnablePostTestSelectCourse')->name('EnablePostTestSelectCourse');

    });

    Route::controller(OpenController::class)->group(function () {

        Route::post('ApproveAppLogic', 'ApproveAppLogic')->name('ApproveAppLogic');

        Route::get('/MarkAppAsDeclined/{id}', 'MarkAppAsDeclined')->name('MarkAppAsDeclined');
        Route::get('/MarkAppAsApproved/{id}', 'MarkAppAsApproved')->name(
            'MarkAppAsApproved'
        );

        Route::get('/ApproveStudentApps', 'ApproveStudentApps')->name('ApproveStudentApps');

        Route::get('/ApplicationStatus', 'ApplicationStatus')->name('ApplicationStatus');
    });

    Route::controller(NotesController::class)->group(function () {

        Route::post('NewDoc', 'NewDoc')->name('NewDoc');

        Route::any('DeleteDoc/{id}/{TableName}', 'DeleteDoc')->name('DeleteDoc');

        Route::any('MgtNotes/{id}', 'MgtNotes')->name('MgtNotes');

        Route::any('NotesModule/{CID}', 'NotesModule')->name('NotesModule');

        Route::post('NotesAcceptModule', 'NotesAcceptModule')->name('NotesAcceptModule');

        Route::post('AcceptCourseNotes', 'AcceptCourseNotes')->name('AcceptCourseNotes');

        Route::get('NotesSelectCourse', 'NotesSelectCourse')->name('NotesSelectCourse');
    });

    Route::controller(InstructorTwoController::class)->group(function () {

        Route::get('FacilitatorCheckList', 'FacilitatorCheckList')
            ->name('FacilitatorCheckList');

    });

    Route::controller(InstructorsController::class)->group(function () {

        Route::get('ViewMarkingGuide/{id}', 'ViewMarkingGuide')->name('ViewMarkingGuide');

        Route::any('AcceptCourseMarkingGuide', 'AcceptCourseMarkingGuide')->name('AcceptCourseMarkingGuide');

        Route::get('SelectCourseMarkingGuide', 'SelectCourseMarkingGuide')->name('SelectCourseMarkingGuide');

        Route::get('ViewCourseSchedule', 'ViewCourseSchedule')->name('ViewCourseSchedule');

        Route::any('ViewVideoLinks', 'ViewVideoLinks')->name('ViewVideoLinks');

        Route::get('SelectLinksCourse', 'SelectLinksCourse')->name('SelectLinksCourse');

        Route::get('ViewNotes/{id}', 'ViewNotes')->name('ViewNotes');

        Route::get('ViewModules/{id}', 'ViewModules')->name('ViewModules')
        ;
        Route::get('DeleteInstructor/{id}', 'DeleteInstructor')->name('DeleteInstructor');

        Route::get('InstructorViewCourses', 'InstructorViewCourses')->name('InstructorViewCourses');

        Route::get('InstructorGuides', 'InstructorGuides')->name('InstructorGuides');

        Route::post('NewInstructor', 'NewInstructor')->name('NewInstructor');

        Route::get('InstrCourseSelect/{id}', 'InstrCourseSelect')->name('InstrCourseSelect');

        Route::post('AcceptInstCourse', 'AcceptInstCourse')->name('AcceptInstCourse');

        Route::get('InstrSelectCourse', 'InstrSelectCourse')->name('InstrSelectCourse');

    });
    Route::controller(TestSetterController::class)->group(function () {

        Route::any('MgtModularTests/{id}', 'MgtModularTests')->name('MgtModularTests');

        Route::any('ModularSelectModule', 'ModularSelectModule')->name('ModularSelectModule');

        Route::any('AcceptModuleSelection', 'AcceptModuleSelection')->name('AcceptModuleSelection');

        Route::any('ModularSelectCourse', 'ModularSelectCourse')->name('ModularSelectCourse');

        Route::any('AcceptPracticalModule', 'AcceptPracticalModule')->name('AcceptPracticalModule');

        Route::any('SelectPracticalModule', 'SelectPracticalModule')->name('SelectPracticalModule');

        Route::any('SelectCoursePractical', 'SelectCoursePractical')->name('SelectCoursePractical');

        Route::any('AcceptCoursePractical', 'AcceptCoursePractical')->name('AcceptCoursePractical');

        Route::any('MgtPracticalTest/{id}', 'MgtPracticalTest')->name('MgtPracticalTest');

        Route::any('SelectCourseForPostTest', 'SelectCourseForPostTest')->name('SelectCourseForPostTest');

        Route::any('AcceptCoursePostTest', 'AcceptCoursePostTest')->name('AcceptCoursePostTest');

        Route::any('MgtPostTest/{id}', 'MgtPostTest')->name('MgtPostTest');

        Route::any('MgtPreTest/{id}', 'MgtPreTest')
            ->name('MgtPreTest');

        Route::any('AcceptCoursePretest', 'AcceptCoursePretest')
            ->name('AcceptCoursePretest');

        Route::any('SelectPretestCourse', 'SelectPretestCourse')
            ->name('SelectPretestCourse');

    });

    Route::controller(CourseController::class)->group(function () {

        Route::get('MgtMarkingGuide', 'MgtMarkingGuide')->name('MgtMarkingGuide');

        Route::get('MgtCourseSchedule', 'MgtCourseSchedule')->name('MgtCourseSchedule');

        Route::get('MgtVideoLinks/{id}', 'MgtVideoLinks')->name('MgtVideoLinks');

        Route::any('AcceptVideoCourse', 'AcceptVideoCourse')->name('AcceptVideoCourse');

        Route::get('CourseLinksCourse', 'CourseLinksCourse')->name('CourseLinksCourse');

        Route::any('ModuleCourseSelected', 'ModuleCourseSelected')->name('ModuleCourseSelected');

        Route::any('MgtModules/{id}', 'MgtModules')->name('MgtModules');

        Route::get('MgtCourses', 'MgtCourses')->name('MgtCourses');

        Route::get('SelectCourseModule', 'SelectCourseModule')
            ->name('SelectCourseModule');

    });

    Route::controller(MainController::class)->group(function () {

        Route::get('MainConsole', 'MainConsole')->name('MainConsole');

        // Route::get('/', 'MainConsole');

        // Route::get('dashboard', 'MainConsole')->name('dashboard');
    });

    Route::controller(CrudController::class)->group(function () {
        Route::get('DeleteData/{id}/{TableName}', 'DeleteData')->name(
            'DeleteData'
        );

        Route::post('MassUpdate', 'MassUpdate')->name('MassUpdate');

        Route::post('MassInsert', 'MassInsert')->name('MassInsert');
    });

});

require __DIR__ . '/auth.php';