<?php

use Illuminate\Database\Seeder;
use App\RequestQuotitation;

class RequestQuotationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $RequestQuotation = new RequestQuotitation();
        $RequestQuotation->nameUnidadGasto="laboratorios de informatica";
        $RequestQuotation->aplicantName="Ricardo Martinez";
        $RequestQuotation->requestDate="2021-01-25";
        $RequestQuotation->amount="9000";
        $RequestQuotation->status="Aceptado";
        $RequestQuotation->statusResponse="En proceso";
        $RequestQuotation->spending_units_id=1;
        $RequestQuotation->administrative_unit_id=1;
        $RequestQuotation->limiteId=1;
        $RequestQuotation->save();

        $RequestQuotation2 = new RequestQuotitation();
        $RequestQuotation2->nameUnidadGasto="biblioteca de economia";
        $RequestQuotation2->aplicantName="Nicole Mejia";
        $RequestQuotation2->requestDate="2021-01-29";
        $RequestQuotation2->amount="9000";
        $RequestQuotation2->status="Aceptado";
        $RequestQuotation2->statusResponse="En proceso";
        $RequestQuotation2->spending_units_id=2;
        $RequestQuotation2->administrative_unit_id=3;
        $RequestQuotation2->limiteId=1;
        $RequestQuotation2->save();

        $RequestQuotation3 = new RequestQuotitation();
        $RequestQuotation3->nameUnidadGasto="biblioteca de tecnologia";
        $RequestQuotation3->aplicantName="Juan Carlos Rosas";
        $RequestQuotation3->requestDate="2021-02-15";
        $RequestQuotation3->amount="9000";
        $RequestQuotation3->status="Aceptado";
        $RequestQuotation3->statusResponse="En proceso";
        $RequestQuotation3->spending_units_id=3;
        $RequestQuotation3->administrative_unit_id=1;
        $RequestQuotation3->limiteId=1;
        $RequestQuotation3->save();

        $RequestQuotation4 = new RequestQuotitation();
        $RequestQuotation4->nameUnidadGasto="laboratorios de informatica";
        $RequestQuotation4->aplicantName="Ricardo Martinez";
        $RequestQuotation4->requestDate="2021-04-15";
        $RequestQuotation4->amount="16608";
        $RequestQuotation4->status="Rechazado";
        $RequestQuotation4->statusResponse="Denegado";
        $RequestQuotation4->spending_units_id=1;
        $RequestQuotation4->administrative_unit_id=1;
        $RequestQuotation4->limiteId=3;
        $RequestQuotation4->save();

        $RequestQuotation5 = new RequestQuotitation();
        $RequestQuotation5->nameUnidadGasto="biblioteca de economia";
        $RequestQuotation5->aplicantName="Nicole Mejia";
        $RequestQuotation5->requestDate="2021-04-26";
        $RequestQuotation5->amount="15000";
        $RequestQuotation5->status="Rechazado";
        $RequestQuotation5->statusResponse="Denegado";
        $RequestQuotation5->spending_units_id=2;
        $RequestQuotation5->administrative_unit_id=3;
        $RequestQuotation5->limiteId=3;
        $RequestQuotation5->save();

        $RequestQuotation6 = new RequestQuotitation();
        $RequestQuotation6->nameUnidadGasto="biblioteca de tecnologia";
        $RequestQuotation6->aplicantName="Juan Carlos Rosas";
        $RequestQuotation6->requestDate="2021-04-26";
        $RequestQuotation6->amount="14500";
        $RequestQuotation6->status="Rechazado";
        $RequestQuotation6->statusResponse="Denegado";
        $RequestQuotation6->spending_units_id=3;
        $RequestQuotation6->administrative_unit_id=1;
        $RequestQuotation6->limiteId=3;
        $RequestQuotation6->save();

        $RequestQuotation7 = new RequestQuotitation();
        $RequestQuotation7->nameUnidadGasto="laboratorios de informatica";
        $RequestQuotation7->aplicantName="Ricardo Martinez";
        $RequestQuotation7->requestDate="2021-05-01";
        $RequestQuotation7->amount="21200";
        $RequestQuotation7->status="Pendiente";
        $RequestQuotation7->statusResponse="Pendiente";
        $RequestQuotation7->spending_units_id=1;
        $RequestQuotation7->administrative_unit_id=1;
        $RequestQuotation7->limiteId=4;
        $RequestQuotation7->save();

        $RequestQuotation8 = new RequestQuotitation();
        $RequestQuotation8->nameUnidadGasto="laboratorios de informatica";
        $RequestQuotation8->aplicantName="Ricardo Martinez";
        $RequestQuotation8->requestDate="2021-05-09";
        $RequestQuotation8->amount="19500";
        $RequestQuotation8->status="Pendiente";
        $RequestQuotation8->statusResponse="Pendiente";
        $RequestQuotation8->spending_units_id=1;
        $RequestQuotation8->administrative_unit_id=1;
        $RequestQuotation8->limiteId=4;
        $RequestQuotation8->save();
    }
}
