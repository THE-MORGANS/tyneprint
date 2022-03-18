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
        $category = [
            ['name' => 'Banners & Large Format'],
            ['name' => 'Branded Envelopes'],
            ['name' => 'Branded Notepads and Jotters'],
            ['name' => 'Business Cards'],
            ['name' => 'Calendar'],
            ['name' => 'Caps & Hats'],
            ['name' => 'Corporate Gifts']
        ];

        foreach($category as $cat){
            Category::create($cat);
        }
    }
}
