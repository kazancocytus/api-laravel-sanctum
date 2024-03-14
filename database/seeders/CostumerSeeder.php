<?php

namespace Database\Seeders;

use App\Models\Costumer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class CostumerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Costumer::factory()
                ->count(15)
                ->hasInvoices(10)
                ->create();

        Costumer::factory()
                ->count(20)
                ->hasInvoices(7)
                ->create();

        Costumer::factory()
                ->count(25)
                ->hasInvoices(5)
                ->create();

        Costumer::factory()
                ->count(5)
                ->create();
    }
}
