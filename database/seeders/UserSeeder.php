<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Product;
use App\Models\User;
use App\Models\View;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(30)->create()->each(function (User $user){
            Product::factory(1)->create([
                'user_id' => $user->id,
            ])->each(function (Product $product) use ($user){
                Comment::factory(rand(1,3))->create([
                    'user_id' => $user->id,
                    'commentable_id' => $product->id,
                    'commentable_type' => Product::class,
                ])->each(function (Comment $comment) use ($user){
                    Comment::factory(1)->create([
                        'user_id' => $user->id,
                        'parent_id' => $comment->id,
                        'commentable_type' => Comment::class
                    ]);
                });

                View::factory(1)->create([
                    'user_id' => $user->id,
                    'viewable_id' => $product->id,
                    'viewable_type' => Product::class,
                ]);


                Like::factory(1)->create([
                    'user_id' => $user->id,
                    'likeable_id' => $product->id,
                    'likeable_type' => Product::class,
                ]);
            });

            Blog::factory(1)->create([
                'user_id' => $user->id,
            ])->each(function (Blog $blog) use ($user){
                Comment::factory(rand(1,3))->create([
                    'user_id' => $user->id,
                    'commentable_type' => Blog::class,
                    'commentable_id' => $blog->id,
                ])->each(function (Comment $comment) use ($user){
                    Comment::factory(1)->create([
                       'user_id' => $user->id,
                        'parent_id' => $comment->id,
                       'commentable_type' => Comment::class,
                    ]);

                    View::factory(1)->create([
                        'user_id' => $user->id,
                        'viewable_type' => Comment::class,
                        'viewable_id' => $comment->id,
                    ]);

                    Like::factory(1)->create([
                        'user_id' => $user->id,
                        'likeable_id' => $comment->id,
                        'likeable_type' => Comment::class,
                    ]);
                });

                View::factory(1)->create([
                    'user_id' => $user->id,
                    'viewable_id' => $blog->id,
                    'viewable_type' => Blog::class
                ]);

                Like::factory(1)->create([
                   'user_id' => $user->id,
                   'likeable_type' => Blog::class,
                   'likeable_id' => $blog->id,
                ]);


            });

        });
    }
}
