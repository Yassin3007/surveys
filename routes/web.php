<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/',function (){
    return view('auth.selection');
})->name('selection');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

#############################admin#######################
Route::get('admin/login',function (){
    return view('admin.login');
})->name('admin_login');
Route::group(['prefix'=>'admin','middleware'=>'auth'],function (){
    Route::get('/', function () {
        $data  = \App\Models\Table::query()
            ->where('trainee_number',442137478)->get();

        return view('admin.index');
    })->name('admin_home');


    Route::resource('grades', \App\Http\Controllers\Grades\GradeController::class);
    Route::resource('sections', \App\Http\Controllers\Sections\SectionController::class);
    Route::resource('teachers', \App\Http\Controllers\Teachers\TeacherController::class);
    Route::resource('students', \App\Http\Controllers\Students\StudentController::class);
    Route::resource('subjects', \App\Http\Controllers\Subjects\SubjectController::class);
    Route::resource('surveys', \App\Http\Controllers\Surveys\SurveyController::class);
    Route::resource('questions', \App\Http\Controllers\Questions\QuestionController::class);

    Route::get('dowload_empty/{type}',[\App\Http\Controllers\Controller::class,'dowload_empty'])->name('dowload_empty');


    Route::post('add_main_table',[\App\Http\Controllers\Controller::class,'add_main_table'])->name('add_main_table');
    Route::get('upload_file/{type}',[\App\Http\Controllers\Controller::class,'upload_file'])->name('upload_file');
    Route::get('delete_student_main_table',[\App\Http\Controllers\Controller::class,'delete_student_main_table'])->name('delete_student_main_table');
    Route::get('delete_main_table',[\App\Http\Controllers\Controller::class,'delete_main_table'])->name('delete_main_table');
    Route::get('admin_mode',[\App\Http\Controllers\Controller::class,'admin_mode'])->name('admin_mode');

    Route::get('teacher_subjects/{id}',[\App\Http\Controllers\Teachers\TeacherController::class,'teacher_subjects'])->name('teacher_subjects');
    Route::get('subject_survey/{id}',[\App\Http\Controllers\Teachers\TeacherController::class,'subject_survey'])->name('subject_survey');
    Route::get('student_subjects/{id}',[\App\Http\Controllers\Students\StudentController::class,'student_subjects'])->name('student_subjects');
    Route::get('student_survey_answer/{student_id}/{reference_number}/{type}/{survey_id}',[\App\Http\Controllers\Teachers\TeacherController::class,'student_survey_answer'])->name('student_survey_answer');
    Route::post('teacher_subjects_store/{id}',[\App\Http\Controllers\Teachers\TeacherController::class,'teacher_subjects_store'])->name('teacher_subjects_store');
    Route::get('teacher_master_survey_answer/{teacher_id}/{survey_id}',[\App\Http\Controllers\Teachers\TeacherController::class,'teacher_master_survey_answer'])->name('teacher_master_survey_answer');
    Route::post('teachers_export',[\App\Http\Controllers\Teachers\TeacherController::class,'export'])->name('teachers_export');
    Route::post('students_export',[\App\Http\Controllers\Students\StudentController::class,'export'])->name('students_export');
    Route::post('students_id_export',[\App\Http\Controllers\Students\StudentController::class,'students_id_export'])->name('students_id_export');
    Route::get('teachers_table_export',[\App\Http\Controllers\Teachers\TeacherController::class,'teachers_table_export'])->name('teachers_table_export');
    Route::get('students_search',[\App\Http\Controllers\Students\StudentController::class,'students_search'])->name('students_search');
    Route::get('delete_all_students',[\App\Http\Controllers\Students\StudentController::class,'delete_all_students'])->name('delete_all_students');
    Route::get('delete_all_teachers',[\App\Http\Controllers\Teachers\TeacherController::class,'delete_all_teachers'])->name('delete_all_teachers');
    Route::get('teachers_search',[\App\Http\Controllers\Teachers\TeacherController::class,'teachers_search'])->name('teachers_search');
    Route::get('teacher_resit/{id}',[\App\Http\Controllers\Teachers\TeacherController::class,'teacher_resit'])->name('teacher_resit');
    Route::post('archieve_surveys',[\App\Http\Controllers\Surveys\SurveyController::class,'archieve_surveys'])->name('archieve_surveys');
    Route::get('archeive',[\App\Http\Controllers\Surveys\SurveyController::class,'archeive'])->name('archeive');
    Route::get('restore/{id}',[\App\Http\Controllers\Surveys\SurveyController::class,'restore'])->name('restore');
    Route::get('surveys_export',[\App\Http\Controllers\Surveys\SurveyController::class,'surveys_export'])->name('surveys_export');
    Route::get('survey_export/{type}',[\App\Http\Controllers\Surveys\SurveyController::class,'survey_export'])->name('survey_export');
    Route::get('section_export',[\App\Http\Controllers\Sections\SectionController::class,'export'])->name('section_export');
    Route::post('subjects_export',[\App\Http\Controllers\Subjects\SubjectController::class,'export'])->name('subjects_export');
    Route::get('survey_archeive_details/{id}',[\App\Http\Controllers\Surveys\SurveyController::class,'survey_archeive_details'])->name('survey_archeive_details');
    Route::post('final_delete_survey/{id}',[\App\Http\Controllers\Surveys\SurveyController::class,'final_delete_survey'])->name('final_delete_survey');
    Route::get('archeive_subject_survey/{subject_id}/{survey_id}',[\App\Http\Controllers\Surveys\SurveyController::class,'archeive_subject_survey'])->name('archeive_subject_survey');
    Route::get('archeive_teacher_survey/{teacher_id}/{survey_id}',[\App\Http\Controllers\Surveys\SurveyController::class,'archeive_teacher_survey'])->name('archeive_teacher_survey');
    Route::post('add_answer/{id}',[\App\Http\Controllers\Questions\QuestionController::class,'add_answer'])->name('add_answer');
    Route::get('surveys_visitor_index',[\App\Http\Controllers\Visitors\VisitorController::class,'surveys_visitor_index'])->name('surveys_visitor_index');
    Route::get('show_visitors_survey/{id}',[\App\Http\Controllers\Visitors\VisitorController::class,'show_visitors_survey'])->name('show_visitors_survey');
    Route::get('visitor_answer_final/{visitor_id}/{survey_id}',[\App\Http\Controllers\Visitors\VisitorController::class,'visitor_answer_final'])->name('visitor_answer_final');
});




############################students #############################


Route::get('student/login',function (){
    return view('admin.students.login');
})->name('student_login');

Route::post('student_post_login',[\App\Http\Controllers\Students\StudentDashboardController::class,'login'])->name('student_post_login');


Route::group(['prefix'=>'students','middleware'=>'auth:students'],function (){
    Route::get('/',[\App\Http\Controllers\Students\StudentDashboardController::class,'index'])->name('students_home');
    Route::get('/student_survey/{id}/{reference_number}/{type}',[\App\Http\Controllers\Students\StudentDashboardController::class,'student_survey'])->name('student_survey');
    Route::get('/student_logout',[\App\Http\Controllers\Students\StudentDashboardController::class,'logout'])->name('student_logout');
    Route::post('/student_answer/{survey_id}/{reference_number}/{type}',[\App\Http\Controllers\Students\StudentDashboardController::class,'student_answer'])->name('student_answer');
    Route::get('student_mode',[\App\Http\Controllers\Controller::class,'student_mode'])->name('student_mode');

});


####################################teachers########################


Route::get('teacher/login',function (){
    return view('admin.teachers.login');
})->name('teacher_login');

Route::post('teacher_post_login',[\App\Http\Controllers\Teachers\TeacherDashboardController::class,'login'])->name('teacher_post_login');


Route::group(['prefix'=>'teachers','middleware'=>'auth:teachers'],function (){

    Route::get('/',[\App\Http\Controllers\Teachers\TeacherDashboardController::class,'index'])->name('teachers_home');
    Route::get('/teacher_logout',[\App\Http\Controllers\Teachers\TeacherDashboardController::class,'logout'])->name('teacher_logout');
    Route::post('/update_teacher_info',[\App\Http\Controllers\Teachers\TeacherDashboardController::class,'update_teacher_info'])->name('update_teacher_info');
    Route::post('/teacher_survey_answer/{id}',[\App\Http\Controllers\Teachers\TeacherDashboardController::class,'teacher_survey_answer'])->name('teacher_survey_answer');
    Route::get('students_subject_survey/{id}',[\App\Http\Controllers\Teachers\TeacherDashboardController::class,'students_subject_survey'])->name('students_subject_survey');
    Route::get('teacher_survey/{id}',[\App\Http\Controllers\Teachers\TeacherDashboardController::class,'teacher_survey'])->name('teacher_survey');
    Route::get('teacher_mode',[\App\Http\Controllers\Controller::class,'teacher_mode'])->name('teacher_mode');

});



####################################visitors ####################

Route::get('visitor_index',[\App\Http\Controllers\Visitors\VisitorController::class,'index'])->name('visitor_index');
Route::get('visitor_survey/{id}',[\App\Http\Controllers\Visitors\VisitorController::class,'visitor_survey'])->name('visitor_survey');
Route::post('visitor_answer/{id}',[\App\Http\Controllers\Visitors\VisitorController::class,'visitor_answer'])->name('visitor_answer');
