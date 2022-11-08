<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $pages = ['Hakkımızda','Kariyer','Vizyonumuz','Misyonumuz'];
      $count = 0;
      foreach ($pages as $page) {
        $count++;
          DB::table('pages')->insert([
              'title' => $page,
              'image' => 'https://www.incimages.com/uploaded_files/image/1920x1080/getty_180152187_970679970450042_64007.jpg',
              'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
              'slug' => Str::slug($page),
              'order' => $count,
              'created_at' => now(),
              'updated_at' => now(),
          ]);

    }
}
}
