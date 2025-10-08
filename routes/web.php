<?php


//Auth::routes();//

Auth::routes(['register' => false]);

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// $url = \Request::url();
// $check = strstr($url,"http://");
// if($check)
// {
// 	$newUrl = str_replace("http","https",$url);
// 	header("Location:".$newUrl);
// }
Route::get('privacy-policy.html',function(){
    return view('privacy_policy');
});

Route::get('/adminOtp', 'WebsiteController@adminOtp');


Route::get('updateBulkStudentID','StudentController@updateBulkStudentID');

Route::get('/student/free_lecture', 'WebsiteController@free_lecture')->name('free_lecture');
Route::get('/student/free_exam', 'WebsiteController@free_exam')->name('free_exam');

Route::get('/contact', 'WebsiteController@contact')->name('contact');
Route::get('/about_us', 'WebsiteController@aboutUs')->name('aboutUs');
Route::get('/news', 'WebsiteController@news')->name('news');
Route::get('/mentors', 'WebsiteController@mentors')->name('mentors');


Route::get('/free_lectures/batch/{batch_id}', 'WebsiteController@free_lectures_subjects');
Route::get('/free_lectures/batch/{batch_id}/subject/{subject_id}/chapter', 'WebsiteController@free_lectures_chapters');
Route::get('/free_lectures/batch/{batch_id}/subject/{subject_id}/chapter/{chapter_id}/classes', 'WebsiteController@free_lectures_classes');
Route::get('/free_lectures/batch/{batch_id}/class/{id}', 'WebsiteController@free_lectures_video');


Route::get('/free_exam/batch/{batch_id}/', 'WebsiteController@free_exams');

    
Route::get('/clinical_case/{batch_id}', 'WebsiteController@clinical_cases');
Route::get('/clinical_case/question/{id}', 'WebsiteController@clinical_case_question');
Route::post('/clinical_case/answer', 'WebsiteController@clinical_case_answer');
Route::get('/clinical_case/answer/{id}', 'WebsiteController@clinical_case_answer');


Route::get('/main_page', 'WebsiteController@main_page');

//Route::get('/student/class/{id}', 'WebsiteController@free_video')->name('free_video');


/* Clinical Case*/
Route::get('/clinical_cases_list/user/{userId}', 'WebsiteController@clinical_cases_list');




// bkash
Route::post('/bkash-create', 'BkashController@createPayment')->name('url-create');
Route::get('/bkash-callback', 'BkashController@callback')->name('url-callback');



Route::group(['middleware' => 'membership_login'], function () {
    

    Route::get('/notice/{id}', 'StudentController@notice')->name('notice');
    Route::get('/lecture/user/{id}', 'StudentController@lecture')->name('lecture');    
    Route::get('/live_class/user/{id}', 'StudentController@liveClass')->name('lecture');
    Route::get('/discussion/user/{id}', 'StudentController@discussion')->name('lecture');
    Route::get('/exam/user/{id}', 'StudentController@exam')->name('exam');
    
    
	Route::get('/spacialmodeltest-exam/{type}', 'WebsiteController@spacialmodeltest')->name('spacialmodeltest');
	Route::get('/exam_by_batch/{batch_id}', 'WebsiteController@examByBatch')->name('exam_by_batch');
	Route::get('/spacialmodeltest-examm/{id}', 'WebsiteController@question')->name('question');
	
    Route::get('/question_bank', 'WebsiteController@question_bank');
    Route::get('/question_bank_topic/{id}', 'WebsiteController@question_bank_topic');


	
	Route::get('/batch/{batch_id}/class/{class_id}/quiz/{quiz_id}', 'WebsiteController@quiz')->name('quiz');
	Route::get('/solve_class/{id}', 'WebsiteController@solve_class')->name('solve_class');
	Route::get('/solve_video/{modelTestId}/{questionId}', 'WebsiteController@solve_video')->name('solve_video');
	Route::get('/seeAnswerResult/{answer_id}','WebsiteController@seeAnswerResult');
	Route::get('/seeQuizResult/{quiz_id}','WebsiteController@seeQuizResult');
	Route::get('/lecture-sheeet-view', 'WebsiteController@lecture_sheeet')->name('lecture.sheeet');


    Route::post('/student/profile/update', 'StudentController@profileUp')->name('profileUp');
    Route::get('/student/profile/{id}', 'StudentController@profile')->name('profile');
    Route::get('/schedule/batch/{batch_id}', 'WebsiteController@scheduleLink')->name('scheduleLink');
    Route::get('/discussion/batch/{batch_id}', 'WebsiteController@discussionLink')->name('discussionLink');

    Route::get('/live/{batch_id}', 'WebsiteController@liveLink')->name('liveLink');

    Route::get('/student/batch/{id}/enroll', 'StudentController@batchEnroll')->name('batch_enroll');
    
    Route::get('/updateInfo/{userId}/{type}/{id}', 'StudentController@updateInfo')->name('updateInfo');
    Route::post('/updateInfo/{userId}/{type}/{id}', 'StudentController@postUpdateInfo')->name('postUpdateInfo');

    Route::get('/student/batch/{id}/module/{module_id}/subcategory/{subcategory_id}/enroll', 'StudentController@moduleSubcategoryEnroll');
    
    
    // old system
    
    Route::get('/student/batch/{id}/old_enroll', 'StudentController@old_batchEnroll')->name('old_batch_enroll');
    Route::get('/old_payment/{id}', 'StudentController@old_payment')->name('old_payment');

    
    Route::get('/payment_history/{id}', 'StudentController@paymentHistory')->name('paymentHistory');
    Route::get('/payment_completed', 'StudentController@paymentCompleted')->name('paymentCompleted');
   
    Route::get('/payment/{id}', 'StudentController@payment')->name('payment');
    Route::get('/payment/batch/{id}/module/{module_id}/subcategory/{subcategory_id}', 'StudentController@module_subcategory_payment');

    Route::get('/student/due/{id}', 'StudentController@due')->name('due');


    Route::get('/batch/{batch_id}/subjects', 'WebsiteController@subjects');
    Route::get('/batch/{batch_id}/modules', 'WebsiteController@modules');

    Route::get('/batch/{batch_id}/subject/{subject_id}/chapter', 'WebsiteController@chapters')->name('subject_chapters');
    
        Route::get('/batch/{batch_id}/modules/{module_id}/subcategories', 'WebsiteController@moduleSubcategories');
    
    Route::get('/batch/{batch_id}/subject/{subject_id}/chapter/{chapter_id}/classes', 'WebsiteController@classes')->name('chapter_classes');
    Route::get('/batch/{batch_id}/class/{id}', 'WebsiteController@lecture_video')->name('lecture_video');
    Route::get('/batch/{batch_id}/class/{id}/note1', 'WebsiteController@note1')->name('note1');
    Route::get('/batch/{batch_id}/class/{id}/note2', 'WebsiteController@note2')->name('note2');
    Route::get('/batch/{batch_id}/class/{id}/pdf', 'WebsiteController@pdf')->name('pdf');

    Route::get('/lecture/exam/{id}', 'WebsiteController@lecture_exam')->name('lecture_exam'); //bt modificaiton

    Route::get('/student/{userId}/watch/clinical_case/{caseId}', 'WebsiteController@watch_clinical_case'); // watch clinical case


    Route::get('/student/free_class', 'WebsiteController@free_classes')->name('free_class');
    //Route::get('/student/class/{id}', 'WebsiteController@free_video')->name('free_video');
    Route::get('/my/class/{idd}', 'WebsiteController@class_info');
    Route::get('/my/chapter/{id}', 'WebsiteController@chapter');

    Route::get('/exam-point', 'WebsiteController@point')->name('point');
    Route::get('/exam/point/list/{id}', 'WebsiteController@point_list')->name('point.list');
    Route::get('/exam/point/list/fcps/{id}', 'WebsiteController@point_list_fcps');
    Route::get('/exam/point/list/ms_md_dds/{id}', 'WebsiteController@point_list_ms_md_dds');
    Route::get('/exam/point/list/discipline/{id}', 'WebsiteController@point_list_discipline');
    Route::get('/exam/point/list/discipline/{id}/{discipline}', 'WebsiteController@point_list_by_discipline');

    Route::get('/exam/result', 'WebsiteController@result')->name('result');
    Route::get('/my_exam_history/{id}','WebsiteController@my_exam_history')->name('my_exam_history');
    Route::get('/my_quiz_history/{id}','WebsiteController@my_quiz_history')->name('my_quiz_history');
    Route::get('/bookmarks/{id}','WebsiteController@bookmarks')->name('bookmarks');
    Route::get('/watchlist/{id}','WebsiteController@watch_history')->name('watch_history');

    //Route::get('/profile/{id}','WebsiteController@resultProfile')->name('result.profile'); //bt modification

    Route::get('/profile/{id}','WebsiteController@studentProfile'); //bt modification


    Route::get('/view-videos/{id}', 'WebsiteController@view_video')->name('view_video');
    Route::get('/student/dashboard/{id}', 'WebsiteController@index')->name('index');
    Route::get('/application', 'WebsiteController@application')->name('application');
    Route::get('/result-sheet', 'WebsiteController@resultsheet')->name('resultsheet');
    Route::post('/student/paidmember', 'WebsiteController@paidmember')->name('paidmember');
    Route::get('/student/admission/form/show', 'WebsiteController@admissionFormShow')->name('admissionform.show'); //bt modification
    Route::post('/student/admission/form/save', 'WebsiteController@admissionFormSave')->name('admissionform.save'); //bt modification

    Route::post('/student/duePay', 'WebsiteController@duePay')->name('duePay');
 
    Route::get('/asked/user/{user_id}', 'StudentController@asked');
    
    Route::get('/ask/user/{user_id}', 'StudentController@ask');
    Route::post('/ask/user/{user_id}', 'StudentController@post_ask');
    
    Route::get('/user/{user_id}/question/{question_id}/edit', 'StudentController@edit_ask');
    Route::post('/user/{user_id}/question/{question_id}/edit', 'StudentController@post_edit_ask');
    
    Route::get('/user/{user_id}/question/{question_id}/delete', 'StudentController@delete_ask');
    
    Route::get('/user/{user_id}/question/{question_id}/answer', 'StudentController@answer_ask');

    Route::get('/mentor/{user_id}/question/{question_id}/answer', 'StudentController@answer_question');
    Route::post('/mentor/{user_id}/question/{question_id}/answer', 'StudentController@post_answer_question');



    
});

Route::get('/not_bought_package_or_approved','WebsiteController@not_approved_or_bought');


Route::get('/help', 'WebsiteController@help')->name('help');
Route::get('/books', 'WebsiteController@books')->name('books');
Route::get('/notices', 'WebsiteController@notices')->name('notices');

Route::get('/main_page', 'WebsiteController@main_page')->name('main_page');
Route::get('/', 'WebsiteController@home')->name('home');
Route::get('/home','WebsiteController@home')->name('home');
Route::get('/batches', 'WebsiteController@active_batches')->name('batches');
Route::get('/batches/category/{id}', 'WebsiteController@active_batches_by_category');


Route::get('batch_details/{batch_id}','WebsiteController@batch_details')->name('batch_content');


Route::get('/lecture-view/{id}', 'WebsiteController@lecture')->name('lecture');
Route::post('/problem/submit', 'WebsiteController@problem')->name('problem');
Route::post('/reply/submit', 'WebsiteController@reaply')->name('reaply');
Route::get('/student/daily-exam', 'WebsiteController@dailyExam')->name('daily.Exam');


Route::post('/answerQuestionModeltest', 'WebsiteController@answerQuestionModeltest');


//Student registration and login
Route::get('/student/login', 'StudentController@login')->name('student.login');
Route::get('/student/login/submit', 'StudentController@loginSubmit')->name('student.loginSubmit');
Route::get('/student/logout', 'StudentController@logout')->name('student.logout');

//student password verification
Route::get('/student/password/{id}/login/{method}', 'StudentController@password')->name('password');
Route::post('/student/password/verify/{id}/{method}', 'StudentController@password_verify')->name('password.verify');

//student Opt verification//
Route::get('/student/otp/{id}/{is_login}', 'StudentController@otp')->name('otp');
Route::post('/student/otp/verify/{id}/{is_login}', 'StudentController@otp_verify')->name('otp.verify');

#Check Email
Route::get('/student/checkEmail/{id}', 'WebsiteController@checkMailView')->name('check_email');


Route::get('student/reset_password','StudentController@resetPassword')->name('reset_password');
Route::post('student/reset_otp','StudentController@resetOtp')->name('password_opt');
Route::get('/student/reset_otp/{id}/reset_password', 'StudentController@showResetPassword')->name('set_opt_password');
Route::post('/student/{id}/reset_pass_submit', 'StudentController@submitResetPass')->name('reset_pass_submit');


Route::get('/demo/register', 'StudentController@demo_register')->name('demo.register');
Route::post('/demo/student/submit', 'StudentController@demo_insert')->name('demo.insert');
Route::get('/student/register', 'StudentController@register')->name('student.register');
Route::post('/student/register/submit', 'StudentController@register_form')->name('register.form');


//Password Reset


//admin route//
Route::get('/admin', 'AdminController@index')->name('index');

Route::get('/admin/student_info/','AdminController@studentsList');
Route::get('/admin/mobile_info/','AdminController@mobileList');
Route::get('/admin/whatsapp_info/','AdminController@whatsappList');


Route::get('/admin/student_info_by_id/','AdminController@studentById');
Route::post('/admin/findUserById/','AdminController@findUserById');

Route::get('/admin/student_info_by_mobile/','AdminController@studentByMobile');
Route::post('/admin/findUserByMobile/','AdminController@findUserByMobile');

Route::get('/admin/student_info_by_name/','AdminController@studentByName');
Route::post('/admin/findUserByName/','AdminController@findUserByName');

Route::get('/admin/student_info/{studentId}','AdminController@details');
Route::get('/admin/enable/otpRequired/{id}', 'AdminController@enableOtp');
Route::get('/admin/disable/otpRequired/{id}', 'AdminController@disableOtp');
Route::get('/admin/profile/user/{id}', 'AdminController@profile_admin');

Route::get('/admin/updateProfile/user/{id}', 'AdminController@view_profile_admin');
Route::post('/admin/updateProfile/user/{id}', 'AdminController@update_user_profile');

Route::get('/admin/payment/user/{id}', 'AdminController@payment_admin');
Route::post('/admin/updateSubscription/user/{userId}/batch/{batchId}', 'AdminController@update_subscription');


Route::get('/admin/lecture/user/{id}', 'AdminController@lecture_admin');    
Route::get('/admin/live_class/user/{id}', 'AdminController@live_class_admin');
Route::get('/admin/discussion/user/{id}', 'AdminController@discussion_admin');
Route::get('/admin/exam/user/{id}', 'AdminController@exam_admin');
Route::get('/admin/modeltest/user/{id}', 'AdminController@modeltest_history_admin');


    

Route::get('/admin/student-delete/{id}', 'AdminController@student_delete')->name('s.delete');
Route::get('/admin/exam-wise-result', 'AdminController@point')->name('admin.point');
Route::get('/admin/exam-wise-result/{id}', 'AdminController@point_lint')->name('admin.point_lint');
Route::get('/admin/search', 'AdminController@search')->name('search');
Route::get('/admin/student/result', 'AdminController@student_result')->name('result');
Route::get('/admin/student/ex/result', 'AdminController@student_ex_result')->name('exam.wish.result');
Route::get('/admin/student/vie/result/{id}', 'AdminController@m_view')->name('exam.wish.view');
Route::get('/admin/student/view/result', 'AdminController@res_view')->name('exam.res_view.view');
Route::match(['get','post'],'/admin/lecture-sheet', 'LectureSheetController@allsheet')->name('student.result');
Route::get('/admin/add/lecture-sheet', 'LectureSheetController@addSheet')->name('add.sheet');
Route::post('/admin/upload/lecture-sheet', 'LectureSheetController@sheetUploads')->name('sheet.Uploads');
Route::post('/admin/update/lecture-sheet', 'LectureSheetController@sheetUpdate')->name('sheet.Updated');
Route::get('/admin/view/lecture-sheet/{id}', 'LectureSheetController@viewSheet')->name('sheet.view');
Route::get('/admin/edit/lecture-sheet/{id}', 'LectureSheetController@editSheet')->name('sheet.edit');
Route::get('/admin/delete/lecture-sheet/{id}', 'LectureSheetController@deleteSheet')->name('sheet.delete');

Route::get('/admin/edit/lecturesheetupdate', 'LectureSheetController@youtubevideoidupdate');
Route::post('/admin/update/youtubevideoid', 'LectureSheetController@youtubevideoidsubmit');




//review//
Route::get('/admin/all/review', 'NoticController@allreview')->name('all.review');
Route::get('/admin/add/review', 'NoticController@addreview')->name('add.review');
Route::post('/admin/upload/review', 'NoticController@reviewUploads')->name('review.Uploads');
Route::get('/admin/delete/review/{id}', 'NoticController@deletereview')->name('review.delete');
Route::get('/admin/view/review/{id}', 'NoticController@viewreview')->name('review.view');


//new//
Route::get('/admin/all/news', 'NoticController@allNews')->name('all.news');
Route::get('/admin/add/news', 'NoticController@addNews')->name('add.news');
Route::post('/admin/upload/news', 'NoticController@NewsUploads')->name('news.Uploads');
Route::get('/admin/delete/news/{id}', 'NoticController@deleteNews')->name('news.delete');
Route::get('/admin/view/news/{id}', 'NoticController@viewNews')->name('news.view');


//photos//
Route::get('/admin/all/photos', 'NoticController@allNotic')->name('all.notic');
Route::get('/admin/add/photos', 'NoticController@addNotic')->name('add.notic');
Route::post('/admin/upload/photos', 'NoticController@noticUploads')->name('notic.Uploads');
Route::get('/admin/view/photos/{id}', 'NoticController@viewnotic')->name('notic.view');
Route::get('/admin/edit/photos/{id}', 'NoticController@editnotic')->name('notic.edit');
Route::get('/admin/delete/photos/{id}', 'NoticController@deletenotic')->name('notic.delete');
Route::post('/admin/update/photos', 'NoticController@noticUpdate')->name('notic.Updated');

//book//
Route::get('/admin/all/books', 'BookController@index')->name('book.index');
Route::get('/admin/add/book', 'BookController@create')->name('book.create');
Route::post('/admin/add/book', 'BookController@store')->name('book.store');
Route::get('/admin/view/book/{id}', 'BookController@view')->name('book.view');
Route::get('/admin/delete/book/{id}', 'BookController@delete')->name('book.delete');

//Mentors//
Route::get('/admin/all/mentors', 'MentorController@index')->name('all.mentors');
Route::get('/admin/add/mentor', 'MentorController@create')->name('add.mentor');
Route::post('/admin/add/mentor', 'MentorController@store')->name('store.mentor');
Route::get('/admin/view/mentor/{id}', 'MentorController@view')->name('mentor.view');
Route::get('/admin/edit/mentor/{id}', 'MentorController@edit')->name('mentor.edit');
Route::post('/admin/update/mentor/{id}', 'MentorController@update')->name('mentor.Updated');
Route::get('/admin/delete/mentor/{id}', 'MentorController@delete')->name('mentor.delete');

//notic//
Route::get('/admin/all/notice', 'NoticController@all_Notic')->name('all.notice');
Route::get('/admin/add/notice', 'NoticController@add_Notic')->name('add.notice');
Route::post('/admin/upload/notice', 'NoticController@notic_Uploads')->name('notice.Uploads');
Route::get('/admin/view/notice/{id}', 'NoticController@view_notic')->name('notice.view');
Route::get('/admin/edit/notice/{id}', 'NoticController@edit_notic')->name('notice.edit');
Route::get('/admin/delete/notice/{id}', 'NoticController@delete_notic')->name('notice.delete');
Route::post('/admin/update/notice', 'NoticController@notic_Update')->name('notice.Updated');


//job//
Route::get('/admin/all/job', 'JobController@alljob')->name('all.job');
Route::get('/admin/add/job', 'JobController@addjob')->name('add.job');
Route::post('/admin/upload/job', 'JobController@jobUploads')->name('job.Uploads');

//modeltest//
Route::get('/admin/all/model', 'ModeltestController@allmodel')->name('all.model');
Route::get('/admin/add/model', 'ModeltestController@addmodel')->name('add.model');


//question bank//
Route::get('/admin/question_bank', 'QuestionBankController@question_bank');
Route::get('/admin/add/question_bank_topic', 'QuestionBankController@addmodel');
Route::post('/admin/upload/question_bank_topic', 'QuestionBankController@modelUploads');
Route::get('/admin/edit/question_bank_topic/{id}', 'QuestionBankController@edittest');
Route::post('/admin/update/question_bank_topic', 'QuestionBankController@testUpdate');
Route::get('/admin/delete/question_bank_topic/{id}', 'QuestionBankController@deletetest');

Route::get('/admin/question_bank_questions/{id}', 'QuestionBankController@all_questions');
Route::get('/admin/edit/question_bank_questions/{id}', 'QuestionBankController@edit_questions')->name('edit.question');
Route::get('/admin/delete/question_bank_questions/{id}', 'QuestionBankController@delete_questions')->name('delete.question');
Route::post('/admin/edit/question_bank_questions/{id}', 'QuestionBankController@edit_submit_questions')->name('edit.submit.question');
Route::get('/admin/add/question_bank_questions/{id}', 'QuestionBankController@add_questions')->name('add.question');
Route::post('/admin/add/question_bank_questions/{id}', 'QuestionBankController@add_submit_questions')->name('add.question.submit');

Route::get('/admin/solve/question_bank_topic/{id}', 'QuestionBankController@solve');


//bt modification for get lectures
Route::get('/admin/add/model/lectures', 'ModeltestController@getLectures')->name('get.lectures');


Route::get('/admin/view/{id}', 'AdminController@view')->name('view');

Route::get('/admin/solve/{id}', 'AdminController@solve')->name('solve');

Route::get('/admin/result/{id}', 'WebsiteController@admin_point_list');




Route::get('/admin/questions/{id}', 'ModeltestController@all_questions')->name('all.question');
Route::get('/admin/edit/questions/{id}', 'ModeltestController@edit_questions')->name('edit.question');
Route::get('/admin/delete/questions/{id}', 'ModeltestController@delete_questions')->name('delete.question');
Route::post('/admin/edit/questions/{id}', 'ModeltestController@edit_submit_questions')->name('edit.submit.question');
Route::get('/admin/add/questions/{id}', 'ModeltestController@add_questions')->name('add.question');
Route::post('/admin/add/questions/{id}', 'ModeltestController@add_submit_questions')->name('add.question.submit');

Route::get('/admin/all/option/{id}', 'ModeltestController@all_option')->name('all.option');
Route::get('/admin/edit/option/{id}', 'ModeltestController@edit_option')->name('edit.option');
Route::post('/admin/edit/option/{id}', 'ModeltestController@update_option')->name('up.option');
Route::get('/admin/add/option/{id}', 'ModeltestController@add_option')->name('add.option');
Route::post('/admin/add/option/{id}', 'ModeltestController@add_submit_option')->name('add.option.submit');

Route::post('/admin/addQuestionsToTest','ModeltestController@addQuestionsToTest')->name('add.questions.to.test');
Route::post('/admin/upload/model', 'ModeltestController@modelUploads')->name('model.Uploads');
Route::get('/admin/view/modeltest/{id}', 'ModeltestController@viewtest')->name('model.view');
Route::get('/admin/edit/modeltest/{id}', 'ModeltestController@edittest')->name('model.edit');
Route::get('/admin/delete/modeltest/{id}', 'ModeltestController@deletetest')->name('model.delete');
Route::post('/admin/update/modeltest', 'ModeltestController@testUpdate')->name('model.Updated');

//modelexam/
Route::get('/admin/all/exam', 'ModelexamController@allexam')->name('all.exam');
Route::get('/admin/add/exam', 'ModelexamController@addexam')->name('add.exam');
Route::post('/admin/upload/exam', 'ModelexamController@examUploads')->name('exam.Uploads');
Route::get('/admin/add/anytime-exam/{id}', 'ModelexamController@createdq')->name('createdq');

//subject/
Route::get('/admin/all/subject', 'SubjectController@allsubject')->name('all.subject');
Route::get('/admin/add/subject', 'SubjectController@addsubject')->name('add.subject');
Route::post('/admin/upload/subject', 'SubjectController@subjectUploads')->name('subject.Uploads');
Route::get('/admin/view/subject/{id}', 'SubjectController@viewsubject')->name('subject.view');
Route::get('/admin/edit/subject/{id}', 'SubjectController@editsubject')->name('subject.edit');
Route::get('/admin/delete/subject/{id}', 'SubjectController@deletesubject')->name('subject.delete');
Route::get('/admin/show/modeltests/{id}', 'SubjectController@showModelTests')->name('show.modeltests');
Route::post('/admin/update/subject', 'SubjectController@subjectUpdate')->name('subject.Updated');

//Paidmember route//
Route::get('/admin/paid/member', 'PaidmemberController@paidmember')->name('paidmember');
Route::get('/admin/paid/member/approve/{id}', 'PaidmemberController@approveMember')->name('paidmember.approve');
Route::get('/admin/paid/member/view/{id}', 'PaidmemberController@memberview')->name('paidmember.view');
Route::get('/admin/paid/member/delete/{id}', 'PaidmemberController@memberdelete')->name('paidmember.delete');

Route::post('/admin/paid/member/update', 'PaidmemberController@student_update')->name('paidmember.update');



Route::resource('/admin/batch_student','Admin\BatchStudentController');
Route::get('/admin/get_batch_student_ajax','Admin\BatchStudentController@getBatchStudent')->name('batch_student_ajax');
//bt modificaiton
Route::post('/admin/batch_student/enroll', 'Admin\BatchStudentController@loadData')->name('data-enroll');
Route::get('/admin/batch_student/{batchId}/enrolled', 'Admin\BatchStudentController@enrolledData');
Route::get('/admin/batch_student/{batchId}/mobile', 'Admin\BatchStudentController@enrolledMobile');
Route::get('/admin/batch_student/{batchId}/whatsapp', 'Admin\BatchStudentController@enrolledWhatsapp');
Route::get('/admin/updateInformation/user/{studentId}/batch/{batchId}/batchSubscription/{enrollId}','AdminController@viewInformation');
Route::post('/admin/updateInformation/user/{studentId}/batch/{batchId}/batchSubscription/{enrollId}','AdminController@updateInformation');


Route::resource('/admin/payment_history','Admin\BatchSubscriptionHistoryController');
Route::post('/admin/payment_history/loadData', 'Admin\BatchSubscriptionHistoryController@loadData')->name('data-payment');



Route::get('/admin/enroll/approve/{id}','Admin\BatchStudentController@approve')->name('batch_student_approve');
Route::get('/admin/enroll/reject/{id}','Admin\BatchStudentController@reject')->name('batch_student_reject');
Route::get('/admin/enroll/deactivate/{id}','Admin\BatchStudentController@deactivate')->name('batch_student_deactivate');
Route::get('/admin/enroll/activate/{id}','Admin\BatchStudentController@activate')->name('batch_student_activate');

##Admin Payment Controller
Route::resource('/admin/payment','Admin\PaymentController');
Route::post('/admin/payment/report', 'Admin\PaymentController@PaymentDataLoad')->name('payment_data_load');
Route::get('/admin/payment/approval/{id}','Admin\PaymentController@approval')->name('payment_approval');
Route::get('/admin/payment/reject/{id}','Admin\PaymentController@reject')->name('payment_reject');

//Paidmember route//
Route::get('/admin/due/member', 'PaidmemberController@all_due')->name('duemember');
Route::get('/admin/due/member/approve/{id}', 'PaidmemberController@dueMember')->name('due.approve');
Route::get('/admin/due/member/view/{id}', 'PaidmemberController@dueview')->name('due.view');
Route::get('/admin/due/member/delete/{id}', 'PaidmemberController@duedelete')->name('due.delete');


//batch//
Route::get('/admin/addmition/batch', 'MembershipController@all')->name('all.batch');
Route::get('/admin/addmition/batch/add', 'MembershipController@add')->name('add.batch');
Route::post('/admin/addmition/batch/add', 'MembershipController@submit')->name('submit.batch');
Route::post('/admin/addmition/batch/update', 'MembershipController@update')->name('update.batch');
Route::get('/admin/addmition/batch/edit/{id}', 'MembershipController@edit')->name('edit.batch');
Route::get('/admin/addmition/batch/delete/{id}', 'MembershipController@delete')->name('delete.batch');

//bt modification start
Route::get('admin/admission/showbatchduration', 'MembershipController@showDuration')->name('show.duration');
Route::get('admin/admission/addbatchduration', 'MembershipController@addBatchDuration')->name('add.duration');
Route::post('admin/admission/storebatchduration', 'MembershipController@storeBatchDuration')->name('store.duration');
Route::get('admin/admission/editbatchduration/{id}', 'MembershipController@editBatchDuration')->name('edit.duration');
Route::post('admin/admission/updatebatchduration', 'MembershipController@updateBatchDuration')->name('update.duration');

//bt modification report
Route::get('/admin/report/summary', 'MembershipController@summaryReport')->name('report.summary');
Route::post('/admin/report/summary/data', 'MembershipController@summaryReportDataload')->name('report.summary.dataload');

Route::get('admin/help', 'HelpController@index');
Route::get('admin/help/add', 'HelpController@create');
Route::post('admin/help/add', 'HelpController@store');
Route::get('admin/help/update/{id}', 'HelpController@edit');
Route::post('admin/help/update', 'HelpController@updateHelp');

//bt modification end

//user route//
Route::get('/admin/all/student', 'UserController@allstudent')->name('allstudent');
Route::get('/admin/student/approve/{id}', 'UserController@student_approve')->name('student_approve');
Route::get('/admin/student/pending/{id}', 'UserController@student_pending')->name('student_pending');
Route::get('/admin/all/user', 'UserController@alluser')->name('alluser');
Route::get('/admin/view/user/{id}', 'UserController@view')->name('user.view');
Route::get('/admin/delete/user/{id}', 'UserController@delete')->name('user.delete');
Route::get('/admin/create/user', 'UserController@add_user')->name('user.add');
Route::post('/admin/store/user', 'UserController@store')->name('user.store');

Route::get('/admin/books', 'VisitorController@all_books')->name('all.books');
Route::get('/admin/books/add', 'VisitorController@add_books')->name('add.books');
Route::post('/admin/books/uploads', 'VisitorController@store')->name('books.store');

// batchPackage
Route::get('/admin/batchPackage', 'BatchpackateController@index')->name('');
Route::get('/admin/batchPackage/create', 'BatchpackateController@create')->name('');
Route::post('/admin/batchPackage/create', 'BatchpackateController@store')->name('');
Route::get('/admin/batchPackage/edit/{id}', 'BatchpackateController@edit')->name('');
Route::post('/admin/batchPackage/edit/{id}', 'BatchpackateController@update')->name('');

Route::get('/admin/batchPackage/delete/{id}', 'BatchpackateController@batch_delete')->name('');



Route::get('/admin/banner', 'BannerController@index')->name('');
Route::get('/admin/banner/create', 'BannerController@create')->name('');
Route::post('/admin/banner/create', 'BannerController@store')->name('');
Route::get('/admin/banner/edit/{id}', 'BannerController@edit')->name('');
Route::post('/admin/banner/edit/{id}', 'BannerController@update')->name('');
Route::get('/admin/banner/delete/{id}', 'BannerController@delete')->name('');


Route::get('/admin/chapter/delete/{id}', 'BannerController@cp_delete');
Route::get('/admin/chapter/create', 'BannerController@cp_create');
Route::post('/admin/chapter/create', 'BannerController@cp_store');
Route::get('/admin/chapter/edit/{id}', 'BannerController@cp_edit');
Route::post('/admin/chapter/edit/{id}', 'BannerController@cp_update');


/**
 * Video lecture load for
 */
Route::get('/app/video/{id}','App\VideoLectureController@playVideo');

//bt modification for report

