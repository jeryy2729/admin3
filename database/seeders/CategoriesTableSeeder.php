<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                $categories = [
            [
                'name' => 'Fictional',
                'description' => 'Explore imaginative narratives and gripping storytelling from world-renowned authors.',
                'image' => 'uploads/categories/fiction.jpg',
            ],
            [
                'name' => 'Non-Fictional',
                'description' => 'Dive into factual books covering history, biographies, politics, and real-world experiences.',
                'image' => 'uploads/categories/non-fiction.jpg',
            ],
        //     [
        //         'name' => 'Science & Technology',
        //         'description' => 'Books that explain the wonders of science, discoveries, and technological innovations.',
        //         'image' => 'uploads/categories/science.jpg',
        //     ],
        //     [
        //         'name' => 'Romance',
        //         'description' => 'Feel the love, heartbreak, and passion in romantic novels from classics to modern love stories.',
        //         'image' => 'uploads/categories/romance.jpg',
        //     ],
        //     [
        //         'name' => 'Self Help',
        //         'description' => 'Empower yourself with motivational and self-improvement books.',
        //         'image' => 'uploads/categories/self-help.jpg',
        //     ],
        //     [
        //         'name' => 'Children',
        //         'description' => 'Fun, educational, and inspiring books curated specially for young readers.',
        //         'image' => 'uploads/categories/children.jpg',
        //     ],
        //     [
        //         'name' => 'Horror',
        //         'description' => 'Spine-chilling stories, thrillers, and supernatural tales for brave readers.',
        //         'image' => 'uploads/categories/horror.jpg',
        //     ],
        //     [
        //         'name' => 'Mystery & Thriller',
        //         'description' => 'Solve crimes, uncover secrets, and get lost in suspenseful plots.',
        //         'image' => 'uploads/categories/mystery.jpg',
        //     ],
        //     [
        //         'name' => 'Comics & Manga',
        //         'description' => 'Visual storytelling with action-packed comics and manga from around the globe.',
        //         'image' => 'uploads/categories/comics.jpg',
        //     ],
        //     [
        //         'name' => 'Poetry',
        //         'description' => 'Expressions of emotions and beauty through rhythm and verse.',
        //         'image' => 'uploads/categories/poetry.jpg',
        //     ],
         ];

        foreach ($categories as $data) {
            Category::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'description' => $data['description'],
                'image' => $data['image'],
                'status' => 1
            ]);
        }
    }
}
