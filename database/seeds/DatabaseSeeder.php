<?php

// use Database\Seeder\SupplierSeeder;
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
        $this->call([
            SupplierSeeder::class,
            CustomerSeeder::class
        ]);
    }
}
