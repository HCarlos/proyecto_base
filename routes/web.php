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


    // USUARIOS
    Route::get('edit', 'Catalogos\User\UserDataController@showEditUserData')->name('edit');
    Route::put('Edit', 'Catalogos\User\UserDataController@update')->name('Edit');
    Route::get('showEditProfilePhoto/', 'Catalogos\User\UserDataController@showEditProfilePhoto')->name('showEditProfilePhoto/');
    Route::get('editUser/{Id}', 'Catalogos\User\UserDataController@showEditUser')->name('editUser');
    Route::put('EditUser', 'Catalogos\User\UserDataController@updateUser')->name('EditUser');
    Route::get('newUser', 'Catalogos\User\UserDataController@newUser')->name('newUser');
    Route::post('createUser', 'Catalogos\User\UserDataController@createUser')->name('createUser');
    Route::get('removeUser/{id}', 'Catalogos\User\UserDataController@removeUser')->name('removeUser');
    Route::get('showEditProfilePassword/', 'Catalogos\User\UserDataController@showEditProfilePassword')->name('showEditProfilePassword/');
    Route::put('changePasswordUser/', 'Catalogos\User\UserDataController@changePasswordUser')->name('changePasswordUser/');
    Route::post('subirFotoProfile/', 'Storage\StorageProfileController@subirArchivoProfile')->name('subirArchivoProfile/');
    Route::get('quitarFotoProfile/', 'Storage\StorageProfileController@quitarArchivoProfile')->name('quitarArchivoProfile/');
    Route::get('list-users/', 'Catalogos\User\UserDataController@showListUser')->name('listUsers');
    Route::get('showEditBecas/{Id}', 'Catalogos\User\UserDataController@showEditBecas')->name('showEditBecas');
    Route::put('putAluBecas', 'Catalogos\User\UserDataController@putAluBecas')->name('putAluBecas');

    // Roles
//    Route::post('/create_role','Catalogos\User\RoleController@create')->name('roleCreate/');
//    Route::put('/update_role/{rol}','Catalogos\User\RoleController@update')->name('roleUpdate/');
//    Route::get('/destroy_role/{id}/{idItem}/{action}', 'Catalogos\User\RoleController@destroy')->name('roleDestroy/');

    // Permissions
//    Route::post('/create_permission','Catalogos\User\PermissionController@@create')->name('permissionCreate/');
//    Route::put('/update_permission/{perm}','Catalogos\User\PermissionController@@update')->name('permissionUpdate/');
//    Route::get('/destroy_permission/{id}/{idItem}/{action}', 'Catalogos\User\PermissionController@@destroy')->name('permissionDestroy/');

    Route::get('asignaRole/{Id}','Catalogos\User\RoleController@index')->name('asignaRole');
    Route::get('assignRoleToUser/{Id}/{nameRoles}','Catalogos\User\RoleController@asignar')->name('assignRoleToUser');
    Route::get('unAssignRoleToUser/{Id}/{nameRoles}','Catalogos\User\RoleController@desasignar')->name('unAssignRoleToUser');


});

Route::get('enviar', ['as' => 'enviar', function () {
$data = ['link' => 'http://platsource.mx'];
    Mail::send('emails.notificacion', $data, function ($message) {
        $message->from('manager@logydes.com.mx', 'Logydes.com.mx');
        $message->to('logydes@gmail.com')->subject('Notificación');
    });
    return "Se envío el email";
}]);
