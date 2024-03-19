<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            ['title' => 'html', 'slug' => 'html'],
            ['title' => 'javascript', 'slug' => 'javascript'],
            ['title' => 'css', 'slug' => 'css'],
            ['title' => 'MySQL', 'slug' => 'MySQL'],
            ['title' => 'java', 'slug' => 'java'],
        ])->each(fn($category) => Category::create($category));


        // Category::create(
        //     ['title' => 'html', 'slug' => 'html'], hanya data html yang masuk ke database
        //     ['title' => 'javascript', 'slug' => 'javascript'],
        //     ['title' => 'css', 'slug' => 'css'],
        //     ['title' => 'MySQL', 'slug' => 'MySQL'],
        //     ['title' => 'java', 'slug' => 'java'],
        // );
    }
}
