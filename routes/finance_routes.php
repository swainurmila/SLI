<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Finance\Admin\AuthController;
use App\Http\Controllers\Finance\Admin\DashboardController;
use App\Http\Controllers\Finance\Admin\BankController;
use App\Http\Controllers\Finance\Admin\MasterController;
use App\Http\Controllers\Finance\Admin\FundController;
use App\Http\Controllers\Finance\Admin\BudgetController;
use App\Http\Controllers\Finance\Admin\ExpensesController;
use App\Http\Controllers\Finance\Admin\ReportController;
use App\Http\Controllers\Finance\Admin\AdminController;
use App\Http\Controllers\Finance\Admin\FinanceChartController;







/*
|--------------------------------------------------------------------------
| Finance Routes
|--------------------------------------------------------------------------
|
| Here is where you can register finance routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "finance" middleware group. Now create something great!
|
*/

Route::prefix('finance')->group(function () {

    // Route::get('register',[UserRegisterController::class,'registerShow'])->name('office.register.show');
    // Route::post('register',[UserRegisterController::class,'EofficeUserStore'])->name('office.register.store');
    Route::get('login',[AuthController::class,'showLogin'])->name('finance.login.show');
    Route::post('login',[AuthController::class,'attemptLogin'])->name('finance.login.check');

    // Start profile routes
    Route::get('my-profile',[DashboardController::class,'viewProfile'])->name('admin.finance.uprofile');
    Route::patch('update-profile',[DashboardController::class,'updateProfile'])->name('admin.finance.profile.update');
    //end profile routes

    Route::group(['middleware' => ['auth.finance.user']], function () {

        Route::get('dashboard',[DashboardController::class,'index'])->name('finance.dashboard.show');
        Route::post('logout',[AuthController::class,'financeLogout'])->name('finance.logout');


    });


    Route::group(['middleware' => ['auth.finance.isadmin','role:Finance Admin']], function () {

        //User Management
        Route::get('finance-user-index', [AdminController::class,'userIndex'])->name('admin.user-index');
        Route::post('store-finance-user', [AdminController::class,'storeFinanceUser'])->name('admin.store-finance-user');
        Route::post('update-finance-user/{id}', [AdminController::class,'updateFinanceUser'])->name('admin.update-finance-user');
        //Bank details Master
    Route::get('bank-details-index', [BankController::class,'bankDetails'])->name('bank-details-index');
        Route::post('bank-details-store', [BankController::class,'storeBankDetails'])->name('bank-details-store');
        Route::post('bank-details-update/{id}', [BankController::class,'updateBankDetails'])->name('bank-details-update');
        //Add Category Master
        Route::get('scheme-master-index', [MasterController::class,'categoryMaster'])->name('category-master-index');
        Route::post('category-master-store', [MasterController::class,'storeCategoryMaster'])->name('category-master-store');
        Route::post('category-master-update/{id}', [MasterController::class,'updateCategoryMaster'])->name('category-master-update');
        //Add Sub-Category Master
        Route::get('sub-scheme-master-index', [MasterController::class,'subCategoryMaster'])->name('sub-category-master-index');
        Route::post('sub-category-master-store', [MasterController::class,'storeSubCategoryMaster'])->name('sub-category-master-store');
        Route::post('sub-category-master-update/{id}', [MasterController::class,'updateSubCategoryMaster'])->name('sub-category-master-update');
    });

    Route::group(['middleware' => ['can:finance-list']], function () {


        //Total fund collected from all the sources
        Route::get('fund-collected-sources', [FundController::class,'fundCollected'])->name('fund-collected-sources');
        Route::get('transactions/training-index', [FundController::class, 'trainingTransactions'])->name('training-index');
        Route::get('transactions/course-index', [FundController::class, 'courseTransactions'])->name('course-index');
        Route::get('transactions/workshop-index', [FundController::class, 'workshopTransactions'])->name('workshop-index');
        Route::get('transactions/library-index', [FundController::class, 'libraryTransactions'])->name('library-index');


        //report generation
        Route::get('/budget-report', [ReportController::class, 'budgetReport'])->name('report.budget-report');
        Route::post('/budget-report-filter', [ReportController::class, 'budgetReportFilter'])->name('report.budget-report-filter');
    
        Route::get('/opening-closing-report', [ReportController::class, 'openingReport'])->name('report.opening-closing-report');
        Route::get('yearly-budget-creation', [BudgetController::class,'budgetCreation'])->name('yearly-budget-creation');

    });

    Route::group(['middleware' => ['auth.finance.user', 'role:Finance User']], function () {


        //Yearly Budget Creation
        Route::post('yearly-budget-store', [BudgetController::class,'budgetStore'])->name('yearly-budget-store');
        Route::get('/get-sub-category', [BudgetController::class, 'getSubCategory'])->name('budget.get-sub-category');
        Route::get('/get-bank-account', [BudgetController::class, 'getBankAccount'])->name('budget.get-bank-account');
        Route::get('/check-budget-exist', [BudgetController::class, 'checkBudgetExist'])->name('budget.check-budget-exist');


        Route::get('budget-creation-by-year', [BudgetController::class,'budgetCreationByYear'])->name('yearly-budget-creation-year');


        //Yearly Budget Expenses
        Route::get('yearly-budget-expenses', [ExpensesController::class,'index'])->name('yearly-budget-expenses');
        Route::post('yearly-budget-expenses', [ExpensesController::class,'store'])->name('yearly-budget-expenses.store');


        //sub-category budget creation
        Route::get('subcategory-budget-creation/{id}', [BudgetController::class,'subCategoryBudget'])->name('subcategory-budget-creation');
        Route::get('subcategory-budget-creation/{category_id}/sub-category/{sub_id}/expenses', [BudgetController::class,'subCategoryBudgetExpenses'])->name('subcategory-budget-expenses');

        

        

        //date wise report filter
        Route::post('/opening-closing-report-filter', [ReportController::class, 'openingReportFilter'])->name('report.open-report-filter');
    });

    //Dashboard Charts
    Route::get('get-expenses', [FinanceChartController::class,'getExpenses'])->name('api.expenses.data');
    Route::get('get-current-expenses-budget', [FinanceChartController::class,'fetchCurrentExpensesBudget'])->name('api.current.expenses.data');
    
});

