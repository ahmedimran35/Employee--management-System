<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceRecordController;
use App\Http\Controllers\InvoiceController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('admin');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/employeeSalary', [EmployeeController:: class, 'index'])->name('pages.employeeIndex')->middleware('admin');
    Route::get('/employeeDetails', [EmployeeController:: class, 'input'])->name('pages.employeeDetails');
    Route::get('/salaryInput', [EmployeeController:: class, 'salary_input'])->name('pages.salaryInput')->middleware('admin');
    Route::get('/showEmployeeDetails', [EmployeeController:: class, 'show'])->name('pages.showEmployeeDetails')->middleware('admin');
    Route::get('/get-salary/{employee_id}', [EmployeeController::class, 'getMonthlySalary'])->name('get-salary');
    Route::get('/get-info/{employee_id}', [EmployeeController::class, 'getEmployeeInfo'])->name('get-info');
    Route::post('/employeeDetails', [EmployeeController:: class, 'store'])->name('employee.store');  
    Route:: post('/salaryInput', [EmployeeController:: class, 'salary_store'])->name('salary.store');
    
    Route:: get('/editEmployeeData' , [EmployeeController:: class,'edit'])->name('pages.editEmployeeData')->middleware('admin');
    Route:: post('/update-employee' , [EmployeeController:: class,'updateEmployee'])->name('employee.update')->middleware('admin');
    
    Route:: get('/attendanceManagement' , [AttendanceRecordController:: class,'showAttendanceForm'])->name('pages.attendanceManagement');
    Route::post('/save-attendance', [AttendanceRecordController::class, 'store'])->name('attendance.store');
   
    
    Route:: get('/attendanceApproval' , [AttendanceRecordController:: class,'pending_approvals'])->name('pages.pendingApprovals');
    
    Route::post('/attendance/approve/{id}', [AttendanceRecordController:: class, 'approve'])->name('attendance.approve');
    Route::post('/attendance/reject/{id}', [AttendanceRecordController:: class, 'reject'])->name('attendance.reject');

Route:: get('/invoice/{emp_id}', [EmployeeController::class, 'invoice'])->name('pages.invoice');


});

require __DIR__.'/auth.php';
