<?php

use App\AdministrativeUnit;
use App\RequestDetail;
use App\RequestQuotitation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FacultySeeder::class);
        $this->call(AdministrativeUnitSeeder::class);
        $this->call(SpendingUnitSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(LimiteAmountSeeder::class);
        $this->call(RequestQuotationSeeder::class);
        $this->call(RequestDetailSeeder::class);
        $this->call(ReportSeeder::class);
        $this->call(BusinessSeeder::class);
    }
}
