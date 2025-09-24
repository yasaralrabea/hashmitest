<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\StudentsTasksController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\RecitationController;
use App\Http\Controllers\FinController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\lightingController;
use App\Http\Controllers\FileController;



Route::get('/dashboard', function () {
    return view('dashboard'); 
})->middleware(['auth'])->name('dashboard');



Route::middleware('auth')->group(function () {

    Route::get('/', function () {return view('home'); })->name('home'); 
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
   
Route::get('/mytasks', [StudentsTasksController::class, 's_index'])->name('s_index');
Route::get('/mytasks/{id}', [StudentsTasksController::class, 'my_task'])->name('my_task');
Route::post('/mytasks/store', [StudentsTasksController::class, 'task_store'])->name('task_store');
Route::get('/my/absences', [AbsenceController::class, 'my_absences'])->name('my.absences');
Route::get('/my/profile', [ProfileController::class, 'my_profile'])->name('my.profile');
Route::get('/my/calendar', [TasksController::class, 'my_calendar'])->name('my.calendar');
Route::get('/my/plan', [PlansController::class, 'my_plan'])->name('my.plan');

Route::get('/messages', [MessageController::class, 'index'])->name('message.index');
Route::get('/messages/fetch', [MessageController::class, 'fetch'])->name('message.fetch');
Route::post('/messages', [MessageController::class, 'store'])->name('message.store');
Route::get('/messages/{id}/edit', [MessageController::class, 'edit'])->name('message.edit');
Route::put('/messages/{id}', [MessageController::class, 'update'])->name('message.update');
Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('message.destroy');

Route::get('/lighting_s', [lightingController::class, 'index_to_student'])->name('lighting_s.index');

});

require __DIR__.'/auth.php';




Route::middleware('CheckRole')->group(function () {

     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/control_page', function () {return view('control_page'); })->name('control_page'); 
Route::get('/plans', [PlansController::class, 'index'])->name('plans.index');
Route::get('/student-recitations/{student}', [PlanController::class, 'getByStudent']);

Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('/absences', [AbsenceController::class, 'index'])->name('absences.index');
Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
Route::get('/teachers/{id}', [TeacherController::class, 'show'])->name('teachers.show');
Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('teachers.update');
Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
Route::post('/teachers/{id}/promote', [TeacherController::class, 'promote'])->name('teachers.promote');
Route::post('/teachers/{id}/demote', [TeacherController::class, 'demote'])->name('teachers.demote');
Route::post('/students', [StudentsController::class, 'store'])->name('students.store');
Route::get('/students/{id}', [StudentsController::class, 'show'])->name('students.show');
Route::put('/students/{id}', [StudentsController::class, 'update'])->name('students.update');
Route::delete('/students/{id}', [StudentsController::class, 'destroy'])->name('students.destroy');
Route::post('/students/{id}/promote', [StudentsController::class, 'promote'])->name('students.promote');
Route::get('/students', [StudentsController::class, 'index'])->name('students.index');

Route::get('/calendar', [TasksController::class, 'get_calendar'])->name('calendars.index');
Route::post('/calendar/store', [TasksController::class, 'store'])->name('calendar.store');
Route::put('/calendar/{id}', [TasksController::class, 'update'])->name('calendar.update');
Route::delete('/calendar/{id}', [TasksController::class, 'destroy'])->name('calendar.destroy');
Route::put('/calendar/{id}/done', [TasksController::class, 'done'])->name('calendar.done');
Route::get('/tasks', [StudentsTasksController::class, 'index'])->name('tasks.index');
Route::post('/task/store', [StudentsTasksController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{id}/visit', [StudentsTasksController::class, 'task'])->name('visit.task');
Route::get('/tasks/{id}/close', [StudentsTasksController::class, 'close'])->name('tasks.close');
Route::get('/tasks/{id}/open', [StudentsTasksController::class, 'open'])->name('tasks.open');
Route::put('/tasks/{id}', [StudentsTasksController::class, 'update'])->name('tasks.update');
Route::post('/task/{id}', [StudentsTasksController::class, 'destroy'])->name('task.destroy');
Route::get('/submissions/{id}', [StudentsTasksController::class, 'submission_show'])->name('submission.show');
Route::put('/submissions/{id}/rate', [StudentsTasksController::class, 'rate'])->name('submissions.rate');
Route::get('/absences', [AbsenceController::class, 'absences'])->name('absences.index');
Route::post('/absences/store', [AbsenceController::class, 'store'])->name('absences.store');
Route::delete('/absence/{id}', [AbsenceController::class, 'destroy'])->name('absences.destroy');
Route::put('/absence/{id}', [AbsenceController::class, 'update'])->name('absences.update');
Route::get('/recitations', [RecitationController::class, 'index'])->name('recitations.index');
Route::post('/recitations/store', [RecitationController::class, 'store'])->name('recitations.store');
Route::post('/recitations/{id}/done', [RecitationController::class, 'done'])->name('recitations.done');

Route::put('/recitations/{id}', [RecitationController::class, 'update'])->name('recitations.update');
Route::delete('/recitations/{id}', [RecitationController::class, 'destroy'])->name('recitations.destroy');
Route::get('/student-recitations/{student}', [RecitationController::class, 'studentRecitations']);
Route::get('/fin', [FinController::class, 'index'])->name('fins.index');
Route::post('/fins', [FinController::class, 'store'])->name('financial.store');
Route::put('/fins/{fin}', [FinController::class, 'update'])->name('financial.update');
Route::delete('/fins/{fin}', [FinController::class, 'destroy'])->name('financial.destroy');

Route::get('/lighting', [LightingController::class, 'index'])->name('lighting.index');
Route::post('/lighting', [LightingController::class, 'store'])->name('lighting.store');
Route::put('/lighting/{id}', [LightingController::class, 'update'])->name('lighting.update');
Route::delete('/lighting/{id}', [LightingController::class, 'destroy'])->name('lighting.destroy');

Route::put('/budget/update', [FinController::class, 'update_budget'])->name('budget.update');


Route::get('/files', [FileController::class, 'index'])->name('files.index');
Route::post('/files', [FileController::class, 'store'])->name('files.store');
Route::put('/files/{id}', [FileController::class, 'update'])->name('files.update');
Route::delete('/files/{id}', [FileController::class, 'destroy'])->name('files.destroy');

});

