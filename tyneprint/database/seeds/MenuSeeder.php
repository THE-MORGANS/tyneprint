<?php

use Illuminate\Database\Seeder;
use App\Menu;
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $menu = [
            ['name' => 'Home', ],
            ['name' => 'Blog'],
            ['name' => 'About Us'],
            ['name' => 'Contact Us'],
            ['name' => 'How it Works'],
            ['name' => 'Get Price Qoute'],
            ['name' => 'Logo Design']
        ];

        foreach($menu as $menu){
            Menu::create($menu);
        }
    }
}