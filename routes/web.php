<?php


use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\inventarios\informes\InformeVentasController;
use App\Http\Controllers\inventarios\informes\InformeVentasDiaAndPvController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login.login');
})->name('login');

Route::get('/', function () {
    return view('login.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('dianasis.login')->middleware('authCustom');

Route::get('logout', function () {
    session()->flush();
})->name('logout')->middleware('authCustom');


//proteger rutas



/////home movil
Route::get('/informes/selecionar_empresa/{date?}', [Controller::class, 'selecionarEmpresa'])->name('vista.informes.selecionar_empresa')->middleware('authCustom');

Route::get('/informes/selecionar_informes', [Controller::class, 'selecionarInformes'])->name('vista.informes.selecionar_informes')->middleware('authCustom');

Route::get('/informes/ver_informes/hjk', [Controller::class, 'verInformesVentas'])->name('vista.informes.ver_informes.ventas')->middleware('authCustom');

Route::get('/consulta/informes/ventas-dia-y-pv', [InformeVentasDiaAndPvController::class, 'viewConsultaInformeDiaYPV'])->name('consulta.informe.ventas.diaypv')->middleware('authCustom');
