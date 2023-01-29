<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()
        ->create([
            "name"  => "Test User",
            "email" => "test@example.com",
        ]);

        $articles = Article::factory()->count(10)->create([
            'author_id' => $user->id
        ]);


        $commentUsers = User::factory()->count(10)->create()->toArray();
        $nestingLvl = 4;
        $numOfCommentsForEachLvl = 3;
        foreach ($articles as $article) {
            $nested = null;
            for ($i = 0; $i < $nestingLvl; $i++) {
                $nextComment = Arr::random($commentUsers);
                if (!$nested) {
                    $nested = Comment::factory(null, [
                        'user_id' => $nextComment['id'],
                        'article_id' => $article->id,
                    ])->count($numOfCommentsForEachLvl);
                    continue;
                }
                $nested = Comment::factory(null, [
                    'user_id' => $nextComment['id'],
                    'article_id' => $article->id,
                ])->count($numOfCommentsForEachLvl)->has($nested, 'replies');
            }
            $nested->create();
        }
    }
}
