<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class Categoryseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'category_name' => 'HTML',
            'category_slug' => 'html'
        ]);

        Category::create([
            'category_name' => 'CSS',
            'category_slug' => 'css' 
        ]);

        Category::create([
            'category_name' => 'JS', 
            'category_slug' => 'js'
        ]);
    }
}
