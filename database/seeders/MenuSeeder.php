<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

/**
 * メニュー初期データ
 *
 * type（種別）
 *   - drink … 飲み物。index では「温度」として spiciness を表示する。
 *   - food  … 食べ物。index では「辛さ」として spiciness を 🌶️ で表示する（数値のとき 1〜5）。
 *
 * spiciness（味・提供スタイルの目安）
 *   - 飲み物（drink）: 文字列 hot（ホット） / ice（アイス）。それ以外はそのまま表示。
 *   - 食べ物（food） : 文字列の数字 "1"〜"5" で辛さレベル。非数値なら文字のまま表示。
 */
class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // ── 飲み物: ホットコーヒー（深煎り豆・ドリップ）
        Menu::create([
            'id' => 1,
            'name' => 'こだわりコーヒー',
            'slug' => 'coffee',
            'price' => 500,
            'image' => 'coffee.png',
            'description' => 'ブラジルとグアテマラの豆を7:3でブレンド。中深煎りで、カラメルとナッツの香り、後味はすっきりめ。朝の一杯や食後のリラックスタイムに。',
            'type' => 'drink',
            'spiciness' => 'hot',
        ]);

        // ── 飲み物: アイス紅茶（ベルガモット香るアールグレイ）
        Menu::create([
            'id' => 2,
            'name' => 'アールグレイティー',
            'slug' => 'tea',
            'price' => 450,
            'image' => 'tea.png',
            'description' => 'セイロン茶葉にベルガモットオイルをブレンド。グラスいっぱいの氷と、はちみつ少しで香りを引き立てたアイスティーです。',
            'type' => 'drink',
            'spiciness' => 'hot',
        ]);

        // ── 飲み物: ホットカフェラテ（エスプレッソ + スチームミルク）
        Menu::create([
            'id' => 3,
            'name' => 'ふんわりカフェラテ',
            'slug' => 'latte',
            'price' => 550,
            'image' => 'latte.png',
            'description' => 'ダブルショットのエスプレッソに、65℃前後にスチームしたミルクを注ぎ、薄いフォームで仕上げ。ミルクの甘みとコーヒーの苦みのバランスを意識した一杯です。',
            'type' => 'drink',
            'spiciness' => 'hot',
        ]);

        // ── 食べ物: 中辛寄りのスパイスカレー（ごはん付き想定）
        Menu::create([
            'id' => 4,
            'name' => '特製スパイスカレー',
            'slug' => 'curry',
            'price' => 900,
            'image' => 'curry.png',
            'description' => 'クミン、コリアンダー、ターメリックなど10種類の粉スパイスをオリジナル配合。鶏ももと玉ねぎをじっくり炒め、出汁とトマトでとろみまで煮込みました。辛さは「中辛」相当（口に広がるが、水なしで最後まで食べられる目安）。',
            'type' => 'food',
            'spiciness' => '3',
        ]);

        Menu::create([
            'id' => 5,
            'name' => 'マルゲリータピザ',
            'slug' => 'pizza',
            'price' => 800,
            'image' => 'pizza.png',
            'description' => 'マルゲリータピザは、ソース、モッツァレラチーズ、ピザパウダー、マルゲリータパイザー、パイザーの5つの材料で作られています。',
            'type' => 'food',
            'spiciness' => '1',
        ]);
    }
}
