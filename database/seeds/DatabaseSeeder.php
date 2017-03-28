<?php

use App\Models\HomePage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HomePage::create([
            'title' => 'About Us',
            'slug' => 'about-us',
            'snippet' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'detail' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'image_public_path' => '/storage/images/blank_4x3.png',
        ]);

        HomePage::create([
            'title' => 'Brothers',
            'slug' => 'brothers',
            'snippet' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'detail' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'image_public_path' => '/storage/images/blank_4x3.png',
        ]);

        HomePage::create([
            'title' => 'Philanthropy',
            'slug' => 'philanthropy',
            'snippet' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'detail' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'image_public_path' => '/storage/images/blank_4x3.png',
        ]);

        HomePage::create([
            'title' => 'Pledging',
            'slug' => 'pledging',
            'snippet' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'detail' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'image_public_path' => '/storage/images/blank_4x3.png',
        ]);
    }
}
