<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::get('verifyPasswordChange/{id}', 'UserController@verifyPasswordChange');

Route::post('login', 'UserController@login');

/**CopanyCode */
/**resive el codigo y lo busca*/
Route::post('searchCode','CompanyCodeController@searchCode');
/** responde los detalles correspondientes a esa solicitud de cotizacion */
Route::get('quotitation/details/{id}',"CompanyCodeController@detailsQuptitations");

/*RESPUESTA EMPRESA COTIZACION */
/**registra la Respuesta de cotizacion de la empresa*/
Route::post("quotitacion/response","QuoteResponseController@storageQuote");
/**registra la Respuesta de cotizacion de la empresa*/
Route::post("quotitacion/response/{id}","QuoteResponseController@storageDetails");
/**registra la Respuesta de cotizacion de la empresa*/
Route::post("quotitacion/response/file/{id}","QuoteResponseController@uploadFile");

/**Dado un id de una cotizacion y un id de solicitud de cotizacion, entrega los detalles de esa cotizacion */
Route::get("quote/{idCo}/{idRe}","QuoteResponseController@show");
/**Dado un id de solicitud de cotizacion devuelve todas las cotizaciones con sus respectivos detalles */
Route::get("listQuotation/{idRe}","QuoteResponseController@getQuotes");
/**Dado un id de solicitud de cotizacion devuelve una lista de datos para generar el cuadro comparativo */
Route::get("getComparativeChart/{idRe}","QuoteResponseController@comparativeChart");

Route::get("dowloadFile/{id}/{namefile}", "RequestQuotitationController@downloadFile");

/**mostrar los archivos */
Route::get("showFile/{id}/{namefile}", "RequestQuotitationController@showFile");
/**nombres de earchivos */
Route::get('files/{id}', 'RequestQuotitationController@showFiles');
/**devuleve el pdf de la solicitud */
Route::get('requestquotitationpdf/{id}','PDFQuotitationController@requestquotitationPDF');

/*ARCHIVOS DE COTIZACION */
/**nombre de archivo del detalle de una cotizacion */
Route::get('quotation/files/detail/{idDetailOffert}', 'QuoteResponseController@showNameFilesDetailsBusiness');
/**muestra el archivo del detalle de una cotizacion*/ //no tiene un servicio en frontend
Route::get("quotation/showFiles/detail/{namefile}", "QuoteResponseController@showFilesDetailsBusiness");
/**ARCHIVOS DE COTIZACION MANUAL */
/**nombre de archivo de cotizacion  manual*/
Route::get('ua/quotation/files/detail/{idDetailOffert}', 'QuoteResponseController@showNameFileBusinessManualUA');
/**muestra el archivo de contizacion manual*/ //no tiene un servicio en frontend
Route::get("ua/quotation/showFiles/detail/{namefile}", "QuoteResponseController@showFileBusinessManualUA");

/**Dentro de este grupo de rutas solo podran acceder si han iniciado sesion por lo tanto tiene que 
 * pasar el token para poder usar las rutas dentro del grupo
 */
Route::group(['middleware' => 'auth:api'], function(){
    /**USER CONTROLLER */
    /**Devuelve todos los detalles del usuario cuando inicia sesion */
    Route::post('details', 'UserController@details');
    /**Recibe el request con los datos del usuario y aparte el id del rol de usuario para registrar el nuevo usuario */
    Route::post('register/{id}', 'UserController@register');
    /**deverlve los permisos del usuario */
    Route::post('permissions','UserController@permissions');
    /**deverlve los roles del usuario */
    Route::post('roles','UserController@roles');
    /**Responde con los datos (mas el rol) de todos los usuarios registrados (listado de usuarios)*/
    Route::get('users', 'UserController@index');
    /** Responde con los usuarios que tienen el rol de jefe administrativos y no estan asignados a una unidad administrativa */
    Route::get('usersAdmi/WithoutDrives','UserController@usersAdmiWithoutDrives');
    /** Responde con los usuarios que tienen el rol de jefe de unidad de gasto y no estan asignados a una unidad de gasto */
    Route::get('usersSpending/WithoutDrives','UserController@usersSpendingWithoutDrives');
    /**SECTION PERSONAL */
    /**Devuelve los usuarios pertenecientes a una unidad administrativa */
    Route::get('users/unit/administrative/{id}', 'UserController@showUsersUnitAdministrative');
     /**Devuelve los usuarios pertenecientes a una unidad de gasto */
    Route::get('users/unit/spending/{id}', 'UserController@showUsersUnitSpending');
    /**Devuelve los usuarios que no pertenecen a una unidad administrativa */
    Route::get('users/unit/administrative/out/{id}', 'UserController@showUsersOutUnitAdministrative');
    /**Devuelve los usuarios que no pertenecen a una unidad de gasto */
    Route::get('users/unit/spending/out/{id}', 'UserController@showUsersOutUnitSpending');

    /**COTIZATION CONTROLLER */
    Route::get('quotitations', 'RequestQuotitationController@index');
    /**Crear una nueva cotizacion*/
    Route::post('quotitation', 'RequestQuotitationController@store');
    /**Dado un id de usuario muestra datos del usuario que va a realizar una solicitud */
    Route::get('getInform/{id}','RequestQuotitationController@getInformation');
    /**Devuelve todas las solicitudes que perteneces a esa unidad de gasto */
    Route::get('quotitations/spending/{id}', 'RequestQuotitationController@showRequestQuotationGasto');
    /**Devuelve todas las solicitudes que perteneces a esa unidad administrativa */
    Route::get('quotitations/{id}', 'RequestQuotitationController@showRequestQuotationAdministrative');
    /**recibe un id de solitud de adquicion y responde con los detalles que perteneces a esa solicitud, 
     * mas un campo que guarda el mensaje de si el monto estimado es superior al monto limite*/
    Route::get('quotitation/{id}', 'RequestQuotitationController@show');

    Route::put('quotitation/status/{id}', 'RequestQuotitationController@updateState');

    /**recibe un id de solicitud y responde con los archivos adjuntos que pertenecen a esa solicitud */
    Route::get('requestQuotitation/files/{id}', 'RequestQuotitationController@showFiles');
    /*recive los archivos para guardar */
    Route::post('upload/{id}', 'RequestQuotitationController@uploadFile');
    Route::get('download', 'RequestQuotitationController@download');

    /**REPORT CONTROLLER */
    /**Registra informe de una solicitud */
    Route::post('quotitation/report', 'ReportController@store');
    /**Devuelve el informe de una solicitud */
    Route::get('quotitation/report/{id}', 'ReportController@show');

    /**QUOTEREPORT CONTROLLER */
    /**Registra informe de una solicitud */
    Route::post('quotitation/quoteReport', 'QuoteReportController@store');
    /**Devuelve el informe de una solicitud */
    Route::get('quotitation/quoteReport/{id}', 'QuoteReportController@show');

    /**EMAIL CONTROLLER */
    /**resive los emails y la descripcion del mensage que se enviara a las empresas o a la empresa
     * y resive el id a la solicitud a la que pertenece*/
    Route::post('sendEmail/{id}','EmailController@store');
    Route::post('sendEmail','EmailController@store');

    /**ROL CONTROLLER */
    /**Devuleve la lista de todos los roles */
    Route::get('rols', 'RoleController@index');
    /**Recibe el id del usuario y el id del rol y modifica el rol de un usuario */
    Route::put('users/update/{idu}/{idr}', 'UserController@updateRol');
    /**Recibe el nombre y descripcion del nuevo rol para guardarlo */
    Route::post('roles/new', 'RoleController@store');
    /**Recibe el id del rol y un arreglo de permisos y modifica los permisos de ese rol */
    Route::put('roles/edit', 'RoleController@updatePermissionsOfRol');

    /**PERMISSION CONTROLLER */
    Route::get('permissions','PermissionController@index');


    /**LIMITE CONTROLLER */
    /**Actualiza un nuevo monto limite dado un id de la unidad administrativa a la que pertenece
     y tambien actualiza la fecha fin del monto anterior con la fecha inicio del nuevo monto*/
    Route::post('updateLimiteAmount','LimiteAmountController@updateLimiteAmount');
    //Devuelve lista de los montos limites dado un id de la unidad administrativa a la que pertenece
    Route::get('limiteAmounts/{id}','LimiteAmountController@show');
    //Devuel todos los montos
    Route::get('limiteAmout','LimiteAmountController@index');
    //Devuelve el registro actual de los montos limites dado un id de la unidad administrativa a la que pertenece
    Route::get('lastRecord/{id}','LimiteAmountController@sendCurrentData');

    /**FACULTY CONTROLLER */
    /**devuelve las facultades */
    Route::get('faculties','FacultyController@index');
    // Devuelve todas las facultades de la base de datos
    Route::get('Faculties','FacultyController@index');
    // Devuelve solo las facultades que no estan asignadas a una unidad administrativa
    Route::get('faculties/use','FacultyController@noUseFaculties');
    // Devuelve solo las facultades que si estan asignadas a una unidad administrativa
    Route::get('faculties/in/use','FacultyController@inUseFaculties');
    //Crea una nueva facultad 
    Route::post('facultad/new','FacultyController@store');

    /**ADMINISTRATIVE UNIT CONTROLLER */
    //Registra una unidad administrativa
    Route::post('administrativeUnit/new','AdministrativeUnitController@register');
    /**Devuelve la lista de todos las unidades administrativas */
    Route::get('administrativeUnit','AdministrativeUnitController@index');
    /**Dado un id de usuario y de unidad administrativa, se asigna el usuario como jefe de la unidad */
    Route::put('assignBossesAdmin/{idU}/{idA}','AdministrativeUnitController@assignHeadUnit');
    /**Dado un id de unidad administrativa devuelve el jefe de unidad administrativa  */
    Route::get('getInfoAdmi/{idUnit}','AdministrativeUnitController@getAdmiUser');
    /**SECTION PERSONAL */
    /**Asigna a un usuario mas un rol como parte del personal de una unidad administrativa*/
    Route::post('administrativeUnit/personal/new','AdministrativeUnitController@assignPersonal');

    /**SPENDING UNIT CONTROLLER */
    /**Recibe el nombre de la unidad de gasto y la id de la FACULTAD dentro de un request para guardarlo */
    Route::post('spendingUnits/new','SpendingUnitController@store');
    /**Devuelve la lista de todos las unidades de gasto con su facultad y unidad administrativa correspondiente*/
    Route::get('spendingUnits','SpendingUnitController@index');
    /**Dado un id de usuario y de unidad de gasto, se asigna el usuario como jefe de la unidad */
    Route::put('assignBossesSpending/{idU}/{idS}','SpendingUnitController@assignHeadUnit');
    /**SECTION PERSONAL */
    /**Asigna a un usuario mas un rol como parte del personal de una unidad de gasto */
    Route::post('spendingUnit/personal/new','SpendingUnitController@assignPersonal');

    /**EMPRESA CONTROLLER */
     /**Recibe los datos de una empresa dentro de un request para guardarlo */
    Route::post('business/new','BusinessController@store');
     /**Devuelve la lista de todos las empresas*/
    Route::get('business','BusinessController@index');
    /**Devuelve las empresas segun el "rubro" que se quiere buscar */
    Route::get('business/searchRubro','BusinessController@searchRubro');

    /*RESPUESTA EMPRESA COTIZACION DESDE LA UNIDAD ADMINISTRATIVA */
    /**registra la Respuesta de cotizacion de la empresa desde la unidad administrativa*/
    Route::post("ua/quotitacion/response","QuoteResponseController@UAstorageQuote");
    /**registra la Respuesta de cotizacion de la empresa desde la unidad administrativa*/
    Route::post("ua/quotitacion/response/{id}","QuoteResponseController@storageDetailsUA");
    /**registra la Respuesta de cotizacion de la empresa desde la unidad administrativa*/
    Route::post("ua/quotitacion/response/file/{id}","QuoteResponseController@uploadFileUA");
    /**registra la Respuesta de cotizacion de la empresa desde la unidad administrativa*/
    Route::post("ua/quotitacion/response/file/uageneral/{id}","QuoteResponseController@uploadFileGeneralUA");
    
});
