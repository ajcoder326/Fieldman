<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AiChatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpenseRequestController;
use App\Http\Controllers\ExpenseTypeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\VisitController;
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

Route::group(['middleware' => 'admin'], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('liveLocation', [DashboardController::class, 'liveLocation'])->name('liveLocation');
    Route::get('liveLocationAjax', [DashboardController::class, 'liveLocationAjax'])->name('liveLocationAjax');

    Route::get('cardView', [DashboardController::class, 'cardView'])->name('cardView');
    Route::get('dashboard/cardViewAjax', [DashboardController::class, 'cardViewAjax'])->name('dashboard/cardViewAjax');

    Route::get('dashboard/getTeamWiseCountAjax', [DashboardController::class, 'getTeamWiseCountAjax'])->name('dashboard.getTeamWiseCountAjax');
    Route::get('dashboard/getRecentCheckInsAjax', [DashboardController::class, 'getRecentCheckInsAjax'])->name('dashboard.getRecentCheckInsAjax');
    Route::get('dashboard/getPresentDataAjax', [DashboardController::class, 'getPresentDataAjax'])->name('dashboard.getPresentDataAjax');
    Route::get('dashboard/getTeamWiseAttendanceAjax', [DashboardController::class, 'getTeamWiseAttendanceAjax'])->name('dashboard.getTeamWiseAttendanceAjax');


    Route::post('dashboard/getTimeLineAjax', [DashboardController::class, 'getTimeLineAjax'])->name('dashboard.getTimeLineAjax');
    Route::get('timeLine', [DashboardController::class, 'timeLine'])->name('timeLine');
    Route::post('timeLine/updateLocationAjax', [DashboardController::class, 'updateLocationAjax'])->name('timeLine.updateLocationAjax');

    //Employee
    Route::get('employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('employee/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('employee/show/{id}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::get('employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::post('employee/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::post('employee/changeStatus', [EmployeeController::class, 'changeStatus'])->name('employee.changeStatus');
    Route::get('employee/getGeofenceGroups', [EmployeeController::class, 'getGeofenceGroups'])->name('employee.getGeofenceGroups');
    Route::get('employee/getIpGroups', [EmployeeController::class, 'getIpGroups'])->name('employee.getIpGroups');
    Route::get('employee/getQrGroups', [EmployeeController::class, 'getQrGroups'])->name('employee.getQrGroups');
    Route::get('employee/getSites', [EmployeeController::class, 'getSites'])->name('employee.getSites');

    //Device
    Route::get('device', [DeviceController::class, 'index'])->name('device.index');
    Route::post('device/revoke/{id}', [DeviceController::class, 'revoke'])->name('device.revoke');

    Route::get('team', [TeamController::class, 'index'])->name('team.index');
    Route::get('team/create', [TeamController::class, 'create'])->name('team.create');
    Route::post('team/store', [TeamController::class, 'store'])->name('team.store');
    Route::get('team/edit/{id}', [TeamController::class, 'edit'])->name('team.edit');
    Route::post('team/update', [TeamController::class, 'update'])->name('team.update');
    Route::get('team/delete/{id}', [TeamController::class, 'delete'])->name('team.delete');
    Route::post('team/changeStatus', [TeamController::class, 'changeStatus'])->name('team.changeStatus');
    Route::post('team/changeChatStatus', [TeamController::class, 'changeChatStatus'])->name('team.changeChatStatus');


    Route::get('chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('chat/getTeamChat', [ChatController::class, 'getTeamChat'])->name('chat.getTeamChat');
    Route::post('chat/sendMessage', [ChatController::class, 'sendMessage'])->name('chat.sendMessage');

    Route::get('shift', [ShiftController::class, 'index'])->name('shift.index');
    Route::get('shift/create', [ShiftController::class, 'create'])->name('shift.create');
    Route::post('shift/store', [ShiftController::class, 'store'])->name('shift.store');
    Route::get('shift/destroy/{id}', [ShiftController::class, 'destroy'])->name('shift.destroy');
    Route::get('shift/edit/{id}', [ShiftController::class, 'edit'])->name('shift.edit');
    Route::post('shift/update', [ShiftController::class, 'update'])->name('shift.update');

    Route::get('account', [AccountController::class, 'index'])->name('account');
    Route::get('account/create', [AccountController::class, 'create'])->name('account.create');
    Route::post('account/store', [AccountController::class, 'store'])->name('account.store');
    Route::get('account/edit/{id}', [AccountController::class, 'edit'])->name('account.edit');
    Route::post('account/update/{id}', [AccountController::class, 'update'])->name('account.update');
    Route::get('account/show/{id}', [AccountController::class, 'show'])->name('account.show');
    Route::post('account/changePassword', [AccountController::class, 'changePassword'])->name('account.changePassword');
    Route::get('account/changePassword', [AccountController::class, 'changePasswordView'])->name('account.changePasswordView');
    Route::post('account/changeStatus/{id}', [AccountController::class, 'changeStatus'])->name('account.changeStatus');

    Route::get('holiday', [HolidayController::class, 'index'])->name('holiday.index');
    Route::get('holiday/create', [HolidayController::class, 'create'])->name('holiday.create');
    Route::post('holiday/store', [HolidayController::class, 'store'])->name('holiday.store');
    Route::post('holiday/destroy/{id}', [HolidayController::class, 'destroy'])->name('holiday.destroy');
    Route::get('holiday/edit/{id}', [HolidayController::class, 'edit'])->name('holiday.edit');
    Route::post('holiday/update', [HolidayController::class, 'update'])->name('holiday.update');

    Route::get('visit', [VisitController::class, 'index'])->name('visit.index');
    Route::post('visit/delete/{id}', [VisitController::class, 'destroy'])->name('visit.destroy');

    Route::get('client', [ClientController::class, 'index'])->name('client.index');
    Route::get('client/show/{id}', [ClientController::class, 'show'])->name('client.show');
    Route::get('client/create', [ClientController::class, 'create'])->name('client.create');
    Route::post('client/store',[ClientController::class, 'store'])->name('client.store');
    Route::get('client/edit/{id}',[Clientcontroller::class, 'edit'])->name('client.edit');
    Route::post('client/update/{id}',[Clientcontroller::class, 'update'])->name('client.update');
    Route::post('client/changeStatus',[Clientcontroller::class, 'changeStatus'])->name('client.changeStatus');

    Route::resource('leaveType', LeaveTypeController::class);
    Route::post('leaveType.changeStatus', [LeaveTypeController::class, 'changeStatus'])->name('leaveType.changeStatus');

    Route::resource('expenseType', ExpenseTypeController::class);
    Route::post('expenseType.changeStatus', [ExpenseTypeController::class, 'changeStatus'])->name('expenseType.changeStatus');

    Route::resource('expenseRequest', ExpenseRequestController::class);
    Route::post('expenseRequest.action', [ExpenseRequestController::class, 'action'])->name('expenseRequest.action');

    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('settings/addons', [SettingsController::class, 'addons'])->name('settings.addons');
    Route::post('settings/updateBasicSettings', [SettingsController::class, 'updateBasicSettings'])->name('settings.updateBasicSettings');
    Route::post('settings/updateDashboardSettings', [SettingsController::class, 'updateDashboardSettings'])->name('settings.updateDashboardSettings');
    Route::post('settings/updateMobileAppSettings', [SettingsController::class, 'updateMobileAppSettings'])->name('settings.updateMobileAppSettings');
    Route::post('settings/updateMapSettings', [SettingsController::class, 'updateMapSettings'])->name('settings.updateMapSettings');
    Route::post('settings/updateAddonStatus', [SettingsController::class, 'updateAddonStatus'])->name('settings.updateAddonStatus');

    Route::get('support', [SupportController::class, 'index'])->name('support.index');

    Route::post('leaveRequest.action', [LeaveRequestController::class, 'action'])->name('leaveRequest.action');

    Route::resource('leaveRequest', LeaveRequestController::class);

    Route::get('report', [ReportController::class, 'index'])->name('report.index');
    Route::post('report/getAttendanceReport', [ReportController::class, 'getAttendanceReport'])->name('report.getAttendanceReport');
    Route::post('report/getVisitReport', [ReportController::class, 'getVisitReport'])->name('report.getVisitReport');
    Route::post('report/getLeaveReport', [ReportController::class, 'getLeaveReport'])->name('report.getLeaveReport');
    Route::post('report/getExpenseReport', [ReportController::class, 'getExpenseReport'])->name('report.getExpenseReport');

    Route::post('aiChat/sendMessage', [AiChatController::class, 'sendMessage'])->name('aiChat.sendMessage');

});

Route::get('auth/login', [AuthController::class, 'login'])->name('auth.login');

Route::group(['as' => 'auth.', 'prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'loginPost'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

