<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Category 01', 'Category 02', 'Category 03', 'Category 04', 'Category 05', 'Category 06'];
        foreach ($data as $key => $value) {
            Category::updateOrCreate(['title' => $value]);
        }
    }
}