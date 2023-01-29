<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
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

        $commentUsers = User::factory()->count(10)->create()->toArray();
        $articleAndLikes = [];
        $articles = Article::factory()->count(10)->has(
            Like::factory()->count(5)->state(function(array $attributes, Article $article) use ($commentUsers, &$articleAndLikes) {
                $likedUserId = Arr::random($commentUsers)['id'];
                if (!isset($articleAndLikes[$article->id])) {
                    $articleAndLikes[$article->id] = [];
                }
                while (in_array($likedUserId, $articleAndLikes[$article->id])) {
                    $likedUserId = Arr::random($commentUsers)['id'];
                }
                $articleAndLikes[$article->id][] = $likedUserId;
                return ['user_id' => $likedUserId, 'likeable_id' => $article->id, 'likeable_type' => $article::class];
            })
        )->create([
            'author_id' => $user->id
        ]);

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
