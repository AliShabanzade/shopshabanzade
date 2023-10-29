<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users=User::pluck('id')->toArray();
        $products = Product::pluck('id')->toArray();
        $blogs = Blog::pluck('id')->toArray();
        Comment::factory(10)->afterCreating(function (Comment $comment) use ($users) {
            Comment::factory(3)->create([
                   'user_id' => fake()->randomElement($users),
                   'commentable_type' => Comment::class,
                   'parent_id' => $comment->id,
            ]);
        })->create([

                'user_id' => fake()->randomElement($users),
                'commentable_id' => fake()->randomElement($products),
                'commentable_type' => Product::class,


        ]);

        Comment::factory(10)->afterCreating(function (Comment $comment) use ($users){

            Comment::factory(3)->create([

                'user_id' => fake()->randomElement($users),
                'commentable_type' => Comment::class,
                'parent_id' => $comment->id,

            ]);

        } )->create([
            'user_id' => fake()->randomElement($users),
            'commentable_id' =>fake()->randomElement($blogs),
            'commentable_type' => Blog::class,
        ]);
    }
}
