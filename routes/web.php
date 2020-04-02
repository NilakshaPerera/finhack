<?php
/**_____  _  _          _____                _             
  / ____|(_)| |        |  __ \              | |            
 | (___   _ | |_  ___  | |__) | ___   _   _ | |_  ___  ___ 
  \___ \ | || __|/ _ \ |  _  / / _ \ | | | || __|/ _ \/ __|
  ____) || || |_|  __/ | | \ \| (_) || |_| || |_|  __/\__ \
 |_____/ |_| \__|\___| |_|  \_\\___/  \__,_| \__|\___||___/**/

Route::get('/', 'Site\WelcomeController@index')->name('welcome');
Route::resources(['quiz-start' => 'Site\QuestionController']);

//get user 
Route::get('student' , 'Site\WelcomeController@user');

// update student table
Route::post('student' , 'Site\WelcomeController@store');

// load presentation question 
Route::get('getPresentation' , 'Site\QuestionController@getPresentation');

// mark presentation question 
Route::post('markPresentation' , 'Site\QuestionController@markPresentation');

// mark video question 
Route::post('markVideos' , 'Site\QuestionController@markvideos');

// get session 
Route::post('session', 'Site\SessionController@session');

// start/end quiz
Route::post('set-session-state' , 'Site\QuestionController@setSessionState');

// End session
Route::post('end-session' , 'Site\QuestionController@endSession');

/**            _             _          _____                _             
     /\       | |           (_)        |  __ \              | |            
    /  \    __| | _ __ ___   _  _ __   | |__) | ___   _   _ | |_  ___  ___ 
   / /\ \  / _` || '_ ` _ \ | || '_ \  |  _  / / _ \ | | | || __|/ _ \/ __|
  / ____ \| (_| || | | | | || || | | | | | \ \| (_) || |_| || |_|  __/\__ \
 /_/    \_\\__,_||_| |_| |_||_||_| |_| |_|  \_\\___/  \__,_| \__|\___||___/**/

Route::resources(['admin/home' => 'Admin\AdminController']);
// Admin user routes
Route::resources(['admin/user' => 'Admin\UserController']);
Route::post('admin/user-create' , 'Admin\UserController@create')->name('admin/user-create');
Route::post('/admin/user-update' , 'Admin\UserController@update');

// Admin presentation routes
Route::resources(['admin/presentations' => 'Admin\PresentationController']);
Route::post('admin/presentation-create' , 'Admin\PresentationController@create')->name('admin/presentation-create');
Route::post('admin/presentation-update' , 'Admin\PresentationController@update')->name('admin/presentation-update');
// Admin exams rotues
Route::resources(['admin/exams' => 'Admin\ExamController']);
Route::get('admin/exams/{id}' , 'Admin\ExamController@show')->name('admin/exams/item');
// Admin score routes
Route::post('admin/score' , 'Admin\ExamController@score')->name('admin/score');
// Admin video routes
Route::post('admin/video' , 'Admin\ExamController@video')->name('admin/video');

Route::post('admin/save-settings' , 'Admin\AdminController@score')->name('admin/save-settings');

/**               _    _       _____                _             
     /\          | |  | |     |  __ \              | |            
    /  \   _   _ | |_ | |__   | |__) | ___   _   _ | |_  ___  ___ 
   / /\ \ | | | || __|| '_ \  |  _  / / _ \ | | | || __|/ _ \/ __|
  / ____ \| |_| || |_ | | | | | | \ \| (_) || |_| || |_|  __/\__ \
 /_/    \_\\__,_| \__||_| |_| |_|  \_\\___/  \__,_| \__|\___||___/**/
// Authentication Routes...
$this->get('login', 'Site\Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Site\Auth\LoginController@login');
$this->post('logout', 'Site\Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Site\Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Site\Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Site\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Site\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Site\Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Site\Auth\ResetPasswordController@reset')->name('password.update');

Route::get('admin/changePassword','Admin\Auth\ChangePasswordController@changePasswordForm');
Route::post('admin/changePassword','Admin\Auth\ChangePasswordController@changePassword')->name('admin.changePassword');

// Authentication Routes...
$this->get('admin/form', 'Admin\Auth\AdminLoginController@showLoginForm');
$this->get('admin/login', 'Admin\Auth\AdminLoginController@showLoginForm')->name('admin.login');
$this->post('admin/login', 'Admin\Auth\AdminLoginController@login');
$this->post('admin/logout', 'Admin\Auth\AdminLoginController@logout')->name('admin.logout');

// Public Authentication Routes...
$this->get('common/login', 'Common\PublicLoginController@showLoginForm')->name('common.login');
$this->post('common/login', 'Common\PublicLoginController@login');
$this->post('common/logout', 'Common\PublicLoginControlle@logout')->name('common.logout');

// Registration Routes...
$this->get('admin/register', 'Admin\Auth\RegisterController@showRegistrationForm')->name('admin.register');
$this->post('admin/register', 'Admin\Auth\RegisterController@register');

// Password Reset Routes...
$this->get('admin/password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
$this->post('admin/password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
$this->get('admin/password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
$this->post('admin/password/reset', 'Admin\Auth\ResetPasswordController@reset')->name('admin.password.update');
