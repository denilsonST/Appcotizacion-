<?php

use Illuminate\Database\Seeder;
use App\AdministrativeUnit;
class AdministrativeUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $AdministrativeUnit = new AdministrativeUnit();
        $AdministrativeUnit->name="administracion de tecnologia";
        $AdministrativeUnit->faculties_id="1";
        $AdministrativeUnit->save();

        $AdministrativeUnit2 = new AdministrativeUnit();
        $AdministrativeUnit2->name="administracion de derecho";
        $AdministrativeUnit2->faculties_id="2";
        $AdministrativeUnit2->save();

        $AdministrativeUnit3 = new AdministrativeUnit();
        $AdministrativeUnit3->name="administracion de economia";
        $AdministrativeUnit3->faculties_id="3";
        $AdministrativeUnit3->save();

        $AdministrativeUnit4 = new AdministrativeUnit();
        $AdministrativeUnit4->name="administracion de humanidades";
        $AdministrativeUnit4->faculties_id="4";
        $AdministrativeUnit4->save();
    }
}
