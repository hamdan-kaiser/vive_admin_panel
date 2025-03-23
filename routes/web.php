<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrative\AuthController as AuthController;
use App\Http\Controllers\Administrative\DashboardController as DashboardController;
use App\Http\Controllers\Administrative\RoleController as RoleController;
use App\Http\Controllers\Administrative\PermissionController as PermissionController;
use App\Http\Controllers\Administrative\UserController as UserController;
use App\Http\Controllers\Administrative\NewsController as NewsController;
use App\Http\Controllers\Administrative\JobStatusController as JobStatusController;
use App\Http\Controllers\Administrative\SubjectController as SubjectController;
use App\Http\Controllers\Administrative\LocationController as LocationController;
use App\Http\Controllers\Administrative\UniversityController as UniversityController;
use App\Http\Controllers\Administrative\ApplicationController as ApplicationController;
use App\Http\Controllers\Administrative\ArticleController as ArticleController;
use App\Http\Controllers\Administrative\EducationController as EducationController;
use App\Http\Controllers\Administrative\OtherDcoumentController as OtherDcoumentController;
use App\Http\Controllers\Administrative\ProfessionalController as ProfessionalController;
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

Route::get('convert', [AuthController::class, 'convert'])->name('convert');
Route::group(['middleware' => ['guest','XssSanitizer']], function () {
    Route::get('/', [AuthController::class, 'index'])->name('index');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
    Route::get('/login', [AuthController::class, 'index'])->name('login');

    Route::get('/forget-password', [AuthController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('/forget-password', [AuthController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::get('/reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});
Route::prefix('administrative')->middleware(['auth','XssSanitizer'])->name('administrative.')->group(function () {
        Route::prefix('otherdcoument')->group(function () {
             Route::get('/', [OtherDcoumentController::class, 'index'])->name('otherdcoument');
             Route::get('otherdcoument-data', [OtherDcoumentController::class, 'data'])->name('otherdcoument.data');
             Route::get('create', [OtherDcoumentController::class, 'create'])->name('otherdcoument.create');
             Route::get('edit/{id}', [OtherDcoumentController::class, 'edit'])->name('otherdcoument.edit');
             Route::put('update/{id}', [OtherDcoumentController::class, 'update'])->name('otherdcoument.update');
             Route::post('create', [OtherDcoumentController::class, 'store'])->name('otherdcoument.store');
             Route::delete('delete/{id}', [OtherDcoumentController::class, 'destroy'])->name('otherdcoument.destroy');
        });
        Route::prefix('professional')->group(function () {
             Route::get('/', [ProfessionalController::class, 'index'])->name('professional');
             Route::get('professional-data', [ProfessionalController::class, 'data'])->name('professional.data');
             Route::get('create', [ProfessionalController::class, 'create'])->name('professional.create');
             Route::get('edit/{id}', [ProfessionalController::class, 'edit'])->name('professional.edit');
             Route::put('update/{id}', [ProfessionalController::class, 'update'])->name('professional.update');
             Route::post('create', [ProfessionalController::class, 'store'])->name('professional.store');
             Route::delete('delete/{id}', [ProfessionalController::class, 'destroy'])->name('professional.destroy');
        });
        Route::prefix('education')->group(function () {
             Route::get('/', [EducationController::class, 'index'])->name('education');
             Route::get('education-data', [EducationController::class, 'data'])->name('education.data');
             Route::get('create', [EducationController::class, 'create'])->name('education.create');
             Route::get('edit/{id}', [EducationController::class, 'edit'])->name('education.edit');
             Route::put('update/{id}', [EducationController::class, 'update'])->name('education.update');
             Route::post('create', [EducationController::class, 'store'])->name('education.store');
             Route::delete('delete/{id}', [EducationController::class, 'destroy'])->name('education.destroy');
        });
        Route::prefix('article')->group(function () {
             Route::get('/', [ArticleController::class, 'index'])->name('article');
             Route::get('article-data', [ArticleController::class, 'data'])->name('article.data');
             Route::get('create', [ArticleController::class, 'create'])->name('article.create');
             Route::get('edit/{id}', [ArticleController::class, 'edit'])->name('article.edit');
             Route::put('update/{id}', [ArticleController::class, 'update'])->name('article.update');
             Route::post('create', [ArticleController::class, 'store'])->name('article.store');
             Route::delete('delete/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');
        });
        Route::prefix('application')->group(function () {
             Route::get('/', [ApplicationController::class, 'index'])->name('application');
             Route::get('application-data', [ApplicationController::class, 'data'])->name('application.data');
             Route::get('create', [ApplicationController::class, 'create'])->name('application.create');
             Route::get('edit/{id}', [ApplicationController::class, 'edit'])->name('application.edit');
             Route::put('update/{id}', [ApplicationController::class, 'update'])->name('application.update');
             Route::post('create', [ApplicationController::class, 'store'])->name('application.store');
             Route::delete('delete/{id}', [ApplicationController::class, 'destroy'])->name('application.destroy');
            Route::get('details/{id}', [ApplicationController::class, 'details'])->name('application.details');
            Route::get('status/update', [ApplicationController::class, 'statusUpdate'])->name('application.update.status');
        });
        Route::prefix('university')->group(function () {
             Route::get('/', [UniversityController::class, 'index'])->name('university');
             Route::get('university-data', [UniversityController::class, 'data'])->name('university.data');
             Route::get('create', [UniversityController::class, 'create'])->name('university.create');
             Route::get('edit/{id}', [UniversityController::class, 'edit'])->name('university.edit');
             Route::put('update/{id}', [UniversityController::class, 'update'])->name('university.update');
             Route::post('create', [UniversityController::class, 'store'])->name('university.store');
            Route::post('import', [UniversityController::class, 'import'])->name('university.import');
             Route::delete('delete/{id}', [UniversityController::class, 'destroy'])->name('university.destroy');
        });
        Route::prefix('location')->group(function () {
             Route::get('/', [LocationController::class, 'index'])->name('location');
             Route::get('location-data', [LocationController::class, 'data'])->name('location.data');
             Route::get('create', [LocationController::class, 'create'])->name('location.create');
             Route::get('edit/{id}', [LocationController::class, 'edit'])->name('location.edit');
             Route::put('update/{id}', [LocationController::class, 'update'])->name('location.update');
             Route::post('create', [LocationController::class, 'store'])->name('location.store');
            Route::post('import', [LocationController::class, 'import'])->name('location.import');
             Route::delete('delete/{id}', [LocationController::class, 'destroy'])->name('location.destroy');
        });
        Route::prefix('subject')->group(function () {
             Route::get('/', [SubjectController::class, 'index'])->name('subject');
             Route::get('subject-data', [SubjectController::class, 'data'])->name('subject.data');
             Route::get('create', [SubjectController::class, 'create'])->name('subject.create');
             Route::get('edit/{id}', [SubjectController::class, 'edit'])->name('subject.edit');
             Route::put('update/{id}', [SubjectController::class, 'update'])->name('subject.update');
             Route::post('create', [SubjectController::class, 'store'])->name('subject.store');
            Route::post('import', [SubjectController::class, 'import'])->name('subject.import');
             Route::delete('delete/{id}', [SubjectController::class, 'destroy'])->name('subject.destroy');
        });
        Route::prefix('jobstatus')->group(function () {
             Route::get('/', [JobStatusController::class, 'index'])->name('jobstatus');
             Route::get('jobstatus-data', [JobStatusController::class, 'data'])->name('jobstatus.data');
             Route::get('create', [JobStatusController::class, 'create'])->name('jobstatus.create');
             Route::get('edit/{id}', [JobStatusController::class, 'edit'])->name('jobstatus.edit');
             Route::put('update/{id}', [JobStatusController::class, 'update'])->name('jobstatus.update');
             Route::post('create', [JobStatusController::class, 'store'])->name('jobstatus.store');
            Route::post('import', [JobStatusController::class, 'import'])->name('jobstatus.import');
             Route::delete('delete/{id}', [JobStatusController::class, 'destroy'])->name('jobstatus.destroy');
        });
        Route::prefix('news')->group(function () {
             Route::get('/', [NewsController::class, 'index'])->name('news');
             Route::get('news-data', [NewsController::class, 'data'])->name('news.data');
             Route::get('create', [NewsController::class, 'create'])->name('news.create');
             Route::get('edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
             Route::put('update/{id}', [NewsController::class, 'update'])->name('news.update');
             Route::post('create', [NewsController::class, 'store'])->name('news.store');
             Route::delete('delete/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
        });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
    Route::prefix('user')->group(function () {
         Route::group(['middleware' => ['can:User Add']], function () {
        //Route::get('create', [UserController::class,'create'])->name('user.create');
        //Route::post('create', [UserController::class,'store'])->name('user.store');
         });
          Route::group(['middleware' => ['can:User Update']], function () {
        //Route::get('edit/{id}', [UserController::class,'edit'])->name('user.edit');
        //Route::put('update/{id}', [UserController::class,'update'])->name('user.update');
          });
        Route::group(['middleware' => ['can:User Delete']], function () {
            //Route::delete('delete/{id}', [UserController::class,'destroy'])->name('user.destroy');
        });
          Route::group(['middleware' => ['can:User View']], function () {
        //Route::get('/', [UserController::class,'index'])->name('user');
        //Route::get('user-data', [UserController::class,'data'])->name('user.data');
        });
        //Route::get('template/{type}/{id?}', [UserController::class,'template'])->name('user.template');
    });
    Route::prefix('settings')->group(function () {
        Route::get('change-password', 'UserController@changePassword')->name('change.password');
        Route::post('change-password-post', 'UserController@changePasswordPost')->name('change.password.post');
        Route::prefix('role')->group(function () {

            Route::group(['middleware' => ['can:Role Add']], function () {
                Route::get('create', [RoleController::class, 'create'])->name('role.create');
                Route::post('create', [RoleController::class, 'store'])->name('role.store');
            });
            Route::group(['middleware' => ['can:Role Update']], function () {
                Route::get('edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
                Route::put('update/{id}', [RoleController::class, 'update'])->name('role.update');
            });
            Route::group(['middleware' => ['can:Role Delete']], function () {
                Route::delete('delete/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
            });

            Route::group(['middleware' => ['can:Role View']], function () {
                Route::get('/', [RoleController::class, 'index'])->name('role');
                Route::get('role-data', [RoleController::class, 'data'])->name('role.data');
            });
        });
        Route::prefix('permission')->group(function () {

            Route::group(['middleware' => ['can:Permission Add']], function () {
                Route::get('create', [PermissionController::class, 'create'])->name('permission.create');
                Route::post('create', [PermissionController::class, 'store'])->name('permission.store');
            });
            Route::group(['middleware' => ['can:Permission Update']], function () {
                Route::get('edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
                Route::put('update/{id}', [PermissionController::class, 'update'])->name('permission.update');
            });
            Route::group(['middleware' => ['can:Permission Delete']], function () {
                Route::delete('delete/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');
            });

            Route::group(['middleware' => ['can:Permission View']], function () {
                Route::get('/', [PermissionController::class, 'index'])->name('permission');
                Route::get('permission-data', [PermissionController::class, 'data'])->name('permission.data');
            });
        });
    });
});
