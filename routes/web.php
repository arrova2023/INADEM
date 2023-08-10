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

/*Route::get('/', function () {
    return view('welcome');
});
/*
/Route::get('/', function () {
    return view('index');
});
Route::get('home', function () {
    return view('index');
});
*/
//LLAMAR CONTROLADOR A LA VISTA
Route::get('/','InademController@ver');
//Enrutamiento de la modificacion de proyectos (lo que sigue de admin)
Route::get('/proyecto/{id}','InademController@editar');
//actualizar cambios del proyecto
Route::post('/proyecto/actualizarProyecto','AdminController@actualizarProyecto');

//Route::get('admin', function () {return view('admin');});
Route::get('admin','AdminController@index');
Route::get('admin/{id}','AdminController@editar');
Route::post('eliminar','AdminController@eliminar');

//Enrutamiento de la modificacion de proyectos (lo que sigue de admin)
Route::get('editar', function(){
    return view('editar');
});


//// enrutamiento de la accion
Route::post('insertar', 'InademController@insertar');
Route::post('reciboArray','InademController@reciboArray');
//metodo para token
Route::post('tokenInademApp', 'InademController@tokenInademApp');
//// enrutamiento de la accion
Route::post('insertarParticipante','InademController@insertarParticipante');
Route::post('eliminarParticipante','InademController@eliminarParticipante');
Route::post('insertarRiesgo','InademController@insertarRiesgo');
Route::post('eliminarRiesgo','InademController@eliminarRiesgo');
// enrutamiento para obtener el id proyecto
Route::get('obtenerIdProyecto','InademController@obtenerIdProyecto');
#DataTables - Admin
Route::get('datatable', ['uses'=>'PostController@datatable']);
Route::get('datatable/getposts', ['as'=>'datatable.getposts','uses'=>'PostController@getPosts']);


//Reporte en Excel
//Enrutamiento del botón.
Route::get('excel', function(){
    return view('excel');
});
//Enrutamiento de la generación.
Route::get('generarExcel', function(){
    return view('generarExcel');
});

