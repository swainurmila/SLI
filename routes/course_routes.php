<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Course\Admin\AuthController;
use App\Http\Controllers\Course\Admin\DashboardController;
use App\Http\Controllers\Course\Admin\Cr_UserController;
use App\Http\Controllers\Course\User\Cr_HomeController;
use App\Http\Controllers\Course\User\Cr_CourseController;
use App\Http\Controllers\Course\User\Cr_ProfileController;
use App\Http\Controllers\Course\User\Cr_ReviewController;
use App\Http\Controllers\Course\Admin\Cr_TrainerController;
use App\Http\Controllers\Course\Admin\Cr_ExamController;
use App\Http\Controllers\Course\Admin\Cr_ClassController;

use App\Http\Controllers\Course\Admin\Cr_SyllabusController;
use App\Http\Controllers\Course\Admin\Cr_AttendanceController;
use App\Http\Controllers\Course\Admin\CourseMasterController;
use App\Http\Controllers\Course\Admin\CourseController;
use App\Http\Controllers\Course\Admin\NotificationController;
use App\Http\Controllers\Course\Admin\RatingController;
use App\Http\Controllers\Course\Admin\EnrollController;

use App\Http\Controllers\Course\Admin\MeetingController;

use App\Http\Controllers\Course\Admin\CertificateController;
use App\Http\Controllers\Training\TrainingMaster\MasterTrainingController;

use App\Http\Controllers\Course\User\Cr_ExaminationController;

use App\Http\Controllers\Course\Admin\CourseTrainerController;

use App\Http\Controllers\Course\ExamUser\OnlineExamController;













/*
|--------------------------------------------------------------------------
| Course Routes
|--------------------------------------------------------------------------
*/

Route::prefix('course')->group(function () {


    Route::group(['middleware' => ['auth.course.guest']], function () {
        Route::get('register',[AuthController::class,'create'])->name('course.register.create');
        Route::post('register',[AuthController::class,'store'])->name('course.register.store');
        Route::get('login',[AuthController::class,'showLogin'])->name('course.login.show');
        Route::post('login',[AuthController::class,'attemptLogin'])->name('course.login.check');
    });



    Route::group(['middleware' => ['auth','auth.course', 'role:User']], function () {
        Route::get('home',[Cr_HomeController::class,'index'])->name('user.course.home');
        Route::get('logout',[Cr_HomeController::class,'logout'])->name('user.course.logout');

        //Course
        Route::any('list',[Cr_CourseController::class,'index'])->name('user.course.list');
        Route::post('search-course',[Cr_CourseController::class,'searchCourse'])->name('user.course.list.search');
        Route::get('{id}/details',[Cr_CourseController::class,'courseDetails'])->name('user.course.details');

        Route::get('cart-list',[Cr_CourseController::class,'showCart'])->name('user.course.showCart');
        Route::get('{id}/add-to-cart',[Cr_CourseController::class,'addToCart'])->name('user.course.details.addCart');
        Route::get('{id}/cart/remove',[Cr_CourseController::class,'removeFormCart'])->name('user.course.details.removeCart');
        Route::get('{course_id}/enroll',[Cr_CourseController::class,'checkout'])->name('user.course.checkout');
        Route::patch('{course_id}/enroll',[Cr_CourseController::class,'enroll'])->name('user.course.enroll');



        //End Course

        //Review Routes
        Route::post('{id}/review/store',[Cr_ReviewController::class,'reviewStore'])->name('user.course.review.store');
        Route::get('reviews-list',[Cr_ReviewController::class,'getAllReviews'])->name('user.course.review.show');


        //End Review Routes
       
        //Profile Routes

        Route::get('enrolled-list',[Cr_ProfileController::class,'enrolledList'])->name('user.course.enrolled.list');
        Route::get('settings',[Cr_ProfileController::class,'settingInfo'])->name('user.course.settings.info');
        Route::Patch('settings',[Cr_ProfileController::class,'settingInfoUpdate'])->name('user.course.settings.info.update');
        //End Profile Routes
        Route::get('view-course-syllabus/{id}',[Cr_ProfileController::class,'viewCourseSyllabus'])->name('user.course.view-course-syllabus');
        Route::get('view-material/{id}',[Cr_ProfileController::class,'viewStudyMaterial'])->name('user.course.view-material');
        Route::post('store-assignment-answer/{id}',[Cr_ProfileController::class,'storeAssignmentAnswer'])->name('user.course.store-assignment-answer');
        Route::get('view-enrolled-class/{id}',[Cr_ProfileController::class,'viewEnrolledClass'])->name('user.course.view-enrolled-class');
        
        //view class
        //View Attendance
        Route::get('view-student-attendance',[Cr_AttendanceController::class,'viewStudentAttendance'])->name('user.course.view-student-attendance');
        Route::post('user-attendance-regularization',[Cr_AttendanceController::class,'userAttendanceregularization'])->name('user.course.user-attendance-regularization');
        //end of attendance


         //Examination
         Route::post('exam/{id}/apply',[Cr_ExaminationController::class,'examApply'])->name('user.course.exam.apply');
         Route::get('view-student-examination',[Cr_ExaminationController::class,'viewStudentExam'])->name('user.course.view-student-examination');
         //End Examination
         //Certificate
         Route::get('course-certificate/{id}',[CertificateController::class,'downloadCertificate'])->name('course.admin.course-certificate');



         Route::get('exam/{id}',[OnlineExamController::class,'index'])->name('user.course.examination.timer');
         Route::get('exam/{id}/start',[OnlineExamController::class,'examScreen'])->name('user.course.examination.start');
         Route::post('exam/{id}/submit',[OnlineExamController::class,'submitAnswer'])->name('user.course.examination.submit');


         Route::get('exam/{id}/exam-info',[OnlineExamController::class,'getExamInfo'])->name('user.course.examination.info');



    });

    Route::post('/course-notification/answer',[NotificationController::class,'studentAnswer'])->name('course-notification-student-answer');

    Route::group(['middleware' => ['auth','auth.course.isadmin', 'role:Course Admin||Trainer']], function () {
        Route::get('dashboard',[DashboardController::class,'index'])->name('admin.course.dashboard'); 
        Route::post('logout',[AuthController::class,'adminLogout'])->name('admin.course.logout');

        //Users Routes
            Route::get('users',[Cr_UserController::class,'index'])->name('course.users');
            Route::get('users/{id}/edit',[Cr_UserController::class,'edit'])->name('course.users.edit');
            Route::get('users/edit/{id}/{status}',[Cr_UserController::class,'updateStatus'])->name('course.users.status');
            Route::put('users/{id}',[Cr_UserController::class,'update'])->name('course.users.update');
        //End Users Routes


        //Trainer Routes
            Route::get('trainers',[Cr_TrainerController::class,'index'])->name('admin.course.trainers');
            
        //End Trainer Routes

        //Profile Routes
            Route::get('my-profile',[DashboardController::class,'viewProfile'])->name('admin.course.profile'); 
            Route::patch('update-profile',[DashboardController::class,'updateProfile'])->name('admin.course.profile.update');
        //End Profile Routes
       
         //Course Category
         Route::get('/course-category',[CourseMasterController::class,'index'])->name('course-category-index');
         Route::post('/course-category-store',[CourseMasterController::class,'store'])->name('course-category-store');
         Route::post('/course-category/{id}',[CourseMasterController::class,'update'])->name('course-category-update');
         Route::delete('/course-category/{id}/delete',[CourseMasterController::class,'destroy'])->name('course-delete-category');
         //End Course Category

         //Course Place
         Route::get('/course-place',[CourseMasterController::class,'placeIndex'])->name('course-place-index');
         Route::post('/course-place-store',[CourseMasterController::class,'placeStore'])->name('course-place-store');
         Route::post('/course-place/{id}',[CourseMasterController::class,'placeUpdate'])->name('course-place-update');
         Route::delete('/course-place/{id}/delete',[CourseMasterController::class,'placeDestroy'])->name('course-delete-place');
        //End Course Place

         //Course Notification
         Route::get('/course-notification',[NotificationController::class,'notificationIndex'])->name('course-notification-index');
         Route::post('/course-notification-store',[NotificationController::class,'notificationStore'])->name('course-notification-store');
         Route::post('/course-notification/{id}',[NotificationController::class,'notificationUpdate'])->name('course-notification-update');
         Route::delete('/course-notification/{id}/delete',[NotificationController::class,'notificationDestroy'])->name('course-delete-notification');

         Route::get('/course-notification/{id}/students',[NotificationController::class,'appliedStudents'])->name('course-notification-applied-students');
         Route::get('/get-exam',[NotificationController::class,'getExam'])->name('get-exam');
         Route::get('/get-course',[NotificationController::class,'getCourse'])->name('get-course');

         Route::get('/course-notification/{id}/answers-list',[NotificationController::class,'answerList'])->name('course-notification-answer-list');


        //End Course Notification
        Route::post('/store-exam-attendance/{id}',[NotificationController::class,'storeExamAttendance'])->name('course.admin.store-exam-attendance');
        Route::get('/exam-result/{id}',[NotificationController::class,'examResult'])->name('course.admin.exam-result');
        Route::post('/store-exam-result/{id}',[NotificationController::class,'storeExamResult'])->name('course.admin.store-exam-result');
        //Examination Attendance

        //End Exam

         //Course 
         Route::get('course-list',[CourseController::class,'courseList'])->name('course.admin.courseList');
         Route::get('create-course',[CourseController::class,'createCourse'])->name('course.createcourse');
         Route::post('create-course-store',[CourseController::class,'createCourseStore'])->name('course.createcoursestore');
         Route::get('edit-course/{id}',[CourseController::class,'editCourse'])->name('course.editCourse');
         Route::post('edit-course-store/{id}',[CourseController::class,'editCourseStore'])->name('course.editCourseStore');
         //View Course
         Route::get('course-view/{id}',[CourseController::class,'courseView'])->name('course.admin.course-view');
         //End Course
         
         //Class
            Route::get('course-view/{id}/syllabus/{syllabus_id}',[Cr_ClassController::class,'index'])->name('course.admin.course-view.class');
            Route::get('course-view/{id}/syllabus/{syllabus_id}/create',[Cr_ClassController::class,'create'])->name('course.admin.course-view.class.create');
            Route::post('course-view/{id}/syllabus/{syllabus_id}/store',[Cr_ClassController::class,'store'])->name('course.admin.course-view.class.store');

            //Meetings
            Route::get('zoom/oauthredirect', [MeetingController::class, 'zoomHandleCallback'])->name('course.admin.class.auth.zoom');
            // Route::post('create-zoom-meeting',[ZoomController::class,'create'])->name('training.admin.zoom.create');
            Route::patch('update-zoom-meeting/{id}',[MeetingController::class,'zoomMeetingUpdate'])->name('course.admin.class.zoom.update');

            Route::get('google-meet-callback', [MeetingController::class, 'googleHandleCallback'])->name('course.admin.class.auth.googlemeet');
            Route::patch('update-google-meet/{id}', [MeetingController::class, 'googleMeetingUpdate'])->name('course.admin.class.auth.googlemeet.update');
            //End Meetings
           
            //Attendance
            Route::get('course-class-attendance/{id}',[Cr_AttendanceController::class,'attendanceIndex'])->name('course.course-class-attendance');
            Route::post('store-class-attendance',[Cr_AttendanceController::class,'attendanceStore'])->name('course.store-class-attendance');
            Route::post('submit-regularization/{id}',[Cr_AttendanceController::class,'regularizationSubmit'])->name('course.submit-regularization');
            
         //End Class


         //Add Exam Questions
         Route::post('exam-total-questions',[Cr_ExamController::class,'examTotalQuestions'])->name('course.admin.exam-total-questions');
         Route::get('exam-add-questions/{id}',[Cr_ExamController::class,'examAddQuestions'])->name('course.admin.exam-add-questions');
         Route::post('exam-store-questions',[Cr_ExamController::class,'examStoreQuestions'])->name('course.admin.exam-store-questions');
         Route::get('exam-edt-questions/{id}',[Cr_ExamController::class,'examEditQuestions'])->name('course.admin.exam-edt-questions');
         Route::post('exam-update-questions/{id}',[Cr_ExamController::class,'examUpdateQuestions'])->name('course.admin.exam-update-questions');
         Route::get('exam-view-questions/{id}',[Cr_ExamController::class,'examViewQuestions'])->name('course.admin.exam-view-questions');
         //End Exam Questions

         //Add Syllabus to Course
         Route::post('store-syllabus',[Cr_SyllabusController::class,'storeSyllabus'])->name('course.admin.store-syllabus');
         Route::post('edit-syllabus',[Cr_SyllabusController::class,'editSyllabus'])->name('course.admin.edit-syllabus');
         //End Syllabus

         //Add Study Material
         Route::get('view-study-material/{id}',[Cr_SyllabusController::class,'viewStudyMaterial'])->name('course.admin.view-study-material');
         Route::post('store-lecture-notes',[Cr_SyllabusController::class,'storeStudyMaterial'])->name('course.admin.store-lecture-notes');
         Route::get('delete-lecture-notes/{id}',[Cr_SyllabusController::class,'deleteLectureNotes'])->name('course.delete-lecture-notes');
         Route::post('store-course-assignment',[Cr_SyllabusController::class,'storeCourseAssignment'])->name('course.admin.store-course-assignment');
         Route::get('view-submitted-assignment/{id}',[Cr_SyllabusController::class,'viewSubmittedAssignment'])->name('course.admin.view-submitted-assignment');
         Route::post('store-assignment-mark/{id}', [Cr_SyllabusController::class, 'storeAssignmentMark'])->name('course.admin.store-assignment-mark');

         Route::post('store-course-presentation',[Cr_SyllabusController::class,'storeCoursePresentation'])->name('course.admin.store-course-presentation');
         Route::get('delete-course-presentation/{id}',[Cr_SyllabusController::class,'deletePresentation'])->name('course.delete-course-presentation');
         //End Study Material

         //Reviews
         Route::get('review-list',[RatingController::class,'index'])->name('course.admin.reviewList');
         
         //End Reviews

         //Enroll
            Route::get('enroll-list',[EnrollController::class,'index'])->name('course.admin.enrollList');
            Route::get('student-export',[EnrollController::class,'export'])->name('course.admin.student.export');
         //End Enroll

         //Certificate
            Route::get('certificate/choose',[CertificateController::class,'index'])->name('course.admin.certificate.list');
            Route::post('certificate/choose',[CertificateController::class,'assignCertificate'])->name('course.admin.certificate.assign.default');

         //End Certificate

         //Course transaction details
         Route::get('course-transaction',[CourseController::class,'courseTransaction'])->name('course.admin.course-transaction');



        Route::get('student-export',[EnrollController::class,'export'])->name('course.admin.student.export');


        Route::get('/course-assign-class/{id}', [CourseTrainerController::class, 'courseAssignClass'])->name('trainer.courseAssignClass');

        

    });


    Route::get('review/{id}/delete',[Cr_ReviewController::class,'destroy'])->name('user.course.review.destroy');


});
    
    