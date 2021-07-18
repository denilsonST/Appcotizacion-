<?php

use Illuminate\Database\Seeder;
use App\RequestDetail;

class RequestDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Requestdetail = new RequestDetail();
        $Requestdetail->amount=3;
        $Requestdetail->unitMeasure="unidades";
        $Requestdetail->description="gabinetes de datos del servidor de re de montaje de pared, estante de vidrio puerta";
        $Requestdetail->request_quotitations_id=1;
        $Requestdetail->save();

        $Requestdetail = new RequestDetail();
        $Requestdetail->amount=3;
        $Requestdetail->unitMeasure="unidades";
        $Requestdetail->description="switch de 16 puertos";
        $Requestdetail->request_quotitations_id=1;
        $Requestdetail->save();

        $Requestdetail = new RequestDetail();
        $Requestdetail->amount=120;
        $Requestdetail->unitMeasure="mts";
        $Requestdetail->description="cable de red UTP categoria 5";
        $Requestdetail->request_quotitations_id=1;
        $Requestdetail->save();

        $Requestdetail = new RequestDetail();
        $Requestdetail->amount=3;
        $Requestdetail->unitMeasure="unidades";
        $Requestdetail->description="organizadores de cable";
        $Requestdetail->request_quotitations_id=1;
        $Requestdetail->save();

        $Requestdetail2 = new RequestDetail();
        $Requestdetail2->amount=50;
        $Requestdetail2->unitMeasure="unidades";
        $Requestdetail2->description="gabinetes de escritorio";
        $Requestdetail2->request_quotitations_id=2;
        $Requestdetail2->save();

        $Requestdetail2 = new RequestDetail();
        $Requestdetail2->amount=20;
        $Requestdetail2->unitMeasure="paquetes";
        $Requestdetail2->description="hojas bond tamaño carta";
        $Requestdetail2->request_quotitations_id=2;
        $Requestdetail2->save();

        $Requestdetail2 = new RequestDetail();
        $Requestdetail2->amount=5;
        $Requestdetail2->unitMeasure="unidades";
        $Requestdetail2->description="estanterías divisorias y perimetrales de 1,30 m de altura dispuestas de manera de
        encontrarse en forma frontal con el libro";
        $Requestdetail2->request_quotitations_id=2;
        $Requestdetail2->save();

        $Requestdetail3 = new RequestDetail();
        $Requestdetail3->amount=8;
        $Requestdetail3->unitMeasure="unidades";
        $Requestdetail3->description="estanterías divisorias y perimetrales de 1,30 m de altura dispuestas de manera de
        encontrarse en forma frontal con el libro";
        $Requestdetail3->request_quotitations_id=3;
        $Requestdetail3->save();

        $Requestdetail3 = new RequestDetail();
        $Requestdetail3->amount=15;
        $Requestdetail3->unitMeasure="paquetes";
        $Requestdetail3->description="hojas bond tamaño carta";
        $Requestdetail3->request_quotitations_id=3;
        $Requestdetail3->save();

        $Requestdetail3 = new RequestDetail();
        $Requestdetail3->amount=10;
        $Requestdetail3->unitMeasure="paquetes";
        $Requestdetail3->description="Pinzas sujetapapeles abatibles de 19 mm";
        $Requestdetail3->request_quotitations_id=3;
        $Requestdetail3->save();

        $Requestdetail4 = new RequestDetail();
        $Requestdetail4->amount=3;
        $Requestdetail4->unitMeasure="unidades";
        $Requestdetail4->description="PC Lenovo Think Centre Modelo M720 Core I5-8400 de 1T 2g TWR DOS";
        $Requestdetail4->request_quotitations_id=4;
        $Requestdetail4->save();

        $Requestdetail5 = new RequestDetail();
        $Requestdetail5->amount=15;
        $Requestdetail5->unitMeasure="unidades";
        $Requestdetail5->description="libro Economia, teoria y politica, autor Francisco Mochon Morcillo";
        $Requestdetail5->request_quotitations_id=5;
        $Requestdetail5->save();

        $Requestdetail5 = new RequestDetail();
        $Requestdetail5->amount=20;
        $Requestdetail5->unitMeasure="unidades";
        $Requestdetail5->description="libro La economia del bien comun, Jean Tirole";
        $Requestdetail5->request_quotitations_id=5;
        $Requestdetail5->save();

        $Requestdetail5 = new RequestDetail();
        $Requestdetail5->amount=25;
        $Requestdetail5->unitMeasure="unidades";
        $Requestdetail5->description="libro Economia basica, Thomas Sowell";
        $Requestdetail5->request_quotitations_id=5;
        $Requestdetail5->save();

        $Requestdetail6 = new RequestDetail();
        $Requestdetail6->amount=2;
        $Requestdetail6->unitMeasure="unidades";
        $Requestdetail6->description="PC Lenovo Think Centre Modelo M720 Core I5-8400 de 1T 2g TWR DOS";
        $Requestdetail6->request_quotitations_id=6;
        $Requestdetail6->save();

        $Requestdetail6 = new RequestDetail();
        $Requestdetail6->amount=2;
        $Requestdetail6->unitMeasure="unidades";
        $Requestdetail6->description="Machine learning y Deep learning, autor Jesus Bobadilla";
        $Requestdetail6->request_quotitations_id=6;
        $Requestdetail6->save();

        $Requestdetail6 = new RequestDetail();
        $Requestdetail6->amount=3;
        $Requestdetail6->unitMeasure="unidades";
        $Requestdetail6->description="libro Internet de las cosas, autor Manel Lopez";
        $Requestdetail6->request_quotitations_id=6;
        $Requestdetail6->save();

        $Requestdetail7 = new RequestDetail();
        $Requestdetail7->amount=4;
        $Requestdetail7->unitMeasure="unidades";
        $Requestdetail7->description="PC Lenovo Think Centre Modelo M720 Core I5-8400 de 1T 2g TWR DOS";
        $Requestdetail7->request_quotitations_id=7;
        $Requestdetail7->save();

        $Requestdetail8 = new RequestDetail();
        $Requestdetail8->amount=4;
        $Requestdetail8->unitMeasure="unidades";
        $Requestdetail8->description="Escritorio Mesa Para Pc 75x45x77 Cm Notebook Bandeja";
        $Requestdetail8->request_quotitations_id=8;
        $Requestdetail8->save();

        $Requestdetail8 = new RequestDetail();
        $Requestdetail8->amount=30;
        $Requestdetail8->unitMeasure="mts";
        $Requestdetail8->description="cable de red UTP categoria 5";
        $Requestdetail8->request_quotitations_id=8;
        $Requestdetail8->save();
    }
}
