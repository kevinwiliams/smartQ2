<?php

use App\Http\Controllers\Account\SettingsController;
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


// Apps
Route::prefix('apps')->group(function () {
	//Calendar
	Route::get('calendar', [CalendarController::class, 'index']);

	// User Management
	Route::prefix('user-management')->group(function () {
		Route::get('permissions', [UserManagementController::class, 'permissionsList']);
		Route::get('users/list', [UserManagementController::class, 'usersList']);
		Route::get('users/view/{id}', [UserManagementController::class, 'usersView'])->name('users.view');
		Route::get('users/edit/{id}', [UserManagementController::class, 'usersEdit'])->name('users.edit');
		Route::post('users/update/{id}', [UserManagementController::class, 'updateUser'])->name('users.update');
		Route::post('users/assign-role', [UserManagementController::class, 'assignRole']);
		Route::delete('users/{id}', [UserManagementController::class, 'deleteUser'])->name('admin.user.destroy');
		Route::get('roles/list', [UserManagementController::class, 'rolesList']);
		Route::get('roles/view/{id}', [UserManagementController::class, 'rolesView'])->name('roles.view');
		Route::post('roles', [UserManagementController::class, 'createRole']);
		Route::delete('roles/{id}', [UserManagementController::class, 'deleteRole']);
		Route::post('roles/update/{id}', [UserManagementController::class, 'updateRole']);
	});
	
});

Route::middleware('auth')->group(function () {
    // Account pages
    Route::prefix('account')->group(function () {
        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::put('settings/email', [SettingsController::class, 'changeEmail'])->name('settings.changeEmail');
        Route::put('settings/password', [SettingsController::class, 'changePassword'])->name('settings.changePassword');
    });

    // Logs pages
    Route::prefix('log')->name('log.')->group(function () {
        Route::resource('system', SystemLogsController::class)->only(['index', 'destroy']);
        Route::resource('audit', AuditLogsController::class)->only(['index', 'destroy']);
    });

	# -----------------------------------------------------------
	# ADMIN
	# -----------------------------------------------------------
	Route::prefix('admin')->namespace('admin')->group(function() { 
		# home
		Route::prefix('home')->group(function () {
		Route::get('home', [HomeController::class, 'index']);
		Route::get('/', [HomeController::class, 'home']);
		Route::post('confirmMobile', [HomeController::class, 'confirmMobile']);
		Route::post('confirmOTP', [HomeController::class, 'confirmOTP']);
		Route::post('getwaittime', [HomeController::class, 'getwaittime']);
		Route::get('current', [TokenController::class, 'currentClient']); 
		Route::post('autotoken', [TokenController::class, 'clientTokenAuto']);
		Route::post('currentposition',[TokenController::class, 'currentposition']);

		});
		// // User pages
		// Route::prefix('user')->group(function () {
		// 	Route::get('/', [UserController::class, 'index']);
		// 	Route::post('data', [UserController::class, 'userData']);
		// 	Route::get('create', [UserController::class, 'showForm']);
		// 	Route::post('create', [UserController::class, 'create']);
		// 	Route::get('view/{id}',[UserController::class, 'view']);
		// 	Route::get('edit/{id}',[UserController::class, 'showEditForm']);
		// 	Route::post('edit',[UserController::class, 'update']);
		// 	Route::get('delete/{id}',[UserController::class, 'delete']);
		// });
		
		// // Department pages
		Route::prefix('department')->group(function () {
			Route::get('/',[DepartmentController::class, 'index']);
			Route::get('create',[DepartmentController::class, 'showForm']);
			Route::post('create',[DepartmentController::class, 'create']);
			Route::get('edit/{id}',[DepartmentController::class, 'showEditForm']);
			Route::post('edit',[DepartmentController::class, 'update']);
			Route::get('delete/{id}',[DepartmentController::class, 'delete']);
		});
			
		// // Counter pages
		Route::prefix('counter')->group(function () {
			Route::get('/',[CounterController::class, 'index']);
			Route::get('create',[CounterController::class, 'showForm']);
			Route::post('create',[CounterController::class, 'create']);
			Route::get('edit/{id}',[CounterController::class, 'showEditForm']);
			Route::post('edit',[CounterController::class, 'update']);
			Route::get('delete/{id}',[CounterController::class, 'delete']);
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
			Route::get('setting',[TokenController::class, 'tokenSettingView']); 
			Route::post('setting',[TokenController::class, 'tokenSetting']); 
			Route::get('setting/delete/{id}',[TokenController::class, 'tokenDeleteSetting']);
			Route::get('auto',[TokenController::class, 'tokenAutoView']); 
			Route::post('auto',[TokenController::class, 'tokenAuto']); 
			Route::get('current',[TokenController::class, 'current']);
			Route::get('current/card',[TokenController::class, 'currentOfficer']);
			Route::get('report',[TokenController::class, 'report']);  
			Route::post('report/data',[TokenController::class, 'reportData']);  
			Route::get('performance',[TokenController::class, 'performance']);  
			Route::get('create',[TokenController::class, 'showForm']);
			Route::post('create',[TokenController::class, 'create']);
			Route::get('checkin/{id}',[TokenController::class, 'checkin']);
			Route::post('print', [TokenController::class, 'viewSingleToken']);
			Route::get('complete/{id}',[TokenController::class, 'complete']);
			Route::get('stoped/{id}',[TokenController::class, 'stoped']);
			Route::get('stopedclient/{id}',[TokenController::class, 'stopedClient']);
			Route::get('recall/{id}',[TokenController::class, 'recall']);
			Route::get('delete/{id}',[TokenController::class, 'delete']);
			Route::post('transfer',[TokenController::class, 'transfer']); 
		});
		
		// Setting pages
		Route::prefix('settings')->group(function () {
			Route::get('/',[SettingController::class, 'showForm']); 
			Route::post('/',[SettingController::class, 'create']); 
			Route::get('display',[DisplaySettingController::class, 'showForm']);  
			Route::post('display',[DisplaySettingController::class, 'setting']);  
			Route::get('display/custom',[DisplaySettingController::class, 'getCustom']);  
			Route::post('display/custom',[DisplaySettingController::class, 'custom']); 
		});
		# setting
		
		 
	});
});

Route::resource('users', UsersController::class);

// # -----------------------------------------------------------
// # COMMON 
// # -----------------------------------------------------------
Route::prefix('common')->namespace('Common')->group(function() { 
	# switch language
	Route::get('language/{locale?}', [LanguageController::class,'index']);

	// Cron job
	Route::get('jobs/sms', [CronjobController::class, 'sms']);

	// Display 
	Route::get('display',[DisplayController::class, 'display']);  
	Route::post('display1', [DisplayController::class, 'display1']);  
	Route::post('display2',[DisplayController::class, 'display2']);  
	Route::post('display3',[DisplayController::class, 'display3']); 
	Route::post('display4',[DisplayController::class, 'display4']); 
	Route::post('display5',[DisplayController::class, 'display5']); 

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

// # -----------------------------------------------------------
// # AUTHORIZED
// # -----------------------------------------------------------
// Route::group(['middleware' => ['auth']], function() { 

// 	# -----------------------------------------------------------
// 	# ADMIN
// 	# -----------------------------------------------------------
// 	Route::prefix('admin')->namespace('Admin')->middleware('roles:admin')->group(function() { 
// 		# home
// 		Route::get('/', [HomeController::class, 'home']);

// 		// User pages
// 		Route::prefix('user')->group(function () {
// 			Route::get('/', [UserController::class, 'index']);
// 			Route::post('data', [UserController::class, 'userData']);
// 			Route::get('create', [UserController::class, 'showForm']);
// 			Route::post('create', [UserController::class, 'create']);
// 			Route::get('view/{id}',[UserController::class, 'view']);
// 			Route::get('edit/{id}',[UserController::class, 'showEditForm']);
// 			Route::post('edit',[UserController::class, 'update']);
// 			Route::get('delete/{id}',[UserController::class, 'delete']);
// 		});
		
// 		// Department pages
// 		Route::prefix('department')->group(function () {
// 			Route::get('/',[DepartmentController::class, 'index']);
// 			Route::get('create',[DepartmentController::class, 'showForm']);
// 			Route::post('create',[DepartmentController::class, 'create']);
// 			Route::get('edit/{id}',[DepartmentController::class, 'showEditForm']);
// 			Route::post('edit',[DepartmentController::class, 'update']);
// 			Route::get('delete/{id}',[DepartmentController::class, 'delete']);
// 		});
			
// 		// Counter pages
// 		Route::prefix('counter')->group(function () {
// 			Route::get('/',[CounterController::class, 'index']);
// 			Route::get('create',[CounterController::class, 'showForm']);
// 			Route::post('create',[CounterController::class, 'create']);
// 			Route::get('edit/{id}',[CounterController::class, 'showEditForm']);
// 			Route::post('edit',[CounterController::class, 'update']);
// 			Route::get('delete/{id}',[CounterController::class, 'delete']);
// 		});
		
// 		// SMS pages
// 		Route::prefix('sms')->group(function () {
// 			Route::get('/', [SmsSettingController::class, 'index']);
// 			Route::get('new', [SmsSettingController::class, 'form']);
// 			Route::post('new', [SmsSettingController::class, 'send']);
// 			Route::get('list', [SmsSettingController::class, 'show']);
// 			Route::post('data', [SmsSettingController::class, 'smsData']);
// 			Route::get('delete/{id}', [SmsSettingController::class, 'delete']);
// 			Route::get('setting', [SmsSettingController::class, 'setting']);
// 			Route::post('setting', [SmsSettingController::class, 'updateSetting']);
// 		});

// 		// Token pages
// 		Route::prefix('token')->group(function () {
// 			Route::get('setting',[TokenController::class, 'tokenSettingView']); 
// 			Route::post('setting',[TokenController::class, 'tokenSetting']); 
// 			Route::get('setting/delete/{id}',[TokenController::class, 'tokenDeleteSetting']);
// 			Route::get('auto',[TokenController::class, 'tokenAutoView']); 
// 			Route::post('auto',[TokenController::class, 'tokenAuto']); 
// 			Route::get('current',[TokenController::class, 'current']);
// 			Route::get('report',[TokenController::class, 'report']);  
// 			Route::post('report/data',[TokenController::class, 'reportData']);  
// 			Route::get('performance',[TokenController::class, 'performance']);  
// 			Route::get('create',[TokenController::class, 'showForm']);
// 			Route::post('create',[TokenController::class, 'create']);
// 			Route::post('print', [TokenController::class, 'viewSingleToken']);
// 			Route::get('complete/{id}',[TokenController::class, 'complete']);
// 			Route::get('stoped/{id}',[TokenController::class, 'stoped']);
// 			Route::get('recall/{id}',[TokenController::class, 'recall']);
// 			Route::get('delete/{id}',[TokenController::class, 'delete']);
// 			Route::post('transfer',[TokenController::class, 'transfer']); 
// 		});
		
// 		// Setting pages
// 		Route::prefix('setting')->group(function () {
// 			Route::get('/',[SettingController::class, 'showForm']); 
// 			Route::post('/',[SettingController::class, 'create']); 
// 			Route::get('display',[DisplayController::class, 'showForm']);  
// 			Route::post('display',[DisplayController::class, 'setting']);  
// 			Route::get('display/custom',[DisplayController::class, 'getCustom']);  
// 			Route::post('display/custom',[DisplayController::class, 'custom']); 
// 		});
// 		# setting
		
		 
// 	});

// 	# -----------------------------------------------------------
// 	# OFFICER
// 	# -----------------------------------------------------------
// 	Route::prefix('officer')->namespace('Officer')->middleware('roles:officer')->group(function() { 
// 		// Home
// 		Route::get('/', [HomeController::class, 'home']);
// 		// User
// 		Route::get('user/view/{id}', [UserController::class, 'view']);

// 		// Token pages
// 		Route::prefix('token')->group(function () {
// 			Route::get('/',[TokenController::class, 'index']);
// 			Route::post('data',[TokenController::class, 'tokenData']);  
// 			Route::get('current',[TokenController::class, 'current']);
// 			Route::get('display',[TokenController::class, 'display']);
// 			Route::get('currentview',[TokenController::class, 'currentview']);
// 			Route::get('complete/{id}',[TokenController::class, 'complete']);
// 			Route::get('recall/{id}',[TokenController::class, 'recall']);
// 			Route::get('stoped/{id}',[TokenController::class, 'stoped']);
// 			Route::post('print', [TokenController::class, 'viewSingleToken']);
// 		});
		
// 	});

// 	# -----------------------------------------------------------
// 	# RECEPTIONIST
// 	# -----------------------------------------------------------
// 	Route::prefix('receptionist')->namespace('Receptionist')->middleware('roles:receptionist')->group(function() { 
// 		// Home
// 		Route::get('/',[TokenController::class, 'tokenAutoView']); 

// 		// Token pages
// 		Route::prefix('token')->group(function () {
// 			Route::get('auto',[TokenController::class, 'tokenAutoView']); 
// 			Route::post('auto',[TokenController::class, 'tokenAuto']); 
// 			Route::get('create',[TokenController::class, 'showForm']);
// 			Route::post('create',[TokenController::class, 'create']);
// 			Route::get('current',[TokenController::class, 'current']); 
// 			Route::post('print', [TokenController::class, 'viewSingleToken']);
// 			Route::get('checkin/{id}',[TokenController::class, 'checkin']);
// 			Route::post('data',[TokenController::class, 'tokenData']);
// 			Route::post('transfer',[TokenController::class, 'transfer']); 
// 		});
		 
// 	});

// 	# -----------------------------------------------------------
// 	# CLIENT
// 	# -----------------------------------------------------------
// 	Route::prefix('client')->namespace('Client')->middleware('roles:client')->group(function() { 
// 		// Home
// 		Route::get('/', [HomeController::class, 'home']);
// 		Route::post('confirmMobile', [HomeController::class, 'confirmMobile']);
// 		Route::post('confirmOTP', [HomeController::class, 'confirmOTP']);
// 		Route::post('getwaittime', [HomeController::class, 'getwaittime']);

// 		// Token pages
// 		Route::prefix('token')->group(function () {
// 			Route::get('auto',[TokenController::class, 'tokenAutoView']); 
// 			Route::post('client',[TokenController::class, 'clientTokenAuto']); 
// 			Route::post('auto',[TokenController::class, 'tokenAuto']); 
// 			Route::get('create',[TokenController::class, 'showForm']);
// 			Route::get('stoped/{id}',[TokenController::class, 'stoped']);
// 			Route::get('checkin/{id}',[TokenController::class, 'checkin']);
// 			Route::get('currentposition',[TokenController::class, 'currentposition']);
// 			Route::post('create',[TokenController::class, 'create']);
// 			Route::get('current',[TokenController::class, 'current']); 
// 			Route::post('print', [TokenController::class, 'viewSingleToken']);
// 		});
		
// 	});
// });

/**
 * Socialite login using Google service
 * https://laravel.com/docs/8.x/socialite
 */
Route::get('/auth/redirect/{provider}', [SocialiteLoginController::class, 'redirect']);

require __DIR__.'/auth.php';
