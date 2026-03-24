<?php

/**
 * Static cafe menu (no database). Add keys here when you extend the app.
 *
 * @var array<string, array{
 *     name: string,
 *     price: int,
 *     image: string,
 *     spice_level: int|null,
 *     temperature: 'hot'|'ice'|null,
 *     review_title: string,
 *     review_body: string,
 * }>
 */
return [
    'items' => [
        'curry' => [
            'name' => 'CURRY',
            'price' => 980,
            'image' => 'images/cafe/curry.svg',
            'spice_level' => 3,
            'temperature' => null,
            'review_title' => 'スパイス香る定番カレー',
            'review_body' => 'じっくり炒めた玉ねぎと複数種のスパイスで仕上げた当店自慢のカレーです。ごはんとの相性もばっちりで、ランチにぴったりの一杯です。',
        ],
        'pasta' => [
            'name' => 'PASTA',
            'price' => 920,
            'image' => 'images/cafe/pasta.svg',
            'spice_level' => 2,
            'temperature' => null,
            'review_title' => 'アルデンテに仕上げたパスタ',
            'review_body' => 'オリーブオイルとニンニクをきかせたシンプルな味わい。仕上げにチーズをひと振りして、温かいうちにお召し上がりください。',
        ],
        'coffee' => [
            'name' => 'COFFEE',
            'price' => 450,
            'image' => 'images/cafe/coffee.svg',
            'spice_level' => null,
            'temperature' => 'hot',
            'review_title' => '深煎りブレンド（ホット）',
            'review_body' => 'ナッツとチョコレートのような香ばしさが特徴のホットコーヒーです。食後のひとときにどうぞ。',
        ],
        'juice' => [
            'name' => 'JUICE',
            'price' => 420,
            'image' => 'images/cafe/juice.svg',
            'spice_level' => null,
            'temperature' => 'ice',
            'review_title' => '季節のフレッシュジュース（アイス）',
            'review_body' => '果実の甘みをそのまま味わえるアイスドリンクです。仕入れによってフルーツの種類は変わることがあります。',
        ],
    ],
];
