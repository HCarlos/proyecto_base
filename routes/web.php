<?php

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

//use Mail;

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();
Auth::routes(['verify' => true]);

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
    $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    $this->post('register', 'Auth\RegisterController@register');
//$this->post('register', 'Auth\RegisterController@register');
// Password Reset Routes...
/*
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
*/

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('edit', 'Auth\EditUserDataController@showEditUserData')->name('edit');
    Route::put('Edit', 'Auth\EditUserDataController@update')->name('Edit');
    Route::get('showEditProfilePhoto/', 'Auth\EditUserDataController@showEditProfilePhoto')->name('showEditProfilePhoto/');
    Route::get('showEditProfileEmail/', 'Auth\EditUserDataController@showEditProfileEmail')->name('showEditProfileEmail/');
    Route::put('changeEmailUser/', 'Auth\EditUserDataController@changeEmailUser')->name('changeEmailUser/');

    Route::post('subirFotoProfile/', 'Storage\StorageProfileController@subirArchivoProfile')->name('subirArchivoProfile/');
    Route::get('quitarFotoProfile/', 'Storage\StorageProfileController@quitarArchivoProfile')->name('quitarArchivoProfile/');

});

Route::get('enviar', ['as' => 'enviar', function () {
$data = ['link' => 'http://platsource.mx'];
    Mail::send('emails.notificacion', $data, function ($message) {
        $message->from('manager@logydes.com.mx', 'Logydes.com.mx');
        $message->to('logydes@gmail.com')->subject('Notificación');
    });
    return "Se envío el email";
}]);
