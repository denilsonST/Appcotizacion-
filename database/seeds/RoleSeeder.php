<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->nameRol = "Jefe de unidad de gasto";
        $role->description = "Puede asignar personal a su unidad, realizar y ver las solicitudes";
        $role->save();
        $role->permissions()->attach([1,2,12]);

        $role2 = new Role();
        $role2->nameRol = "Jefe de unidad administrativa";
        $role2->description = "Puede asignar personal a su unidad, actualizar monto limite, ver las solicitudes, emitir informes, realizar cotizaciones y cuadros comparativos";
        $role2->save();
        $role2->permissions()->attach([3,4,5,6,7,12,13]);

        $role3 = new Role();
        $role3->nameRol = "Administrador del Sistema";
        $role3->description = "Puede registrar usuarios, roles y asignar jefes a las unidades de gasto y administrativas";
        $role3->save();
        $role3->permissions()->attach([8,9,10,11]);

        $role4 = new Role();
        $role4->nameRol = "Solicitador";
        $role4->description = "Puede asignar personal a su unidad, actualizar monto limite, ver las solicitudes, emitir informes, realizar cotizaciones y cuadros comparativos";
        $role4->save();
        $role4->permissions()->attach([1,2]);

       //ROL de PROVEEDOR 
        $role5 = new Role();
        $role5->nameRol = "Cotizador";
        $role5->description = "Puede registrar usuarios, roles y asignar jefes a las unidades de gasto y administrativas";
        $role5->save();
        $role5->permissions()->attach([3,4,5,7]);

    }
}
