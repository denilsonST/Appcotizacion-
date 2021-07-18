<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //usuario administrador del sistema
        $user = new User();
        $user->name = "admin";
        $user->lastName="sistema";
        $user->phone="64906868";
        $user->direction="Sacaba Cochabamba";
        $user->ci="66523250";
        $user->email="admin@gmail.com";
        $user->userName="admin";
        $user->password=bcrypt("admin");
        $user->save();
        $user->roles()->attach(3);

        //jefe de la unidad administrativa 1
        $user = new User();
        $user->name = "Jennifer";
        $user->lastName="Rojas";
        $user->phone="7412589";
        $user->direction="Av Beijing y Blanco Galindo";
        $user->ci="63445671";
        $user->email="jenny123@gmail.com";
        $user->userName="jenny";
        $user->password=bcrypt("jenny");
        $user->save();
        $user->roles()->attach(2,['administrative_unit_id'=>1,'administrative_unit_status'=>1]);

        //jefe de la unidad proveedor AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
        $user = new User();
        $user->name = "Denilson";
        $user->lastName="Teran";
        $user->phone="68475272";
        $user->direction="Av Petrolera";
        $user->ci="9357833";
        $user->email="denilson123@gmail.com";
        $user->userName="denilson";
        $user->password=bcrypt("denilson");
        $user->save();
        $user->roles()->attach(5,['administrative_unit_id'=>1,'administrative_unit_status'=>1]); //2 - 5 

        //jefe de la unidad de gasto 1
        $user = new User();
        $user->name = "Ricardo";
        $user->lastName="Martinez";
        $user->phone="7784595";
        $user->direction="Calle Sucre y Oquendo";
        $user->ci="72345672";
        $user->email="ricardo78@gmail.com";
        $user->userName="ricardo";
        $user->password=bcrypt("ricardo");
        $user->save();
        $user->roles()->attach(1,['spending_unit_id'=>1,'spending_unit_status'=>1]);

        //jefe de la unidad administrativa 2
        $user = new User();
        $user->name = "Daniela";
        $user->lastName="Montecinos";
        $user->phone="67522254";
        $user->direction="Avenida Panamericana";
        $user->ci="62345673";
        $user->email="dani987@gmail.com";
        $user->userName="daniela";
        $user->password=bcrypt("daniela");
        $user->save();
        $user->roles()->attach(2,['administrative_unit_id'=>3,'administrative_unit_status'=>1]);

        //jefe de la unidad de gasto 2
        $user = new User();
        $user->name = "Nicole";
        $user->lastName="Mejia";
        $user->phone="7741471";
        $user->direction="Avenida Blanco Galindo km 8";
        $user->ci="12345674";
        $user->email="nicole45@gmail.com";
        $user->userName="nicol";
        $user->password=bcrypt("nicol");
        $user->save();
        $user->roles()->attach(1,['spending_unit_id'=>2,'spending_unit_status'=>1]);

         //jefe de la unidad de gasto 3
         $user = new User();
         $user->name = "Juan Carlos";
         $user->lastName="Rosas";
         $user->phone="70886471";
         $user->direction="Avenida Peru y Tadeo Haenke";
         $user->ci="8126788";
         $user->email="juan10@gmail.com";
         $user->userName="juan";
         $user->password=bcrypt("juan");
         $user->save();
         $user->roles()->attach(1,['spending_unit_id'=>3,'spending_unit_status'=>1]);
 
        //usuario con rol jefe de uniadad administrativa sin unidad
        $user = new User();
        $user->name = "Diego";
        $user->lastName="Vargas";
        $user->phone="64376328";
        $user->direction="Avenida Ustariz km 4";
        $user->ci="11511253";
        $user->email="diegov@gmail.com";
        $user->userName="diego";
        $user->password=bcrypt("diego");
        $user->save();
        $user->roles()->attach(2,['administrative_unit_id'=>4,'administrative_unit_status'=>1]);

        //usuario con rol jefe de unidad de gasto sin unidad
        $user = new User();
        $user->name = "Valeria";
        $user->lastName="Zurita";
        $user->phone="68387798";
        $user->direction="Sacaba";
        $user->ci="16123453";
        $user->email="valeria12@gmail.com";
        $user->userName="valeria";
        $user->password=bcrypt("valeria");
        $user->save();
        $user->roles()->attach(1,['spending_unit_id'=>4,'spending_unit_status'=>1]);
    
        //usuario sin rol
        $user = new User();
        $user->name = "Camila";
        $user->lastName="Sanchez";
        $user->phone="70382312";
        $user->direction="Avenida Tadeo Haenke y America";
        $user->ci="16511253";
        $user->email="camila37@gmail.com";
        $user->userName="camila";
        $user->password=bcrypt("camila");
        $user->save();

        //usuario sin rol
        $user = new User();
        $user->name = "Renato";
        $user->lastName="Orellana";
        $user->phone="68637728";
        $user->direction="Avenida Circunvalacion km 3";
        $user->ci="8064853";
        $user->email="renato90@gmail.com";
        $user->userName="renato";
        $user->password=bcrypt("renato");
        $user->save();
    }
}
