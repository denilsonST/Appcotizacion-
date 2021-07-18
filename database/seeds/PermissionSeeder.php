<?php

use Illuminate\Database\Seeder;
use App\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //unidad de gasto
        $permiso = new Permission();
        $permiso->namePermission ="Solicitu de aquicición";
        $permiso->description = "Puede ver las solicitudes de adquicicion y poder verlas";
        $permiso->url = "/SolicitudesDeAdquisicion";
        $permiso->save();
        $permiso2 = new Permission();
        $permiso2->namePermission ="Agregar detalle solictud";
        $permiso2->description = "Puede agragar detalles a la solicitud";
        $permiso2->url = "/AgregarDetalleSolictud";
        $permiso2->save();
        //unidad administrativa
        $permiso3 = new Permission();
        $permiso3->namePermission ="Ver las solicitudes de adquisición";
        $permiso3->description = "Se podra ver la solicitudes de adquisición que pertenecen a esa unidad administrativa";
        $permiso3->url = "/SolicitudesDeAdquisicionAdmin";
        $permiso3->save();
        $permiso4 = new Permission();
        $permiso4->namePermission ="Enviar el correo de contización";
        $permiso4->description = "Puede enviar el correo para cotizar la solicitud";
        $permiso4->url = "/EnviarCotizacion";
        $permiso4->save();
        $permiso5 = new Permission();
        $permiso5->namePermission ="Ver el detalle la solicitud de contización";
        $permiso5->description = "Puede ver a detalle la solicitud de adquisición";
        $permiso5->url = "/DetalleSolicitud/:id";
        $permiso5->save();
        $permiso6 = new Permission();
        $permiso6->namePermission ="Todo sobre monte límite";
        $permiso6->description = "Puede ver los montos límites definidos, y poder actualizarlo";
        $permiso6->url = "/montoLimite";
        $permiso6->save();

        $permiso7 = new Permission();
        $permiso7->namePermission ="Registro de empresas";
        $permiso7->description = "Puede ver la lista de empresas y registrar nuevas empresas";
        $permiso7->url = "/empresas";
        $permiso7->save();

        //Unidad de proveedor AAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
        $permiso14 = new Permission();
        $permiso14 ->namePermission = "Ver las solicitudes de adquisición";
        $permiso14->description = "Se podra ver la solicitudes de adquisición que pertenecen a esa unidad administrativa";
        $permiso14->url = "/SolicitudesDeAdquisicionAdmin";
        $permiso14->save();
        $permiso15 = new Permission();
        $permiso15->namePermission ="Enviar el correo de contización";
        $permiso15->description = "Puede enviar el correo para cotizar la solicitud";
        $permiso15->url = "/EnviarCotizacion";
        $permiso15->save();
        $permiso16 = new Permission();
        $permiso16->namePermission ="Ver el detalle la solicitud de contización";
        $permiso16->description = "Puede ver a detalle la solicitud de adquisición";
        $permiso16->url = "/DetalleSolicitud/:id";
        $permiso16->save();

        //administrador del sistema
        $permiso8 = new Permission();
        $permiso8->namePermission ="Registrar unidades administrativas";
        $permiso8->description = "Puede ver las unidades administrativas y resgistrar nuevas unidades administrativas";
        $permiso8->url = "/UnidadesAdministrativas";
        $permiso8->save();
        $permiso9 = new Permission();
        $permiso9->namePermission ="Registrar unidades de gasto";
        $permiso9->description = "Registrar nuevas unidades de gasto";
        $permiso9->url = "/unidadesDeGasto";
        $permiso9->save();
        $permiso10 = new Permission();
        $permiso10->namePermission ="Registrar usuarios";
        $permiso10->description = "Registrar nuevos usuarios";
        $permiso10->url = "/user";
        $permiso10->save();
        $permiso11 = new Permission();
        $permiso11->namePermission ="Administar roles";
        $permiso11->description = "Puede ver los roles existentes y registrar nuevos roles";
        $permiso11->url = "/roles";
        $permiso11->save();
        $permiso12 = new Permission();
        $permiso12->namePermission ="Ver Personal";
        $permiso12->description = "Puede ver los roles existentes y registrar nuevos roles";
        $permiso12->url = "/personal";
        $permiso12->save();
        
        $permiso13 = new Permission();
        $permiso13->namePermission ="Agregar Respuesta";
        $permiso13->description = "Se puede agregar respuestas de contizacion desde unidad 33cmxfnPK administrariva";
        $permiso13->url = "/SolicitudesDeAdquisicion";
        $permiso13->save();

        
    }
}
