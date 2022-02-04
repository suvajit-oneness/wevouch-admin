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

    // borrower
    Route::group(['prefix' => 'borrower'], function () {
        Route::get('/', [BorrowerController::class, 'index'])->name('user.borrower.list');
        Route::post('/load', [BorrowerController::class, 'indexLoad'])->name('user.borrower.load');
        // Route::get('/old', [BorrowerController::class, 'indexOld'])->name('user.borrower.oldlist');
        Route::get('/create', [BorrowerController::class, 'create'])->name('user.borrower.create');
        Route::post('/store', [BorrowerController::class, 'store'])->name('user.borrower.store');
        Route::post('/show', [BorrowerController::class, 'show'])->name('user.borrower.show');
        Route::get('/{id}/view', [BorrowerController::class, 'details'])->name('user.borrower.details');
        Route::get('/{id}/edit', [BorrowerController::class, 'edit'])->name('user.borrower.edit');
        Route::post('/{id}/update', [BorrowerController::class, 'update'])->name('user.borrower.update');
        Route::post('/destroy', [BorrowerController::class, 'destroy'])->name('user.borrower.destroy');
        Route::post('/csv/upload', [BorrowerController::class, 'upload'])->name('user.borrower.csv.upload');

        // agreement
        Route::get('/{id}/agreement', [BorrowerController::class, 'agreementFields'])->name('user.borrower.agreement');
        Route::post('/agreement/store', [BorrowerController::class, 'agreementStore'])->name('user.borrower.agreement.store');
        Route::post('/agreement/document/upload', [BorrowerController::class, 'uploadToServer'])->name('user.borrower.agreement.document.upload');
        Route::post('/agreement/document/show', [BorrowerController::class, 'showDocument'])->name('user.borrower.agreement.document.show');
        Route::post('/agreement/document/verify', [BorrowerController::class, 'verifyDocument'])->name('user.borrower.agreement.document.verify');

        // pdf
        Route::get('/{borrowerId}/agreement/{agreementId}/pdf/view', [PDFController::class, 'showDynamicPdf'])->name('user.borrower.agreement.pdf.view');
        Route::get('/{borrowerId}/agreement/{agreementId}/pdf/page-3/view', [PDFController::class, 'showDynamicPdfPage3'])->name('user.borrower.agreement.pdf.page3.view');
        Route::get('/{borrowerId}/agreement/{agreementId}/pdf/page-24/view', [PDFController::class, 'showDynamicPdfPage24'])->name('user.borrower.agreement.pdf.page24.view');
        Route::get('/{borrowerId}/agreement/{agreementId}/pdf/page-25/view', [PDFController::class, 'showDynamicPdfPage25'])->name('user.borrower.agreement.pdf.page25.view');
        Route::get('/{borrowerId}/agreement/{agreementId}/pdf/page-31/view', [PDFController::class, 'showDynamicPdfPage31'])->name('user.borrower.agreement.pdf.page31.view');
        // Route::get('/{borrowerId}/agreement/{agreementId}/pdf/view', [PDFController::class, 'generateDynamicPdf'])->name('user.borrower.agreement.pdf.download');
    });

    // role
    Route::group(['prefix' => 'employee/role'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('user.role.list');
        Route::post('/store', [RoleController::class, 'store'])->name('user.role.store');
        Route::post('/show', [RoleController::class, 'show'])->name('user.role.show');
        Route::post('/destroy', [RoleController::class, 'destroy'])->name('user.role.destroy');
    });

    // agreement
    Route::group(['prefix' => 'agreement'], function () {
        Route::get('/', [AgreementController::class, 'index'])->name('user.agreement.list');
        Route::get('/create', [AgreementController::class, 'create'])->name('user.agreement.create');
        Route::post('/store', [AgreementController::class, 'store'])->name('user.agreement.store');
        Route::post('/show', [AgreementController::class, 'show'])->name('user.agreement.show');
        Route::get('/{id}/view', [AgreementController::class, 'details'])->name('user.agreement.details');
        Route::get('/{id}/edit', [AgreementController::class, 'edit'])->name('user.agreement.edit');
        Route::post('/{id}/update', [AgreementController::class, 'update'])->name('user.agreement.update');
        Route::post('/destroy', [AgreementController::class, 'destroy'])->name('user.agreement.destroy');
        Route::get('/{id}/fields', [AgreementController::class, 'fieldsIndex'])->name('user.agreement.fields');
        Route::post('/fields/store', [AgreementController::class, 'fieldsStore'])->name('user.agreement.fields.store');
        // pdf
        Route::get('/{id}/pdf/view', [PDFController::class, 'showPdf'])->name('user.agreement.pdf.view');
        Route::get('/{id}/pdf/download', [PDFController::class, 'generatePdf'])->name('user.agreement.pdf.download');
        // documents
        Route::get('/{id}/documents', [AgreementController::class, 'documentsIndex'])->name('user.agreement.documents.list');
        Route::post('/documents/store', [AgreementController::class, 'documentsStore'])->name('user.agreement.documents.store');
        Route::post('/documents/show', [AgreementController::class, 'documentsShow'])->name('user.agreement.documents.show');
        Route::post('/documents/destroy', [AgreementController::class, 'documentsDestroy'])->name('user.agreement.documents.destroy');
    });

    // field
    Route::group(['prefix' => 'field'], function () {
        Route::get('/', [FieldController::class, 'index'])->name('user.field.list');
        Route::get('/create', [FieldController::class, 'create'])->name('user.field.create');
        Route::post('/store', [FieldController::class, 'store'])->name('user.field.store');
        Route::post('/show', [FieldController::class, 'show'])->name('user.field.show');
        Route::get('/{id}/view', [FieldController::class, 'details'])->name('user.field.details');
        Route::get('/{id}/edit', [FieldController::class, 'edit'])->name('user.field.edit');
        Route::post('/{id}/update', [FieldController::class, 'update'])->name('user.field.update');
        Route::post('/destroy', [FieldController::class, 'destroy'])->name('user.field.destroy');
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

    // department management
    Route::group(['prefix' => 'employee/department'], function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('user.department.list');
        Route::post('/store', [DepartmentController::class, 'store'])->name('user.department.store');
        Route::post('/show', [DepartmentController::class, 'show'])->name('user.department.show');
        Route::patch('/update', [DepartmentController::class, 'update'])->name('user.department.update');
        Route::post('/destroy', [DepartmentController::class, 'destroy'])->name('user.department.destroy');
    });

    // designation management
    Route::group(['prefix' => 'employee/designation'], function () {
        Route::get('/', [DesignationController::class, 'index'])->name('user.designation.list');
        Route::post('/store', [DesignationController::class, 'store'])->name('user.designation.store');
        Route::post('/show', [DesignationController::class, 'show'])->name('user.designation.show');
        Route::patch('/update', [DesignationController::class, 'update'])->name('user.designation.update');
        Route::post('/destroy', [DesignationController::class, 'destroy'])->name('user.designation.destroy');
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
