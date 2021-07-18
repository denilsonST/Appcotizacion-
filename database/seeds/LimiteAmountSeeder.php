<?php

use Illuminate\Database\Seeder;
use App\LimiteAmount;

class LimiteAmountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $LimiteAmount= new LimiteAmount();
        $LimiteAmount->monto=10000;
        $LimiteAmount->starDate="2021-01-01";
        $LimiteAmount->steps="2021";
        $LimiteAmount->administrative_units_id=1;
        $LimiteAmount->save();

        $LimiteAmount2= new LimiteAmount();
        $LimiteAmount2->monto=11000;
        $LimiteAmount2->starDate="2021-01-01";
        $LimiteAmount2->steps="2021";
        $LimiteAmount2->administrative_units_id=3;
        $LimiteAmount2->save();

        $LimiteAmount3= new LimiteAmount();
        $LimiteAmount3->monto=13000;
        $LimiteAmount3->starDate="2021-03-01";
        $LimiteAmount3->steps="2021";
        $LimiteAmount3->administrative_units_id=1;
        $LimiteAmount3->save();

        $LimiteAmount5= new LimiteAmount();
        $LimiteAmount5->monto=20000;
        $LimiteAmount5->starDate="2021-05-01";
        $LimiteAmount5->steps="2021";
        $LimiteAmount5->administrative_units_id=1;
        $LimiteAmount5->save();
    }
}
