<?php

namespace Database\Seeders;

use App\Models\Plans;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = Plans::firstOrNew(['identifier' => 'monthly']);
        $plans->title = 'Monthly Plan';
        $plans->identifier = 'monthly';
        $plans->stripe_id = 'price_1JWwQNSI6MP5YwmF6Of36K7k';
        $plans->save();

        $plans = Plans::firstOrNew(['identifier' => 'trial']);
        $plans->title = 'Trial Plan';
        $plans->identifier = 'trial';
        $plans->stripe_id = 'price_1JWzkuSI6MP5YwmFi3st4AeB';
        $plans->save();
    }
}
