<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\Ajax\AjaxController;
use App\Http\Controllers\MarksheetController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ForumReplyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SubmitExamController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserAssignedController;
use App\Http\Controllers\ForumCategoryController;
use App\Http\Controllers\Auth\CustomeForgetPassword;
use App\Http\Controllers\Question\ChapterController;
use App\Http\Controllers\Question\SubjectController;
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\Question\SetQuestionController;
use App\Http\Controllers\Question\QuestionBankQuestionShow;
use App\Http\Controllers\Question\QuestionReviewController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

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


Auth::routes();
Route::post('/login', [LoginController::class, 'login'])->name('login');
// Forget Password
Route::get('forget/password', [CustomeForgetPassword::class, 'showForgetPasswordForm'])->name('forget.password');
Route::post('forget-password', [CustomeForgetPassword::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('forget-password/{url}', [CustomeForgetPassword::class, 'forget_url']);
Route::post('reset-password', [CustomeForgetPassword::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('exam/list', [HomeController::class, 'exam_list'])->name('exam_list');
     //User Profile Update Controller
     Route::get('userprofile', [UserProfileController::class, 'showuserProfile'])->name('showuserProfile');
     Route::put('userprofile', [UserProfileController::class, 'profile'])->name('userprofile.update');


    //Administration Module Start
    // User Role Permission And Module Controller
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserRoleController::class);
    Route::resource('modules', ModuleController::class);
    Route::resource('permissions', PermissionController::class);

    Route::resource('batch', BatchController::class);
    Route::resource('course', CourseController::class);
    Route::get('user/assigned', [UserAssignedController::class, 'index'])->name('assigned.user');
    Route::get('user/assigned/create', [UserAssignedController::class, 'create']);
    Route::post('user/assigned/store', [UserAssignedController::class, 'store']);
    Route::get('user/assigned/view/{id}', [UserAssignedController::class, 'show'])->name('assigned.view');
    Route::delete('user/assigned/delete/{id}', [UserAssignedController::class, 'destroy'])->name('assigned.destroy');
    Route::get('assigned/user/list/{user_id}',[AjaxController::class,'get_sorting_user']);

    //Question Module Start
    Route::resource('subject', SubjectController::class);
    Route::resource('chapter', ChapterController::class);
    Route::resource('question', QuestionController::class);
    Route::put('question/{id}/status', [QuestionController::class, 'status'])->name('question.status');
    Route::get('question/make/{id}', [SetQuestionController::class, 'question_make'])->name('question.question_make');
    Route::post('question/writen/store', [SetQuestionController::class, 'writen_store'])->name('question.writen_store');
    Route::post('question/mcq/store', [SetQuestionController::class, 'mcq_store'])->name('question.mcq_store');
    Route::post('question/cobained/store', [SetQuestionController::class, 'combained_store'])->name('question.combained_store');
    Route::get('all/set/question/{id}/edit', [SetQuestionController::class, 'questionset_edit'])->name('question.questionset_edit');
    Route::put('all/set/question/{id}/update', [SetQuestionController::class, 'questionset_update'])->name('question.questionset_update');
    Route::delete('all/set/question/{id}/delete', [SetQuestionController::class, 'questionset_delete'])->name('question.questionset_delete');
    Route::get('all/set/question/{id}/preview', [SetQuestionController::class, 'questionset_preview'])->name('question.questionset_preview');

    //============Question Rivew======================

    Route::get('question/review/system', [QuestionReviewController::class, 'rivew_index'])->name('review.index');
    Route::get('question/review/{subject_id}/{chapter_id}', [QuestionReviewController::class, 'get_question'])->name('review.question');
    Route::delete('question/review/{id}/delete', [QuestionReviewController::class, 'delete'])->name('question_review.destroy');
    Route::get('question/review/{id}/edit', [QuestionReviewController::class, 'edit'])->name('question_review.edit');
    Route::put('question/review/{id}/update', [QuestionReviewController::class, 'update'])->name('question_review.update');
    Route::get('question/bank/save', [QuestionReviewController::class, 'question_bank'])->name('review.question_bank');
    Route::get('question/review/chapter/{subject_id}/{chapter_id}', [QuestionReviewController::class, 'get_chapter_question'])->name('review.get_chapter_question');
    Route::put('question/review/status/{id}/update', [QuestionReviewController::class, 'single_status_update'])->name('review.status_update');
    Route::get('admin/question/review',[QuestionReviewController::class,'admin_index'])->name('admin_review.index');
    Route::get('admin/question/review/{subject_id}/{chapter_id}',[QuestionReviewController::class,'admin_get_question'])->name('admin_review.question');
    //============Question Rivew======================
    //============Question Question Bank======================
    Route::get('question/bank/view', [QuestionBankQuestionShow::class, 'index'])->name('questionbankquestion.index');
    Route::get('question/bank/view/{subject_id}/{chapter_id}', [QuestionBankQuestionShow::class, 'show_question'])->name('questionbankquestion.show');




    //====================Forum Controller=================================

    Route::get('forum', [ForumController::class, 'index'])->name('forum.index');
    Route::post('forum', [ForumController::class, 'store'])->name('forum.store');
    Route::put('forum/update/{id}', [ForumController::class, 'update'])->name('forum.update');
    Route::get('forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::get('forum/details/{id}', [ForumController::class, 'details'])->name('forum.details');
    Route::get('forum/edit/{id}', [ForumController::class, 'edit'])->name('forum.edit');
    Route::delete('forum/delete/{id}', [ForumController::class, 'destroy'])->name('forum.destroy');
    Route::post('forum/favourit', [ForumController::class, 'add_favoruit']);
    Route::delete('forum/details/favourit/delete', [ForumController::class, 'remove_favoruit']);

    //==================Forum Reply Controller===================================
    Route::post('forum/reply', [ForumReplyController::class, 'store'])->name('forumreply.store');
    Route::delete('forum/reply/delete/{id}', [ForumReplyController::class, 'destroy'])->name('forumreply.destroy');
    Route::delete('favourit', [ForumReplyController::class, 'remove_favoruit']);
    Route::get('forum/details/reply/edit/{id}', [ForumReplyController::class, 'edit'])->name('forumreply.edit');
    Route::put('reply/update', [ForumReplyController::class, 'update'])->name('forumreply.update');

      // ===================Forum Category Controller=========================
      Route::resource('forum/category', ForumCategoryController::class);


    /*
        =========================================
                Exam Section Route Start
        =========================================
*/
    Route::get('exam', [ExamController::class, 'index'])->name('exam.index');
    Route::get('exam/create', [ExamController::class, 'create'])->name('exam.create');
    Route::post('exam', [ExamController::class, 'store'])->name('exam.store');
    Route::get('exam/{id}/edit', [ExamController::class, 'edit'])->name('exam.edit');
    Route::put('exam/{id}/update', [ExamController::class, 'update'])->name('exam.update');
    Route::delete('exam/{id}/delete', [ExamController::class, 'destroy'])->name('exam.destroy');
    Route::get('exam/question/{id}/set', [ExamController::class, 'exam_question'])->name('exam.exam_question');
    Route::get('exam/question/set', [ExamController::class, 'exam_chapter_question'])->name('exam.exam_chapter_question');
    Route::post('exam/question/set', [ExamController::class, 'question_insert'])->name('exam.question_insert');
    Route::get('exam/question/{exam_id}/preview', [ExamController::class, 'question_privew'])->name('exam.question_privew');
    Route::delete('exam/question/{id}/preview/delete', [ExamController::class, 'question_privew_delete'])->name('exam_question_privew.delete');
    Route::post('exam/question/preview/update', [ExamController::class, 'question_privew_update'])->name('exam_question_privew.update');
    Route::put('exam/{id}/status', [ExamController::class, 'status'])->name('exam.status');
    Route::put('exam/{id}/mark/publish', [ExamController::class, 'mark_publish'])->name('exam.mark_publish');

    Route::get('exam/question/{id}',[SubmitExamController::class,'index']);
    Route::post('exam/submit',[SubmitExamController::class,'store'])->name('exam_submit.store');
    Route::post('exam/question/auto/submit',[SubmitExamController::class,'auto_submit']);

    Route::get('exam/evaluation', [EvaluationController::class, 'index'])->name('exam.evaluation');
    Route::get('exam/evaluation/list/{id}', [EvaluationController::class, 'list'])->name('exam.evaluation_list');
    Route::get('exam/evaluation/mark/{id}', [EvaluationController::class, 'mark'])->name('exam.evulation_mark');
    Route::get('exam/evaluation/mark/view/{id}', [EvaluationController::class, 'view']);
    Route::put('exam/evaluation/mark/store', [EvaluationController::class, 'mark_store']);


    Route::get('exam/mark', [MarksheetController::class, 'index'])->name('mark.index');
    Route::get('exam/mark/show', [MarksheetController::class, 'teacher_mark'])->name('mark.teacher_mark');
    Route::get('exam/student/mark/show/{course_id}/{batch_id}/{user_id}', [MarksheetController::class, 'get_usermark']);
    ///Ajax request
    Route::get('get/chapter',[AjaxController::class,'get_schapter'])->name('get-chapter');
    Route::get('get/batch/{course_id}',[AjaxController::class,'getbatch']);
    Route::get('get/batch/user/{batch_id}',[AjaxController::class,'getuser']);
});
