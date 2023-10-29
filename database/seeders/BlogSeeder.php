<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Like;
use App\Models\User;
use App\Models\View;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           $users = User::pluck('id')->toArray();
           $copyUsers = [...$users];
           Blog::factory(10)
               ->afterCreating(function (Blog $blog) use ($copyUsers){
                   Like::factory(rand(1,10))->create([
                       'user_id' => User::factory(),
                       'likeable_id' => $blog->id,
                       'likeable_type' => Blog::class,
                   ]);

                   Comment::factory(rand(1,10))->create([
                      'user_id' => User::factory(),
                      'commentable_id' => $blog->id,
                      'commentable_type' => Blog::class,
                   ]);

                   View::factory(rand(1,10))->create([
                       'user_id' => User::factory(),
                       'viewable_type' => Blog::class,
                       'viewable_id' => $blog->id
                   ]);

               })
               ->create([
               'user_id' => fake()->randomElement($users),

           ]);


//        Blog::factory(10)->create([
//            'user_id' => fake()->randomElement($users)
//        ])->each(function (Blog $blog) use ($copyUsers){
//              Like::factory(10)->create([
//                  'user_id' => User::factory(),
//                  'likeable_type' => Blog::class,
//                  'likeable_id' => $blog->id,
//              ]) ;
//        });
    }
}
