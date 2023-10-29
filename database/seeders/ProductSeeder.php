<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Product;
use App\Models\User;
use App\Models\View;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(30)->create([
            'user_id' => User::factory(),
        ])
        ->each(function (Product $product){
            Like::factory(rand(1,10))->create([
                'user_id' => User::factory(),
                'likeable_id' => $product->id,
                'likeable_type' => Product::class,

            ]);

           Comment::factory(rand(1,10))->create([
              'user_id' => User::factory(),
              'commentable_type' => Product::class,
              'commentable_id' => $product->id,
           ]);

           View::factory(rand(1,10))->create([
               'user_id' => User::factory(),
               'viewable_id' => $product->id,
               'viewable_type' => Product::class,
           ]);
        });
    }
}
