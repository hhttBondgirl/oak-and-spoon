<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review; // 1. Reviewモデルを使えるようにインポート！

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::create([
            'menu_id' => 1, 
            'user_name' => 'suzuki',
            'gender' => 'male',
            'comment' => 'まろやかな香りと味わいが深いコーヒーです。',
            'stars' => 5,
        ]);

        Review::create([
            'menu_id' => 1,
            'user_name' => 'tanaka',
            'gender' => 'female',
            'comment' => '香りが強く、少し苦味を感じました。',
            'stars' => 3,
        ]);

        Review::create([
            'menu_id' => 2,
            'user_name' => 'sato',
            'gender' => 'female',
            'comment' => '香りがよくて癒されます。',
            'stars' => 4,
        ]);

        Review::create([
            'menu_id' => 2,
            'user_name' => 'yamada',
            'gender' => 'male',
            'comment' => 'ミルクを入れても美味しいです。',
            'stars' => 5,
        ]);

        Review::create([
            'menu_id' => 3,
            'user_name' => 'suzuki',
            'gender' => 'male',
            'comment' => '少し甘すぎる気がします。',
            'stars' => 3,
        ]);

        Review::create([
            'menu_id' => 3,
            'user_name' => 'tanaka',
            'gender' => 'male',
            'comment' => 'ホッとするカフェラテです。',
            'stars' => 5,
        ]);

        Review::create([
            'menu_id' => 4,
            'user_name' => 'sato',
            'gender' => 'male',
            'comment' => '辛さがちょうど良いです。',
            'stars' => 5,
        ]);

        Review::create([
            'menu_id' => 4,
            'user_name' => 'noguchi',
            'gender' => 'female',
            'comment' => '私には辛さが強かったです。',
            'stars' => 2,
        ]);

        Review::create([
            'menu_id' => 5,
            'user_name' => 'yamada',
            'gender' => 'female',
            'comment' => '石窯で焼いたピザは美味しいです。',
            'stars' => 5,
        ]);

        Review::create([
            'menu_id' => 5,
            'user_name' => 'yoriji',
            'gender' => 'female',
            'comment' => '何枚でもいける',
            'stars' => 5,
        ]);
    }
}
