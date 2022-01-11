<?php

use Illuminate\Database\Seeder;
use App\Category; 

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([      
            'name' => '学業',
        ]);                     
        Category::create([      
            'name' => '就職',   
        ]);                     
        Category::create([      
            'name' => '環境',
        ]);                     
        Category::create([      
            'name' => 'その他', 
        ]);                 
    }
}
