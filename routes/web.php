<?php

use App\Http\Controllers\Account\SettingsController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SmsHistoryController;
use App\Http\Controllers\Auth\SocialiteLoginController;
use App\Http\Controllers\Calendar\CalendarController;
use App\Http\Controllers\Documentation\ReferencesController;
use App\Http\Controllers\Logs\AuditLogsController;
use App\Http\Controllers\Logs\SystemLogsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Admin\SmsSettingController;
use App\Http\Controllers\Admin\TokenController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Common\CronjobController;
use App\Http\Controllers\Common\DisplayController;
use App\Http\Controllers\Admin\DisplaySettingController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\ReasonForVisitController;
use App\Http\Controllers\Admin\ReasonForVisitCountersController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ScheduledReportsController;
use App\Http\Controllers\Common\LanguageController;
use App\Http\Controllers\Common\MessageController;
use App\Http\Controllers\Common\NotificationController;
use App\Http\Controllers\Common\ProfileController;
use App\Http\Controllers\UserManagement\UserManagementController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return redirect('index');
// });

$menu = theme()->getMenu();
array_walk($menu, function ($val) {
	if (isset($val['path'])) {
		$route = Route::get($val['path'], [PagesController::class, 'index']);

		// Exclude documentation from auth middleware
		if (!Str::contains($val['path'], 'documentation')) {
			$route->middleware('auth');
		}
	}
});

// Documentations pages
Route::prefix('documentation')->group(function () {
	Route::get('getting-started/references', [ReferencesController::class, 'index']);
	Route::get('getting-started/changelog', [PagesController::class, 'index']);
});


Route::get('generateScheduledReports/{id}', [CronjobController::class, 'generateScheduledReports']);

Route::middleware('auth')->group(function () {
	// Apps
	Route::prefix('apps')->group(function () {
		//Calendar
		Route::get('calendar', [CalendarController::class, 'index']);

		// User Management
		Route::prefix('user-management')->group(function () {
			Route::get('permissions', [UserManagementController::class, 'permissionsList']);
			Route::post('permissions/create', [UserManagementController::class, 'createPermission']);
			Route::delete('permissions/{id}', [UserManagementController::class, 'deletePermission']);
			Route::post('permissions/update/{id}', [UserManagementController::class, 'updatePermission'])->name('permissions.update');
			Route::get('users/list', [UserManagementController::class, 'usersList']);
			Route::get('users/view/{id}', [UserManagementController::class, 'usersView'])->name('users.view');
			Route::get('customers/view/{id}', [UserManagementController::class, 'customersView'])->name('customers.view');
			Route::get('users/edit/{id}', [UserManagementController::class, 'usersEdit'])->name('users.edit');
			Route::post('users/update/{id}', [UserManagementController::class, 'updateUser'])->name('users.update');
			Route::post('users/updatemail/{id}', [UserManagementController::class, 'updateUserEmail'])->name('users.updatemail');
			Route::post('users/updatelocation/{id}', [UserManagementController::class, 'updateUserLocation'])->name('users.updatlocation');
			Route::post('users/updatestatus/{id}', [UserManagementController::class, 'updateUserStatus'])->name('users.updatstatus');
			Route::post('users/sendnotification/{id}', [UserManagementController::class, 'sendnotification'])->name('users.sendnotification');
			Route::post('users/resetpassword/{id}', [UserManagementController::class, 'updateUserPassword'])->name('users.resetpassword');
			Route::post('users/assign-role', [UserManagementController::class, 'assignRole']);
			Route::post('users/create', [UserManagementController::class, 'createUser']);
			Route::delete('users/{id}', [UserManagementController::class, 'deleteUser'])->name('admin.user.destroy');
			Route::get('roles/list', [UserManagementController::class, 'rolesList']);
			Route::get('roles/view/{id}', [UserManagementController::class, 'rolesView'])->name('roles.view');
			Route::post('roles', [UserManagementController::class, 'createRole']);
			Route::delete('roles/{id}', [UserManagementController::class, 'deleteRole']);
			Route::post('roles/update/{id}', [UserManagementController::class, 'updateRole']);
			Route::post('/save-push-notification-token', [UserManagementController::class, 'savePushNotificationToken'])->name('save-push-notification-token');
			Route::post('/send-push-notification', [UserManagementController::class, 'sendPushNotification'])->name('send-push-notification');
		});
	});

	// Account pages
	Route::prefix('account')->group(function () {
		Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
		// Route::get('overview', [SettingsController::class, 'index'])->name('account.overview');
		Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
		Route::put('settings/email', [SettingsController::class, 'changeEmail'])->name('settings.changeEmail');
		Route::put('settings/password', [SettingsController::class, 'changePassword'])->name('settings.changePassword');
	});

	// Logs pages
	Route::prefix('log')->name('log.')->group(function () {
		Route::resource('system', SystemLogsController::class)->only(['index', 'destroy']);
		Route::resource('audit', AuditLogsController::class)->only(['index', 'destroy']);
	});

	// Report pages
	Route::prefix('reports')->group(function () {
		Route::get('/', [ReportController::class, 'index'])->name('reports.index');
		Route::get('scheduled', [ScheduledReportsController::class, 'index']);
		Route::get('scheduled/delete/{id}', [ScheduledReportsController::class, 'destroy']);
		Route::get('scheduled/history/{id}', [ScheduledReportsController::class, 'history']);
		Route::get('scheduled/schedule/{id}', [ScheduledReportsController::class, 'schedule']);
		Route::post('scheduled/create', [ScheduledReportsController::class, 'store']);
		Route::get('scheduled/show/{id}', [ScheduledReportsController::class, 'show']);
		Route::post('scheduled/edit/{id}', [ScheduledReportsController::class, 'update']);
	});

	# home
	Route::prefix('home')->group(function () {
		Route::get('home', [HomeController::class, 'index']);
		Route::get('/', [HomeController::class, 'home']);
		Route::post('confirmMobile', [HomeController::class, 'confirmMobile']);
		Route::post('confirmEmail', [HomeController::class, 'confirmEmail']);
		Route::post('confirmOTP', [HomeController::class, 'confirmOTP']);
		Route::post('confirmEmailOTP', [HomeController::class, 'confirmEmailOTP']);
		Route::post('getwaittime', [HomeController::class, 'getwaittime']);
		Route::post('getwaittimebyreason', [HomeController::class, 'getwaittimebyreason']);
		Route::post('getdepartments', [HomeController::class, 'getdepartments']);
		Route::get('current', [TokenController::class, 'currentClient']);
		Route::post('autotoken', [TokenController::class, 'clientTokenAuto']);
		Route::post('currentposition', [TokenController::class, 'currentposition']);
	});



	// SMS pages
	Route::prefix('sms')->group(function () {
		Route::get('/', [SmsHistoryController::class, 'index']);
		Route::get('new', [SmsHistoryController::class, 'form']);
		Route::post('new', [SmsHistoryController::class, 'send']);
		Route::get('list', [SmsHistoryController::class, 'show']);
		Route::post('data', [SmsHistoryController::class, 'smsData']);
		Route::get('delete/{id}', [SmsHistoryController::class, 'delete']);
		Route::get('setting', [SmsHistoryController::class, 'setting']);
		Route::post('setting', [SmsHistoryController::class, 'updateSetting']);
	});

	// Token pages
	Route::prefix('token')->group(function () {
		// Route::get('setting', [TokenController::class, 'tokenSettingView']);
		// Route::post('setting', [TokenController::class, 'tokenSetting']);
		// Route::get('setting/delete/{id}', [TokenController::class, 'tokenDeleteSetting']);
		Route::get('auto', [TokenController::class, 'tokenAutoView']);
		Route::post('auto', [TokenController::class, 'tokenAuto']);
		Route::get('current', [TokenController::class, 'current']);
		Route::get('current/card', [TokenController::class, 'currentOfficer']);
		Route::get('report', [TokenController::class, 'report']);
		Route::post('report/data', [TokenController::class, 'reportData']);
		Route::get('performance', [TokenController::class, 'performance']);
		Route::get('create', [TokenController::class, 'showForm']);
		Route::post('create', [TokenController::class, 'create']);
		Route::get('checkin/{id}', [TokenController::class, 'checkin']);
		Route::post('checkinotp', [TokenController::class, 'otpcheckin']);
		// Route::post('print', [TokenController::class, 'viewSingleToken']);
		// Route::post('print', [TokenController::class, 'printToken']);		
		Route::get('print/{id}', [TokenController::class, 'printToken']);
		Route::get('complete/{id}', [TokenController::class, 'complete']);
		Route::get('noshow/{id}', [TokenController::class, 'noshow']);
		Route::get('stoped/{id}', [TokenController::class, 'stoped']);
		Route::get('stopedclient/{id}', [TokenController::class, 'stopedClient']);
		Route::get('recall/{id}', [TokenController::class, 'recall']);
		Route::get('delete/{id}', [TokenController::class, 'delete']);
		Route::post('transfer', [TokenController::class, 'transfer']);
		Route::get('start/{id}', [TokenController::class, 'start']);
		Route::post('addnote', [TokenController::class, 'addnote']);
		Route::post('addreasonforvisit', [TokenController::class, 'addreasonforvisit']);		
	});


	# setting


	// // Company pages
	Route::prefix('company')->group(function () {
		Route::get('list', [CompanyController::class, 'index']);
		Route::get('create', [CompanyController::class, 'showForm']);
		Route::post('create', [CompanyController::class, 'store']);
		Route::get('edit/{id}', [CompanyController::class, 'showEditForm']);
		Route::get('view/{id}', [CompanyController::class, 'show']);
		Route::get('getLocations/{id}', [CompanyController::class, 'getLocations']);
		Route::post('edit/{id}', [CompanyController::class, 'update']);
		Route::get('delete/{id}', [CompanyController::class, 'destroy']);
	});

	// Setting pages
	Route::prefix('settings')->group(function () {
		Route::get('system', [SettingController::class, 'show']);
		Route::post('system', [SettingController::class, 'update']);
	});

	// // Location pages
	Route::prefix('location')->group(function () {
		Route::get('list', [LocationController::class, 'index']);
		Route::get('create', [LocationController::class, 'showForm']);
		Route::post('create', [LocationController::class, 'store']);
		Route::get('edit/{id}', [LocationController::class, 'showEditForm']);
		Route::get('view/{id}', [LocationController::class, 'show']);
		Route::post('edit/{id}', [LocationController::class, 'update']);
		Route::get('delete/{id}', [LocationController::class, 'destroy']);
		// Route::get('department/{id}', [LocationController::class, 'dept']);
		Route::get('token/setting/{id}', [TokenController::class, 'tokenSettingView']);
		Route::post('token/setting/{id}', [TokenController::class, 'tokenSetting']);
		Route::get('token/setting/delete/{id}', [TokenController::class, 'tokenDeleteSetting']);
		Route::get('map/{id}', [LocationController::class, 'map']);

		// // Department pages
		Route::prefix('department')->group(function () {
			Route::get('/{id}', [DepartmentController::class, 'index']);
			Route::get('create', [DepartmentController::class, 'showForm']);
			Route::post('create', [DepartmentController::class, 'create']);
			Route::get('edit/{id}', [DepartmentController::class, 'showEditForm']);
			Route::post('edit', [DepartmentController::class, 'update']);
			Route::get('delete/{id}', [DepartmentController::class, 'delete']);
			Route::post('getdepartments', [DepartmentController::class, 'getdepartments']);
		});

		// // Counter pages
		Route::prefix('counter')->group(function () {
			Route::get('/{id}', [CounterController::class, 'index']);
			Route::get('create', [CounterController::class, 'showForm']);
			Route::post('create', [CounterController::class, 'create']);
			Route::get('edit/{id}', [CounterController::class, 'showEditForm']);
			Route::post('edit', [CounterController::class, 'update']);
			Route::get('delete/{id}', [CounterController::class, 'delete']);
			Route::get('getCountersbyDept/{id}', [CounterController::class, 'getCountersbyDept']);
		});

		// Setting pages
		Route::prefix('settings')->group(function () {
			// Route::get('system', [SettingController::class, 'show']);
			// Route::post('/{id}', [SettingController::class, 'create']);
			Route::get('display/{id}', [DisplaySettingController::class, 'showForm']);
			Route::post('display/{id}', [DisplaySettingController::class, 'setting']);
			Route::get('display/custom', [DisplaySettingController::class, 'getCustom']);
			Route::post('display/custom', [DisplaySettingController::class, 'custom']);
		});


		// // Visit Reason
		Route::prefix('visitreason')->group(function () {
			Route::get('/{id}', [ReasonForVisitController::class, 'index']);
			Route::get('reasonsforvisit/{id}', [ReasonForVisitController::class, 'reasonsforvisit']);			
			Route::get('reasonsforvisitbylocation/{id}', [ReasonForVisitController::class, 'reasonsforvisitbylocation']);			
			Route::post('create', [ReasonForVisitController::class, 'store']);
			Route::post('edit/{id}', [ReasonForVisitController::class, 'update']);
			Route::get('delete/{id}', [ReasonForVisitController::class, 'destroy']);
			// Route::get('edit/{id}', [CounterController::class, 'showEditForm']);
			// Route::post('edit', [CounterController::class, 'update']);
			
			// Route::get('getCountersbyDept/{id}', [CounterController::class, 'getCountersbyDept']);
		});

		// // Visit Reason Counter
		Route::prefix('visitreasoncounter')->group(function () {
			Route::get('/{id}', [ReasonForVisitCountersController::class, 'index']);
			Route::post('edit/{id}', [ReasonForVisitCountersController::class, 'update']);
			// Route::get('reasonsforvisit/{id}', [ReasonForVisitController::class, 'reasonsforvisit']);			
			// Route::post('create', [ReasonForVisitController::class, 'store']);
			// Route::post('edit/{id}', [ReasonForVisitController::class, 'update']);
			// Route::get('delete/{id}', [ReasonForVisitController::class, 'destroy']);
			// Route::get('edit/{id}', [CounterController::class, 'showEditForm']);
			// Route::post('edit', [CounterController::class, 'update']);
			
			// Route::get('getCountersbyDept/{id}', [CounterController::class, 'getCountersbyDept']);
		});

		// // Visit Reason Counter
		Route::prefix('staff')->group(function () {
			Route::get('/{id}', [UserManagementController::class, 'officersList']);
			Route::get('edit/{id}', [UserManagementController::class, 'staffEdit']);
			// Route::get('reasonsforvisit/{id}', [ReasonForVisitController::class, 'reasonsforvisit']);			
			// Route::post('create', [ReasonForVisitController::class, 'store']);
			// Route::post('edit/{id}', [ReasonForVisitController::class, 'update']);
			// Route::get('delete/{id}', [ReasonForVisitController::class, 'destroy']);
			// Route::get('edit/{id}', [CounterController::class, 'showEditForm']);
			// Route::post('edit', [CounterController::class, 'update']);
			
			// Route::get('getCountersbyDept/{id}', [CounterController::class, 'getCountersbyDept']);
		});

		// Route::get('staff/{id}', [UserManagementController::class, 'officersList']);
		Route::get('getOfficersByCounter/{id}', [UserManagementController::class, 'getOfficersByCounter']);

		Route::get('customers/{id}', [UserManagementController::class, 'customerList']);
	});
});

// # -----------------------------------------------------------
// # COMMON 
// # -----------------------------------------------------------
Route::prefix('common')->namespace('Common')->group(function () {
	# switch language
	Route::get('language/{locale?}', [LanguageController::class, 'index']);

	// Cron job
	Route::get('jobs/sms', [CronjobController::class, 'sms']);
	Route::get('jobs/generateDepartmentStats', [CronjobController::class, 'generateDepartmentStats']);
	Route::get('jobs/generateLocationStats', [CronjobController::class, 'generateLocationStats']);
	Route::get('jobs/generateUserStats', [CronjobController::class, 'generateUserStats']);

	// Display 
	Route::get('display', [DisplayController::class, 'display']);
	Route::post('display1', [DisplayController::class, 'display1']);
	Route::post('display2', [DisplayController::class, 'display2']);
	Route::post('display3', [DisplayController::class, 'display3']);
	Route::post('display4', [DisplayController::class, 'display4']);
	Route::post('display5', [DisplayController::class, 'display5']);
	Route::post('display7', [DisplayController::class, 'display7']);

	// 	// -----------------------------------------------------------
	// 	// AUTHORIZED COMMON 
	// 	// -----------------------------------------------------------
	// 	Route::middleware('auth')->group(function() { 

	// 		Route::prefix('message')->group(function () {
	// 			// Message notification
	// 			Route::get('notify', [NotificationController::class, 'message']);
	// 			// Message pages
	// 			Route::get('/',[MessageController::class, 'show']); 
	// 			Route::post('/',[MessageController::class, 'send']);  
	// 			Route::get('inbox',[MessageController::class, 'inbox']); 
	// 			Route::post('inbox/data',[MessageController::class, 'inboxData']); 
	// 			Route::get('sent',[MessageController::class, 'sent']); 
	// 			Route::post('sent/data',[MessageController::class, 'sentData']); 
	// 			Route::get('details/{id}/{type}',[MessageController::class, 'details']); 
	// 			Route::get('delete/{id}/{type}',[MessageController::class, 'delete']);  
	// 			Route::post('attachment',[MessageController::class, 'UploadFiles']); 
	// 		});


	// 		// Profile
	// 		Route::prefix('setting')->group(function () {
	// 			Route::get('profile', [ProfileController::class, 'profile']);
	// 			Route::get('edit',[ProfileController::class, 'profileEditShowForm']);
	// 			Route::post('edit',[ProfileController::class, 'updateProfile']);
	// 		});

	// });
});


/**
 * Socialite login using Google service
 * https://laravel.com/docs/8.x/socialite
 */
Route::get('/auth/redirect/{provider}', [SocialiteLoginController::class, 'redirect']);

require __DIR__ . '/auth.php';
