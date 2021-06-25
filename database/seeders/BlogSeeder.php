<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryNews = Category::create(['name' => 'News']);
        $categoryDesign = Category::create(['name' => 'Design']);
        $categoryTechnology = Category::create(['name' => 'Technology']);
        $categoryEngineering = Category::create(['name' => 'Engineering']);

        $tagCustomers = Tag::create(['name' => 'customers']);
        $tagDesign = Tag::create(['name' => 'design']);
        $tagLaravel = Tag::create(['name' => 'laravel']);
        $tagCoding = Tag::create(['name' => 'coding']);


        $post1 = Post::create([
            'title' => 'We relocated our office to home!',
            'excerpt' => Factory::create()->sentence(rand(10, 18)),
            'content' => Factory::create()->paragraphs(rand(3, 7), true),
            'image' => 'images/posts/1.jpg',
            'category_id' => $categoryDesign->id,
            'user_id' => 2,
            'published_at' => Carbon::now()->format('Y-m-d'),
        ]);

        $post2 = Post::create([
            'title' => 'Lets make something creative!',
            'excerpt' => Factory::create()->sentence(rand(10, 18)),
            'content' => Factory::create()->paragraphs(rand(3, 7), true),
            'image' => 'images/posts/2.jpg',
            'category_id' => $categoryDesign->id,
            'user_id' => 2,
            'published_at' => Carbon::now()->format('Y-m-d'),
        ]);

        $post3 = Post::create([
            'title' => 'Engineering is the best!',
            'excerpt' => Factory::create()->sentence(rand(10, 18)),
            'content' => Factory::create()->paragraphs(rand(3, 7), true),
            'image' => 'images/posts/1.jpg',
            'category_id' => $categoryEngineering->id,
            'user_id' => 1,
            'published_at' => Carbon::now()->format('Y-m-d'),
        ]);
        $post4 = Post::create([
            'title' => 'Updates to Java 14',
            'excerpt' => Factory::create()->sentence(rand(10, 18)),
            'content' => Factory::create()->paragraphs(rand(3, 7), true),
            'image' => 'images/posts/1.jpg',
            'category_id' => $categoryTechnology->id,
            'user_id' => 1,
            'published_at' => Carbon::now()->format('Y-m-d'),
        ]);
        $post5 = Post::create([
            'title' => 'Covid Vaccination drive is on!',
            'excerpt' => Factory::create()->sentence(rand(10, 18)),
            'content' => Factory::create()->paragraphs(rand(3, 7), true),
            'image' => 'images/posts/1.jpg',
            'category_id' => $categoryNews->id,
            'user_id' => 2,
            'published_at' => Carbon::now()->format('Y-m-d'),
        ]);

        $post1->tags()->attach([$tagCustomers->id, $tagDesign->id]);
        $post2->tags()->attach([$tagLaravel->id, $tagDesign->id]);
        $post3->tags()->attach([$tagCoding->id, $tagLaravel->id]);
        $post1->tags()->attach([$tagLaravel->id, $tagDesign->id]);
        $post1->tags()->attach([$tagCustomers->id, $tagDesign->id]);
    }
}
