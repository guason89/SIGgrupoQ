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

foreach (new DirectoryIterator(__DIR__) as $file)
{
    if (!$file->isDot() && !$file->isDir() && $file->getFilename() != '.gitignore')
    {
        require_once __DIR__.'//'.$file->getFilename();
        //require_once __DIR__.'/Routes/'.$file->getFilename();
    }
}

Route::get('/', function () {
       return view('Auth.login');
   });

//ruta hacia home
Route::get('/home',['as' => 'doInicio','uses' => 'HomeController@index']); 

	//rutas para usuarios

Route::get('login',['as'=>'login', 'uses'=>'UsersController@showLoginForm']);
Route::post('login','UsersController@authenticate');
Route::get('logout',['as'=>'logout','uses'=> 'UsersController@logout']);
Route::get('register','UsersController@getRegister');
Route::post('register','UsersController@postRegister');
Route::get('usuario/create/{id}','UsersController@create');
Route::resource('usuario','UsersController');


Route::group(['middleware'=>['auth']],function(){
	
    //rutas de usuarios q solo puede acceder el admin
	Route::get('user/{id}',['as'=>'usuario-eliminar','uses'=>'UsersController@mostrar']);
	Route::get('{id}/edit','UsersController@getEdit');
});


	