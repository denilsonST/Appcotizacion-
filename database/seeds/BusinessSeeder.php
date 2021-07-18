<?php

use Illuminate\Database\Seeder;
use App\Business;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Business = new Business();
        $Business->nameEmpresa="Smart Cube";
        $Business->nit="12345678";
        $Business->email="smartcube@gmail.com";
        $Business->phone="75981698";
        $Business->direction="super Mall,Av. Banco Galindo";
        $Business->rubro="Venta de equipos informaticos";
        $Business->save();

        $Business = new Business();
        $Business->nameEmpresa="Soft Computers";
        $Business->nit="12222254";
        $Business->email="softComputers@gmail.com";
        $Business->phone="7598555";
        $Business->direction="Av. Ayacucho #218";
        $Business->rubro="Venta de equipos informaticos";
        $Business->save();

        $Business = new Business();
        $Business->nameEmpresa="Shopping PC";
        $Business->nit="12333111";
        $Business->email="shoppingpc@gmail.com";
        $Business->phone="75557474";
        $Business->direction="Av. Ayacucho #7232 edificio Gold Center";
        $Business->rubro="Venta de equipos informaticos";
        $Business->save();

        $Business = new Business();
        $Business->nameEmpresa="Jose Villarrubia Romero";
        $Business->nit="12458791";
        $Business->email="villarroel@gmail.com";
        $Business->phone="4241511";
        $Business->direction="C. Trinitaria #2026";
        $Business->rubro="Importacion y venta de libros";
        $Business->save();

        $Business = new Business();
        $Business->nameEmpresa="Universal Books";
        $Business->nit="12387931";
        $Business->email="universalbooks@gmail.com";
        $Business->phone="4509306";
        $Business->direction="Calle Pasteur #274";
        $Business->rubro="Venta de libros";
        $Business->save();

        $Business = new Business();
        $Business->nameEmpresa="Distribuidora Bis";
        $Business->nit="12385551";
        $Business->email="distribuidorabis@gmail.com";
        $Business->phone="4512557";
        $Business->direction="C. Ladislao Cabrera Ed. Roghur";
        $Business->rubro="Venta y distribucion de libros y material didactico";
        $Business->save();

        $Business = new Business();
        $Business->nameEmpresa="Encantalibros";
        $Business->nit="12385888";
        $Business->email="encantalibros@gmail.com";
        $Business->phone="4375806";
        $Business->direction="C. Colombia entre Aurelio Melean y Julio Arauco";
        $Business->rubro="Venta y distribucion de libros";
        $Business->save();

        $Business = new Business();
        $Business->nameEmpresa="Milcar Srl.";
        $Business->nit="14785412";
        $Business->email="ventas@micar.com.bo";
        $Business->phone="4718752";
        $Business->direction="C. Jacaranda #153 entre Av. Villazon y Av. tercera";
        $Business->rubro="Venta de material de oficina";
        $Business->save();

        $Business = new Business();
        $Business->nameEmpresa="Libreria Josue";
        $Business->nit="17849351";
        $Business->email="libreriajosue19@gmail.com";
        $Business->phone="63864457";
        $Business->direction="Av. America entre Gabriel Rene Moreno y Enrique Finot";
        $Business->rubro="Venta de material de oficina, libreria";
        $Business->save();

        $Business = new Business();
        $Business->nameEmpresa="Muebles Sauce";
        $Business->nit="17478741";
        $Business->email="mueblessauce3@gmail.com";
        $Business->phone="73822483";
        $Business->direction="Av. Dorbigno esquina Madrid";
        $Business->rubro="Venta y fabrica de muebles";
        $Business->save();

        $Business = new Business();
        $Business->nameEmpresa="Muebles Santiago";
        $Business->nit="17849999";
        $Business->email="marketing@muebles-santiago.com.bo";
        $Business->phone="71720581";
        $Business->direction="Av. Ayacucho";
        $Business->rubro="Venta y fabrica de muebles";
        $Business->save();

        $Business = new Business();
        $Business->nameEmpresa="Muebles LaFuente";
        $Business->nit="17848899";
        $Business->email="301280Oeliasg@gmail.com";
        $Business->phone="76933144";
        $Business->direction="Zona Molle Molle Tiquipaya";
        $Business->rubro="Venta y fabrica de muebles";
        $Business->save();
    }
}
