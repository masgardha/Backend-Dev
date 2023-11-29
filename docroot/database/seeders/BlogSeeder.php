<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run()
    {
        Blog::create([
            'title' => 'Judul Blog 1',
            'description' => 'Deskripsi Blog 1',
            'image' => 'gambar1.jpg',
        ]);

        Blog::create([
            'title' => 'Judul Blog 2',
            'description' => 'Deskripsi Blog 2 asdamsdklasj askdjak jdlaksjdaksjdkalsdassdas asd ',
            'image' => 'gambar2.jpg',
        ]);
    }
}