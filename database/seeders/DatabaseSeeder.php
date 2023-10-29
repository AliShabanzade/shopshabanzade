<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
            BlogSeeder::class,
//            LikeSeeder::class,
//            CommentSeeder::class,
//            MediaSeeder::class,
//            ViewSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
        ]);;
    }
}
