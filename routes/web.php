<?php

use App\Http\Controllers\EmployeeEvaluationController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ProfessionalDevelopmentController;
use App\Http\Controllers\ProfessionalRatingController;
use App\Http\Controllers\ProgrammingLevelItemSubCriteriaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgrammingLanguageController;
use App\Http\Controllers\ProgrammingLevelItemController;
use App\Http\Controllers\ProgrammingLevelItemCriteriaController;

Route::get('/', function () {
    return view('pages.guest.auth.login');
});
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');

Route::name('user.')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.auth.dashboard.index');
    })->name('index');
    Route::post('/register', [UserController::class, 'register'])->name('register');
    Route::post('/', [UserController::class, 'login'])->name('submit_login');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        Route::post('/{user}', [UserController::class, 'update'])->name('update');
    });
    Route::prefix('/evaluate')->group(function () {
        Route::name('evaluate.')->group(function () {
            Route::get('/{user}', [EvaluationController::class, 'show'])->name('user');
            Route::get('/', [EvaluationController::class, 'getProgrammingLanguages'])->name('programming-languages');
            Route::get('/level/{id}', [EvaluationController::class, 'getData'])->name('levelItem');
            Route::get('/test/ratings', [EvaluationController::class, 'getRatings'])->name('ratings');
        });
    });

    // ADMIN SIDE
    Route::prefix('/programming')->group(function () {
        Route::prefix('language')->name('language.')->group(function () {
            Route::get('/', [ProgrammingLanguageController::class, 'index'])->name('index');
            Route::get('/{project}', [ProgrammingLanguageController::class, 'edit'])->name('edit');
            Route::get('/{project}/edit-level', [ProgrammingLanguageController::class, 'editLevel'])->name('editLevel');
            Route::post('/', [ProgrammingLanguageController::class, 'store'])->name('store');
            Route::delete('/{project}', [ProgrammingLanguageController::class, 'destroy'])->name('destroy');
            Route::post('/{project}', [ProgrammingLanguageController::class, 'update'])->name('update');
        });
        Route::prefix('level')->name('level.')->group(function () {
            Route::get('/', [ProgrammingLevelItemController::class, 'index'])->name('index');
            Route::post('/{id}', [ProgrammingLevelItemController::class, 'storeOrUpdate'])->name('storeOrUpdate');
            Route::delete('/{id}', [ProgrammingLevelItemController::class, 'destroy'])->name('destroy');
            Route::get('/{id}', [ProgrammingLevelItemController::class, 'show'])->name('show');
        });
        Route::prefix('criteria')->name('criteria.')->group(function () {
            Route::post('/{id}', [ProgrammingLevelItemCriteriaController::class, 'storeOrUpdate'])->name('storeOrUpdate');
            Route::get('/{id}', [ProgrammingLevelItemCriteriaController::class, 'show'])->name('show');
            Route::delete('/{id}', [ProgrammingLevelItemCriteriaController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('sub-criteria')->name('sub-criteria.')->group(function () {
            Route::post('/{id}', [ProgrammingLevelItemSubCriteriaController::class, 'storeOrUpdate'])->name('storeOrUpdate');
            Route::get('/{id}', [ProgrammingLevelItemSubCriteriaController::class, 'show'])->name('show');
            Route::delete('/{id}', [ProgrammingLevelItemSubCriteriaController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('evaluation')->name('evaluation.')->group(function () {
        Route::get('/', [EmployeeEvaluationController::class, 'index'])->name('index');
        Route::post('/', [EmployeeEvaluationController::class, 'store'])->name('store');
        Route::put('/{evaluation}', [EmployeeEvaluationController::class, 'update'])->name('update');
        Route::delete('/{evaluation}', [EmployeeEvaluationController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('professional')->group(function () {
        Route::prefix('development_rating')->name('rating.')->group(function () {
            Route::get('/', [ProfessionalRatingController::class, 'index'])->name('index');
            Route::post('/', [ProfessionalRatingController::class, 'store'])->name('store');
            Route::put('/{rating}', [ProfessionalRatingController::class, 'update'])->name('update');
            Route::delete('/{rating}', [ProfessionalRatingController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('development_criteria')->name('development.')->group(function () {
            Route::get('/', [ProfessionalDevelopmentController::class, 'index'])->name('index');
            Route::post('/', [ProfessionalDevelopmentController::class, 'store'])->name('store');
            Route::put('/{development}', [ProfessionalDevelopmentController::class, 'update'])->name('update');
            Route::delete('/{development}', [ProfessionalDevelopmentController::class, 'destroy'])->name('destroy');
        });
    });
});
