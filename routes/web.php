<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('home');
    // return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// user common routes
Route::group(['prefix' => 'user', 'middleware' => ['auth', 'permission']], function () {
    // profile
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [HomeController::class, 'profile'])->name('user.profile');
        Route::post('update', [HomeController::class, 'profileUpdate'])->name('user.profile.update');
        Route::post('password/update', [HomeController::class, 'passwordUpdate'])->name('user.password.update');
        Route::post('image/update', [HomeController::class, 'imageUpdate'])->name('user.profile.image.update');
    });

    // employee
    Route::group(['prefix' => 'employee'], function () {
        Route::get('/', [UserController::class, 'index'])->name('user.employee.list');
        Route::get('/create', [UserController::class, 'create'])->name('user.employee.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.employee.store');
        Route::post('/show', [UserController::class, 'show'])->name('user.employee.show');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.employee.edit');
        Route::post('/{id}/update', [UserController::class, 'update'])->name('user.employee.update');
        Route::post('/destroy', [UserController::class, 'destroy'])->name('user.employee.destroy');
        Route::post('/block', [UserController::class, 'block'])->name('user.employee.block');
    });

    // role
    Route::group(['prefix' => 'employee/role'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('user.role.list');
        Route::post('/store', [RoleController::class, 'store'])->name('user.role.store');
        Route::post('/show', [RoleController::class, 'show'])->name('user.role.show');
        Route::post('/destroy', [RoleController::class, 'destroy'])->name('user.role.destroy');
    });

    // logs
    Route::group(['prefix' => 'logs'], function () {
        Route::get('/', [LogController::class, 'logsIndex'])->name('user.logs');
        Route::get('/mail', [LogController::class, 'logsMail'])->name('user.logs.mail');
        Route::get('/notification', [LogController::class, 'logsNotification'])->name('user.logs.notification');
        Route::post('/notification/readall', [LogController::class, 'notificationReadAll'])->name('user.logs.notification.readall');
        Route::get('/activity', [LogController::class, 'activityIndex'])->name('user.logs.activity');
    });

    // office management
    Route::group(['prefix' => 'office'], function () {
        Route::get('/', [OfficeController::class, 'index'])->name('user.office.list');
        Route::post('/store', [OfficeController::class, 'store'])->name('user.office.store');
        Route::post('/show', [OfficeController::class, 'show'])->name('user.office.show');
        Route::post('/update', [OfficeController::class, 'update'])->name('user.office.update');
        Route::post('/destroy', [OfficeController::class, 'destroy'])->name('user.office.destroy');
    });

    // notification
    Route::post('/read', [HomeController::class, 'notificationRead'])->name('user.notification.read');







    // wevouch updates

    // brand management
    Route::group(['prefix' => 'brand'], function () {
        Route::get('/', [BrandController::class, 'index'])->name('user.brand.list');
        Route::post('/store', [BrandController::class, 'store'])->name('user.brand.store');
        Route::post('/show', [BrandController::class, 'show'])->name('user.brand.show');
        Route::patch('/update', [BrandController::class, 'update'])->name('user.brand.update');
        Route::post('/destroy', [BrandController::class, 'destroy'])->name('user.brand.destroy');
        //bulk delete
        Route::post('/bulk/destroy', [BrandController::class, 'bulkDestroy'])->name('user.brand.destroy.bulk');
        //bulk delete
    });

    // training videos management
    Route::group(['prefix' => 'training'], function () {
        Route::get('/', [TrainingVideosController::class, 'index'])->name('user.training.list');
        Route::post('/store', [TrainingVideosController::class, 'store'])->name('user.training.store');
        Route::post('/show', [TrainingVideosController::class, 'show'])->name('user.training.show');
        Route::patch('/update', [TrainingVideosController::class, 'update'])->name('user.training.update');
        Route::post('/destroy', [TrainingVideosController::class, 'destroy'])->name('user.training.destroy');
    });

    // ticket issues management
    Route::group(['prefix' => 'ticket'], function () {
        Route::get('/', [TicketIssueController::class, 'index'])->name('user.ticket.list');
        Route::post('/store', [TicketIssueController::class, 'store'])->name('user.ticket.store');
        Route::post('/show', [TicketIssueController::class, 'show'])->name('user.ticket.show');
        Route::patch('/update', [TicketIssueController::class, 'update'])->name('user.ticket.update');
        Route::post('/destroy', [TicketIssueController::class, 'destroy'])->name('user.ticket.destroy');
    });

    // product data management
    Route::group(['prefix' => 'product/data'], function () {
        Route::get('/', [ProductDatasController::class, 'index'])->name('user.product.data.list');
        Route::get('/create', [ProductDatasController::class, 'create'])->name('user.product.data.create');
        Route::post('/store', [ProductDatasController::class, 'store'])->name('user.product.data.store');
        // bulk store
        Route::get('/bulk/create', [ProductDatasController::class, 'bulkCreate'])->name('user.product.data.create.bulk');
        Route::post('/bulk/store', [ProductDatasController::class, 'bulkStore'])->name('user.product.data.bulk.store');
        // bulk store
        // csv upload
        Route::post('/csv/store', [ProductDatasController::class, 'csvStore'])->name('user.product.data.csv.store');
        // csv upload
        Route::post('/show', [ProductDatasController::class, 'show'])->name('user.product.data.show');
        Route::get('/edit/{id}', [ProductDatasController::class, 'edit'])->name('user.product.data.edit');
        Route::post('/update/{id}', [ProductDatasController::class, 'update'])->name('user.product.data.update');
        Route::post('/destroy', [ProductDatasController::class, 'destroy'])->name('user.product.data.destroy');
        //bulk delete
        Route::post('/bulk/destroy', [ProductDatasController::class, 'bulkDestroy'])->name('user.product.data.destroy.bulk');
        //bulk delete
    });

    // product issues management
    Route::group(['prefix' => 'product/issue'], function () {
        Route::get('/', [ProductIssueController::class, 'index'])->name('user.product.issue.list');
        Route::post('/store', [ProductIssueController::class, 'store'])->name('user.product.issue.store');
        Route::post('/show', [ProductIssueController::class, 'show'])->name('user.product.issue.show');
        Route::patch('/update', [ProductIssueController::class, 'update'])->name('user.product.issue.update');
        Route::post('/destroy', [ProductIssueController::class, 'destroy'])->name('user.product.issue.destroy');
        //bulk delete
        Route::post('/bulk/destroy', [ProductIssueController::class, 'bulkDestroy'])->name('user.product.issue.destroy.bulk');
        //bulk delete
        // csv upload
        Route::post('/csv/store', [ProductIssueController::class, 'csvStore'])->name('user.product.issue.csv.store');
        // csv upload
    });

    // product icon management
    Route::group(['prefix' => 'product/icon'], function () {
        Route::get('/', [ProductIconController::class, 'index'])->name('user.product.icon.list');
        Route::post('/store', [ProductIconController::class, 'store'])->name('user.product.icon.store');
        Route::post('/show', [ProductIconController::class, 'show'])->name('user.product.icon.show');
        Route::post('/update', [ProductIconController::class, 'update'])->name('user.product.icon.update');
        Route::post('/destroy', [ProductIconController::class, 'destroy'])->name('user.product.icon.destroy');
        //bulk delete
        Route::post('/bulk/destroy', [ProductIconController::class, 'bulkDestroy'])->name('user.product.icon.destroy.bulk');
        //bulk delete
    });
});
