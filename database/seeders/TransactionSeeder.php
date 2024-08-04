<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $year = 2024;
        $startDate = Carbon::createFromDate($year,1,1);
        $endDate = Carbon::createFromDate($year,12,31);

        while($startDate->lte($endDate)){
            Transaction::create([
               'amount' => 0.00,
                'date' => $startDate->toDateString(),
                'description' => '', // Descrizione iniziale vuota 
            ]);
            $startDate->addDay();
        }
    }
}
