<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api;

/* Uddoktapay */
Route::post( 'webhook', [UddoktapayController::class, 'webhook'] )->name( 'uddoktapay.webhook' );

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

/*Route::get('test',function (){
    return 'testing api';
});

/**
 * API route group
 */
/*Route::group(['namespace'=>'Api'],function() {

    //without token group
    Route::post('/register', 'AuthenticationController@store');
    Route::post('/otp_verify', 'AuthenticationController@otp_verify');
    Route::post('/resend_otp', 'AuthenticationController@resendOtp');
    Route::post('/login', 'AuthenticationController@login');
    Route::post('/forgot_pass', 'AuthenticationController@forgotUserVerification');
    Route::post('/resetPassword', 'AuthenticationController@resetPassword');


    Route::group(['middleware' => 'api_token'], function () {
        Route::group([], function () {

            Route::get('/token_test', 'AuthenticationController@apiTokenTest');
            Route::get('/student/{id}', 'StudentController@show');
            Route::post('updateStudent/{id}', 'StudentController@changeProfile');


            ##Batch controller
            Route::get('/batch_by_student/{student_id}', 'BatchController@batchByStudent');
            Route::get('/ongoing_batch', 'BatchController@activeBatch');
            Route::post('/enroll_batch', 'BatchController@enrollBatch');
            Route::get('batch_details/{batch_id}', 'BatchController@batch_details');

            //bt modification
            Route::get('subscription/details/{batch_id}', 'BatchController@subscriptionDetails');
            Route::get('total/enrolled/{batch_id}', 'BatchController@totalEnrolled');
            Route::get('faq/details/{batch_id}', 'BatchController@faqDetails');
            Route::get('lecture/number/{batch_id}', 'BatchController@lectureNumber');
            Route::post('/lecture/watch/count/save', 'BatchController@watchCountSave');
            Route::post('/admission/form/save', 'StudentController@admissionFormSave');



            ##Payment controller
            Route::post('/make_payment', 'PaymentController@makePayment');
            Route::get('/payment_history', 'PaymentController@paymentHistory');

            ##Subject Controller
            Route::get('/subjects', 'SubjectController@subjects');
            Route::get('/subject_by_batch', 'SubjectController@subjectByBatch');

            #Chapter Controller
            Route::get('/chapters', 'ChapterController@subjects');
            Route::get('/chapter_by_subject', 'ChapterController@chapterBySubject');
            Route::get('/chapter_lecture_by_subject', 'ChapterController@chapterWithLectureBySubject');
            Route::post('/chapter_by_batch', 'ChapterController@subjectByBatch');

            #Exam List
            Route::get('/spacialmodeltest-exam', 'ExamController@spacialmodeltest');
            Route::get('/exam_by_batch/{batch_id}', 'ExamController@examByBatch');
            Route::get('/spacialmodeltest-exam/{id}', 'ExamController@question');


            Route::post('/submit_model_test', 'ExamController@answerQuestionModeltest');

            Route::get('/seeExamResult/', 'ExamController@seeAnswerResult');
            Route::get('/student/profile/result/{id}', 'ExamController@studentProfileResult'); //bt modification
            Route::get('/examRank/', 'ExamController@point');
            Route::get('/exam/point/list/{id}', 'ExamController@point_lint');
            Route::get('/my_exam_history', 'ExamController@my_exam_history');


            Route::get('/lecture-sheeet-view', 'ExamController@lecture_sheeet');

            Route::get('books', 'BookController@books');

            Route::get('notice', 'NoticeController@getNotice');
        });

    });


    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

});
*/
