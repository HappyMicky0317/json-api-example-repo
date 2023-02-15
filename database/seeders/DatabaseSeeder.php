<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\ProfilePicture;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Post::factory()
            ->times(10)
            ->has(Comment::factory()->times(5))
            ->has(Tag::factory()->times(2))
            ->create();

        User::each(fn ($user) => ProfilePicture::factory()->create([
            'user_id' => $user->id,
        ]));
    }
}
