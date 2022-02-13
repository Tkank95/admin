<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\apps\ApplicationController;
use App\Http\Controllers\apps\LiveRuleController;
use App\Http\Controllers\apps\PolicyController;
use App\Http\Controllers\apps\PromoteController;
use App\Http\Controllers\data\ApplyJobController;
use App\Http\Controllers\data\DataLiveController;
use App\Http\Controllers\members\BankController;
use App\Http\Controllers\members\CheckValidation;
use App\Http\Controllers\members\FeedBackController;
use App\Http\Controllers\members\LogController;
use App\Http\Controllers\members\LoginController;
use App\Http\Controllers\members\PermissionController;
use App\Http\Controllers\members\RoleController;
use App\Http\Controllers\members\TaskController;
use App\Http\Controllers\members\TaskTagController;
use App\Http\Controllers\members\UserController;
use App\Http\Controllers\money\ExpenseCategoryController;
use App\Http\Controllers\money\ExpenseController;
use App\Http\Controllers\money\IncomeCategoryController;
use App\Http\Controllers\money\IncomeController;
use App\Http\Controllers\money\ReportMoneyController;
use App\Http\Controllers\news\ConfigSettingController;
use App\Http\Controllers\news\NewTutorialController;
use App\Http\Controllers\news\SlideController;
use Illuminate\Support\Facades\Route;


Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'postLogin'])->middleware("throttle:100,5");//Giới hạn đăng nhập sai 3 lần trong 5 phút
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Google Sign In
Route::get('/auth/{provider}', [LoginController::class, 'getGoogleSignInUrl']);
Route::get('/auth/{provide}/callback', [LoginController::class, 'loginCallback']);


Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin');

    // Application
    Route::prefix('app')->group(function () {
        Route::get('add', [ApplicationController::class, 'create'])->middleware('can:application-add');
        Route::post('add', [ApplicationController::class, 'store'])->middleware('can:application-add');
        Route::get('list', [ApplicationController::class, 'index'])->middleware('can:application-list');
        Route::get('edit/{id}', [ApplicationController::class, 'show'])->middleware('can:application-edit');
        Route::post('edit/{id}', [ApplicationController::class, 'update'])->middleware('can:application-edit');
        Route::DELETE('destroy/{id}', [ApplicationController::class, 'destroy'])->middleware('can:application-delete');
        Route::post('active/{id}', [ApplicationController::class, 'active']);
        Route::post('deactive/{id}', [ApplicationController::class, 'deactive']);
        Route::DELETE('delete', [ApplicationController::class, 'deleteMultiple']);

        // Promote
        Route::prefix('promote')->group(function () {
            Route::get('add', [PromoteController::class, 'create']);
            Route::post('add', [PromoteController::class, 'store']);
            Route::get('list', [PromoteController::class, 'index']);
            Route::get('edit/{id}', [PromoteController::class, 'show']);
            Route::post('edit/{id}', [PromoteController::class, 'update']);
            Route::DELETE('destroy/{id}', [PromoteController::class, 'destroy']);
            Route::post('active/{id}', [PromoteController::class, 'active']);
            Route::post('deactive/{id}', [PromoteController::class, 'deactive']);
            Route::DELETE('delete', [PromoteController::class, 'deleteMultiple']);
        });

        // Policy
        Route::prefix('policy')->group(function () {
            Route::get('add', [PolicyController::class, 'create']);
            Route::post('add', [PolicyController::class, 'store']);
            Route::get('list', [PolicyController::class, 'index']);
            Route::get('edit/{id}', [PolicyController::class, 'show']);
            Route::post('edit/{id}', [PolicyController::class, 'update']);
            Route::DELETE('destroy/{id}', [PolicyController::class, 'destroy']);
            Route::DELETE('delete', [PolicyController::class, 'deleteMultiple']);

            Route::post('active/{id}', [PolicyController::class, 'active']);
            Route::post('deactive/{id}', [PolicyController::class, 'deactive']);

            Route::get('idol-{id}-{cate}', [PolicyController::class, 'idol']);
            Route::get('agency-{id}-{cate}', [PolicyController::class, 'agency']);
        });

        // Live rule
        Route::prefix('rule')->group(function () {
            Route::get('add', [LiveRuleController::class, 'create']);
            Route::post('add', [LiveRuleController::class, 'store']);
            Route::get('list', [LiveRuleController::class, 'index']);
            Route::get('edit/{id}', [LiveRuleController::class, 'show']);
            Route::post('edit/{id}', [LiveRuleController::class, 'update']);
            Route::DELETE('destroy/{id}', [LiveRuleController::class, 'destroy']);
            Route::DELETE('delete', [LiveRuleController::class, 'deleteMultiple']);

            Route::post('active/{id}', [LiveRuleController::class, 'active']);
            Route::post('deactive/{id}', [LiveRuleController::class, 'deactive']);

            Route::get('{id}-{cate}-{app}', [LiveRuleController::class, 'rule']);
        });
    });


    // New Tutorial
    Route::prefix('news')->group(function () {
        Route::get('add', [NewTutorialController::class, 'create']);
        Route::post('add', [NewTutorialController::class, 'store']);
        Route::get('list', [NewTutorialController::class, 'index']);
        Route::get('edit/{id}', [NewTutorialController::class, 'show']);
        Route::post('edit/{id}', [NewTutorialController::class, 'update']);
        Route::DELETE('destroy/{id}', [NewTutorialController::class, 'destroy']);
        Route::DELETE('delete', [NewTutorialController::class, 'deleteMultiple']);

        // Slide
        Route::prefix('slide')->group(function () {
            Route::get('add', [SlideController::class, 'create']);
            Route::post('add', [SlideController::class, 'store']);
            Route::get('list', [SlideController::class, 'index']);
            Route::get('edit/{id}', [SlideController::class, 'show']);
            Route::post('edit/{id}', [SlideController::class, 'update']);
            Route::DELETE('destroy/{id}', [SlideController::class, 'destroy']);
            Route::DELETE('delete', [SlideController::class, 'deleteMultiple']);

        });

        // Config Setting
        Route::prefix('config')->group(function () {
            Route::post('add', [ConfigSettingController::class, 'store']);
            Route::get('list', [ConfigSettingController::class, 'index']);
            Route::get('edit/{id}', [ConfigSettingController::class, 'show']);
            Route::put('edit/{id}', [ConfigSettingController::class, 'update']);
            Route::delete('destroy/{id}', [ConfigSettingController::class, 'destroy']);
            Route::DELETE('delete', [ConfigSettingController::class, 'deleteMultiple']);
        });
    });


    // User
    Route::prefix('user')->group(function () {
        Route::get('add', [UserController::class, 'create']);
        Route::post('add', [UserController::class, 'store']);
        Route::get('list', [UserController::class, 'index']);
        Route::get('edit/{id}', [UserController::class, 'show']);
        Route::post('edit/{id}', [UserController::class, 'update']);
        Route::DELETE('destroy/{id}', [UserController::class, 'destroy']);
        Route::get('show-ban/{id}', [UserController::class, 'showBan']);
        Route::post('ban/{id}', [UserController::class, 'banned']);
        Route::post('active/{id}', [UserController::class, 'active']);
        Route::post('deactive/{id}', [UserController::class, 'deactive']);
        Route::DELETE('delete', [UserController::class, 'deleteMultiple']);

        // Bank
        Route::prefix('bank')->group(function () {
            Route::get('add', [BankController::class, 'create']);
            Route::post('add', [BankController::class, 'store']);
            Route::get('list', [BankController::class, 'index']);
            Route::get('edit/{id}', [BankController::class, 'show']);
            Route::post('edit/{id}', [BankController::class, 'update']);
            Route::DELETE('destroy/{id}', [BankController::class, 'destroy']);
            Route::get('get-bank', [BankController::class, 'getBank']);
            Route::DELETE('delete', [BankController::class, 'deleteMultiple']);

        });

        // Role
        Route::prefix('role')->group(function () {
            Route::get('add', [RoleController::class, 'create']);
            Route::post('add', [RoleController::class, 'store']);
            Route::get('list', [RoleController::class, 'index']);
            Route::get('edit/{id}', [RoleController::class, 'show']);
            Route::post('edit/{id}', [RoleController::class, 'update']);
            Route::DELETE('destroy/{id}', [RoleController::class, 'destroy']);
            Route::DELETE('delete', [RoleController::class, 'deleteMultiple']);
        });

        // Permission
        Route::prefix('permission')->group(function () {
            Route::get('add', [PermissionController::class, 'create']);
            Route::post('add', [PermissionController::class, 'store']);
        });

        // Task
        Route::prefix('task')->group(function () {
            Route::get('add', [TaskController::class, 'create']);
            Route::post('add', [TaskController::class, 'store']);
            Route::get('list', [TaskController::class, 'index']);
            Route::get('edit/{id}', [TaskController::class, 'show']);
            Route::put('edit/{id}', [TaskController::class, 'update']);
            Route::DELETE('destroy/{id}', [TaskController::class, 'destroy']);
            Route::DELETE('delete', [TaskController::class, 'deleteMultiple']);

            Route::prefix('tag')->group(function () {
                Route::post('add', [TaskTagController::class, 'store']);
                Route::get('list', [TaskTagController::class, 'index']);
                Route::get('edit/{id}', [TaskTagController::class, 'show']);
                Route::put('edit/{id}', [TaskTagController::class, 'update']);
                Route::DELETE('destroy/{id}', [TaskTagController::class, 'destroy']);
                Route::DELETE('delete', [TaskTagController::class, 'deleteMultiple']);
            });

            Route::get('calendar', [TaskController::class, 'calendar']);
            Route::post('attachment', [TaskController::class, 'attachment']);
            Route::post('detachment', [TaskController::class, 'detachment']);

        });

        // Log
        Route::prefix('log')->group(function () {
            Route::get('log-action', [LogController::class, 'indexAction']);
            Route::get('log-action/detail/{id}', [LogController::class, 'detailAction']);
            Route::DELETE('delete-multiple-action', [LogController::class, 'deleteMultipleAction']);
        });

        // Feedback
        Route::prefix('feedback')->group(function () {
            Route::get('add', [FeedBackController::class, 'create']);
            Route::post('add', [FeedBackController::class, 'store']);
            Route::get('list', [FeedBackController::class, 'index']);
            Route::get('edit/{id}', [FeedBackController::class, 'show']);
            Route::post('edit/{id}', [FeedBackController::class, 'update']);
            Route::DELETE('destroy/{id}', [FeedBackController::class, 'destroy']);
        });

        // Check validation
        Route::post('check/email', [CheckValidation::class, 'checkEmail']);
        Route::post('check/username', [CheckValidation::class, 'checkUsername']);
    });

    // Data
    Route::prefix('data')->group(function () {
        Route::prefix('live')->group(function () {
            Route::get('add', [DataLiveController::class, 'create']);
            Route::post('add', [DataLiveController::class, 'store']);
            Route::get('list', [DataLiveController::class, 'index']);
            Route::post('edit/{id}', [DataLiveController::class, 'update']);
            Route::DELETE('destroy/{id}', [DataLiveController::class, 'destroy']);
            Route::DELETE('delete', [DataLiveController::class, 'deleteMultiple']);
        });

        // Apply Job
        Route::prefix('job')->group(function () {
            Route::get('add', [ApplyJobController::class, 'create']);
            Route::post('add', [ApplyJobController::class, 'store']);
            Route::get('list', [ApplyJobController::class, 'index']);
            Route::get('edit/{id}', [ApplyJobController::class, 'show']);
            Route::post('edit/{id}', [ApplyJobController::class, 'update']);
            Route::DELETE('destroy/{id}', [ApplyJobController::class, 'destroy']);

            #Lấy info user theo email
            Route::get('get/user/{id}', [ApplyJobController::class, 'getUser']);
        });
    });

    // Giao dịch
    Route::prefix('transaction')->group(function () {
        // Expense
        Route::prefix('expense')->group(function () {
            Route::get('add', [ExpenseController::class, 'create']);
            Route::post('add', [ExpenseController::class, 'store']);
            Route::get('list', [ExpenseController::class, 'index']);
            Route::get('edit/{id}', [ExpenseController::class, 'show']);
            Route::put('edit/{id}', [ExpenseController::class, 'update']);
            Route::DELETE('destroy/{id}', [ExpenseController::class, 'destroy']);
            Route::DELETE('delete', [ExpenseController::class, 'deleteMultiple']);

            Route::prefix('category')->group(function () {
                Route::post('add', [ExpenseCategoryController::class, 'store']);
                Route::get('list', [ExpenseCategoryController::class, 'index']);
                Route::get('edit/{id}', [ExpenseCategoryController::class, 'show']);
                Route::put('edit/{id}', [ExpenseCategoryController::class, 'update']);
                Route::DELETE('destroy/{id}', [ExpenseCategoryController::class, 'destroy']);
                Route::DELETE('delete', [ExpenseCategoryController::class, 'deleteMultiple']);
            });
        });

        // Income
        Route::prefix('income')->group(function () {
            Route::get('add', [IncomeController::class, 'create']);
            Route::post('add', [IncomeController::class, 'store']);
            Route::get('list', [IncomeController::class, 'index']);
            Route::get('edit/{id}', [IncomeController::class, 'show']);
            Route::put('edit/{id}', [IncomeController::class, 'update']);
            Route::DELETE('destroy/{id}', [IncomeController::class, 'destroy']);
            Route::DELETE('delete', [IncomeController::class, 'deleteMultiple']);

            Route::prefix('category')->group(function () {
                Route::post('add', [IncomeCategoryController::class, 'store']);
                Route::get('list', [IncomeCategoryController::class, 'index']);
                Route::get('edit/{id}', [IncomeCategoryController::class, 'show']);
                Route::put('edit/{id}', [IncomeCategoryController::class, 'update']);
                Route::DELETE('destroy/{id}', [IncomeCategoryController::class, 'destroy']);
                Route::DELETE('delete', [IncomeCategoryController::class, 'deleteMultiple']);
            });
        });

        // Report
        Route::get('report', [ReportMoneyController::class, 'index']);
    });

    // Lấy thông tin khởi tạo theo điều kiện
    Route::prefix('load')->group(function () {
        #Lấy danh sách App theo Category
        Route::get('category/{id}', [AdminController::class, 'loadCate']);

        #Lấy info user theo email
        Route::get('user/{id}', [AdminController::class, 'loadUser']);

        #Get info user search username select2
        Route::get('search/member', [AdminController::class, 'selectSearchUserName']);

        #Get info user id select2
        Route::get('search/get-member/{id}', [AdminController::class, 'getSelectUser']);
    });
});

