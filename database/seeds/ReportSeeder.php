<?php

use Illuminate\Database\Seeder;
use App\Report;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Report = new Report();
        $Report->description="se acepto la solicitud de los materiales para el laboratorio de informatica";
        $Report->dateReport="2021-02-01";
        $Report->administrative_username="Jennifer Rojas";
        $Report->request_quotitations_id=1;
        $Report->save();

        $Report2 = new Report();
        $Report2->description="se acepto la solicitud de los materiales para la biblioteca de economia";
        $Report2->dateReport="2021-02-05";
        $Report2->administrative_username="Jennifer Rojas";
        $Report2->request_quotitations_id=2;
        $Report2->save();

        $Report3 = new Report();
        $Report3->description="se acepto la solicitud de los materiales para la biblioteca de tecnologia";
        $Report3->dateReport="2021-02-16";
        $Report3->administrative_username="Jennifer Rojas";
        $Report3->request_quotitations_id=3;
        $Report3->save();

        $Report4 = new Report();
        $Report4->description="se rechazo la solicitud de materiales del laboratorio de informatica por que exedio el monto limite";
        $Report4->dateReport="2021-04-16";
        $Report4->administrative_username="Daniela Montecinos";
        $Report4->request_quotitations_id=4;
        $Report4->save();

        $Report5 = new Report();
        $Report5->description="se rechazo la solicitud de materiales de la biblioteca de economia por que exedio el monto limite";
        $Report5->dateReport="2021-04-27";
        $Report5->administrative_username="Daniela Montecinos";
        $Report5->request_quotitations_id=5;
        $Report5->save();

        $Report6 = new Report();
        $Report6->description="se rechazo la solicitud de materiales de la biblioteca de tecnologia por que exedio el monto limite";
        $Report6->dateReport="2021-04-27";
        $Report6->administrative_username="Daniela Montecinos";
        $Report6->request_quotitations_id=6;
        $Report6->save();

    }
}
