<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category; // ✅ Add this line

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiction', 'description' => 'Fictional books of all genres', 'status' => 1],
            ['name' => 'Non-Fiction', 'description' => 'Real stories and facts', 'status' => 1],
            ['name' => 'Science', 'description' => 'Books related to science and experiments', 'status' => 1],
            ['name' => 'Technology', 'description' => 'Latest tech and gadgets info', 'status' => 1],
            ['name' => 'Biography', 'description' => 'Life stories of famous personalities', 'status' => 1],
            ['name' => 'History', 'description' => 'Historical books and world events', 'status' => 1],
            ['name' => 'Art', 'description' => 'Art and creativity books', 'status' => 1],
            ['name' => 'Travel', 'description' => 'Books for travel lovers', 'status' => 0],
            ['name' => 'Children', 'description' => 'Books for children and toddlers', 'status' => 1],
            ['name' => 'Fantasy', 'description' => 'Fantasy and magical stories', 'status' => 1],
            ['name' => 'Horror', 'description' => 'Spooky and scary books', 'status' => 1],
            ['name' => 'Romance', 'description' => 'Love and romance stories', 'status' => 1],
            ['name' => 'Poetry', 'description' => 'Collection of poems and verses', 'status' => 1],
            ['name' => 'Health', 'description' => 'Books about health and wellness', 'status' => 1],
            ['name' => 'Cooking', 'description' => 'Recipe books and cooking tips', 'status' => 1],
            ['name' => 'Education', 'description' => 'Academic and educational books', 'status' => 1],
            ['name' => 'Business', 'description' => 'Books about business and startups', 'status' => 1],
            ['name' => 'Comics', 'description' => 'Comic books for entertainment', 'status' => 0],
            ['name' => 'Religion', 'description' => 'Spiritual and religious texts', 'status' => 1],
            ['name' => 'Politics', 'description' => 'Political issues and analysis', 'status' => 1],
            ['name' => 'Mystery', 'description' => 'Detective and mystery novels', 'status' => 1],
            ['name' => 'Thriller', 'description' => 'Thrilling and suspenseful stories', 'status' => 1],
            ['name' => 'Self-help', 'description' => 'Books for self-improvement', 'status' => 1],
            ['name' => 'Sports', 'description' => 'Sports guides and athlete bios', 'status' => 0],
            ['name' => 'Environment', 'description' => 'Books on nature and sustainability', 'status' => 1],
['name' => 'Adventure', 'description' => 'Exciting journey and quest stories', 'status' => 1],
    ['name' => 'Drama', 'description' => 'Emotional and conflict-driven narratives', 'status' => 1],
    ['name' => 'Classic', 'description' => 'Timeless literary works and masterpieces', 'status' => 1],
    ['name' => 'Science Fiction', 'description' => 'Futuristic and scientific concepts', 'status' => 1],
    ['name' => 'Memoir', 'description' => 'Personal life experiences and memories', 'status' => 1],
    ['name' => 'Western', 'description' => 'Cowboys and frontier stories', 'status' => 1],
    ['name' => 'Crime', 'description' => 'Crime investigations and criminal tales', 'status' => 1],
    ['name' => 'LGBTQ+', 'description' => 'Books focusing on LGBTQ+ themes', 'status' => 1],
    ['name' => 'Philosophy', 'description' => 'Thought-provoking and theoretical books', 'status' => 1],
    ['name' => 'Anthology', 'description' => 'Collections of short stories or poems', 'status' => 1],
    ['name' => 'Parenting', 'description' => 'Guides and tips on raising children', 'status' => 1],
    ['name' => 'Gardening', 'description' => 'Everything about planting and landscaping', 'status' => 1],
    ['name' => 'Photography', 'description' => 'Art and techniques of photography', 'status' => 1],
    ['name' => 'Interior Design', 'description' => 'Home decor and design ideas', 'status' => 1],
    ['name' => 'Animals & Pets', 'description' => 'Books about animals and pet care', 'status' => 1],
    ['name' => 'Crafts & Hobbies', 'description' => 'DIY projects and leisure activities', 'status' => 1],
    ['name' => 'Spirituality', 'description' => 'Books on inner peace and mindfulness', 'status' => 1],
    ['name' => 'Languages', 'description' => 'Language learning and linguistics', 'status' => 1],
    ['name' => 'Law', 'description' => 'Legal systems, rights, and justice', 'status' => 1],
    ['name' => 'Economics', 'description' => 'Economic theories and market trends', 'status' => 1],
    ['name' => 'Engineering', 'description' => 'Engineering disciplines and practices', 'status' => 1],
    ['name' => 'Mathematics', 'description' => 'Math concepts and problem solving', 'status' => 1],
    ['name' => 'Music', 'description' => 'Music theory, instruments, and artists', 'status' => 1],
    ['name' => 'Astrology', 'description' => 'Zodiac signs and horoscopes', 'status' => 1],
    ['name' => 'Mythology', 'description' => 'Legends, myths, and folklore', 'status' => 1],

            //   'description' => 'Books on nature and sustainability', 'status' => 1],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
    }

