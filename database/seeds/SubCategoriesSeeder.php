<?php

use Illuminate\Database\Seeder;

class SubCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_categories')->insert([
            // 犬
            [
                'tag_category_id' => 1,
                'name'            => '雑種',
            ],
            [
                'tag_category_id' => 1,
                'name'            => 'トイプードル',
            ],
            [
                'tag_category_id' => 1,
                'name'            => 'チワワ',
            ],
            [
                'tag_category_id' => 1,
                'name'            => 'フレンチブルドッグ',
            ],
            [
                'tag_category_id' => 1,
                'name'            => 'ミニチュアダックスフンド',
            ],
            [
                'tag_category_id' => 1,
                'name'            => 'ポメラニアン',
            ],
            [
                'tag_category_id' => 1,
                'name'            => 'コーギー',
            ],
            [
                'tag_category_id' => 1,
                'name'            => 'パピヨン',
            ],
            [
                'tag_category_id' => 1,
                'name'            => 'パグ',
            ],
            [
                'tag_category_id' => 1,
                'name'            => 'ゴールデンレトリバー',
            ],
            [
                'tag_category_id' => 1,
                'name'            => 'ラブラドールレトリバー',
            ],
            [
                'tag_category_id' => 1,
                'name'            => 'ヨークシャーテリア',
            ],
            [
                'tag_category_id' => 1,
                'name'            => 'ボストンテリア',
            ],
            [
                'tag_category_id' => 1,
                'name'            => 'キャバリア・キング・チャールズ・スパニエル',
            ],
            [
                'tag_category_id' => 1,
                'name'            => '芝犬',
            ],
            [
                'tag_category_id' => 1,
                'name'            => '不明',
            ],
            [
                'tag_category_id' => 1,
                'name'            => 'その他',
            ],

            // 猫
            [
                'tag_category_id' => 2,
                'name'            => '雑種',
            ],
            [
                'tag_category_id' => 2,
                'name'            => 'スコティッシュ・フォールド',
            ],
            [
                'tag_category_id' => 2,
                'name'            => 'アメリカン・ショートヘア',
            ],
            [
                'tag_category_id' => 2,
                'name'            => 'マンチカン',
            ],
            [
                'tag_category_id' => 2,
                'name'            => '日本猫',
            ],
            [
                'tag_category_id' => 2,
                'name'            => 'ノルウェージャン・フォレスト・キャット',
            ],
            [
                'tag_category_id' => 2,
                'name'            => 'ロシアンブルー',
            ],
            [
                'tag_category_id' => 2,
                'name'            => 'ブリティッシュ・ショートヘア',
            ],
            [
                'tag_category_id' => 2,
                'name'            => 'ラグドール',
            ],
            [
                'tag_category_id' => 2,
                'name'            => 'メイン・クーン',
            ],
            [
                'tag_category_id' => 2,
                'name'            => 'ペルシャ（チンチラ）',
            ],
            [
                'tag_category_id' => 2,
                'name'            => 'ベンガル',
            ],
            [
                'tag_category_id' => 2,
                'name'            => 'ソマリ',
            ],
            [
                'tag_category_id' => 2,
                'name'            => 'アビシニアン',
            ],
            [
                'tag_category_id' => 2,
                'name'            => 'ペルシャ',
            ],
            [
                'tag_category_id' => 2,
                'name'            => '不明',
            ],
            [
                'tag_category_id' => 2,
                'name'            => 'その他',
            ],

            // 小動物
            [
                'tag_category_id' => 3,
                'name'            => 'ハムスター',
            ],
            [
                'tag_category_id' => 3,
                'name'            => 'モルモット',
            ],
            [
                'tag_category_id' => 3,
                'name'            => 'フェレット',
            ],
            [
                'tag_category_id' => 3,
                'name'            => 'リス',
            ],
            [
                'tag_category_id' => 3,
                'name'            => 'ウサギ',
            ],
            [
                'tag_category_id' => 3,
                'name'            => 'ネズミ',
            ],
            [
                'tag_category_id' => 3,
                'name'            => 'ハリネズミ',
            ],
            [
                'tag_category_id' => 3,
                'name'            => 'サル',
            ],
            [
                'tag_category_id' => 3,
                'name'            => 'その他',
            ],

            // 魚
            [
                'tag_category_id' => 4,
                'name'            => 'カージナルテトラ',
            ],
            [
                'tag_category_id' => 4,
                'name'            => 'ネオンテトラ',
            ],
            [
                'tag_category_id' => 4,
                'name'            => 'ラミーノーズテトラ',
            ],
            [
                'tag_category_id' => 4,
                'name'            => 'アフリカンランプアイ',
            ],
            [
                'tag_category_id' => 4,
                'name'            => 'ゴールデンハニードワーフグラミー',
            ],
            [
                'tag_category_id' => 4,
                'name'            => 'ラスボラ・エスペイ',
            ],
            [
                'tag_category_id' => 4,
                'name'            => 'コリドラス',
            ],
            [
                'tag_category_id' => 4,
                'name'            => 'ラミレジィ',
            ],
            [
                'tag_category_id' => 4,
                'name'            => 'バタフライ・レインボー',
            ],
            [
                'tag_category_id' => 4,
                'name'            => 'トランスルーセントグラスキャット',
            ],
            [
                'tag_category_id' => 4,
                'name'            => 'アカヒレ',
            ],
            [
                'tag_category_id' => 4,
                'name'            => '金魚',
            ],
            [
                'tag_category_id' => 4,
                'name'            => 'メダカ',
            ],
            [
                'tag_category_id' => 4,
                'name'            => 'グッピー',
            ],

            // 鳥
            [
                'tag_category_id' => 5,
                'name'            => 'オカメインコ',
            ],
            [
                'tag_category_id' => 5,
                'name'            => 'インコ（その他）',
            ],
            [
                'tag_category_id' => 5,
                'name'            => 'ジュウシマツ',
            ],
            [
                'tag_category_id' => 5,
                'name'            => 'ブンチョウ',
            ],
            [
                'tag_category_id' => 5,
                'name'            => 'フクロウ',
            ],
            [
                'tag_category_id' => 5,
                'name'            => 'ミミヅク',
            ],
            [
                'tag_category_id' => 5,
                'name'            => 'オウム',
            ],
            [
                'tag_category_id' => 5,
                'name'            => 'ニワトリ',
            ],
            [
                'tag_category_id' => 5,
                'name'            => 'その他',
            ],
            
            // 爬虫類・他
            [
                'tag_category_id' => 6,
                'name'            => 'ヘビ',
            ],
            [
                'tag_category_id' => 6,
                'name'            => 'カメ',
            ],
            [
                'tag_category_id' => 6,
                'name'            => 'トカゲ',
            ],
            [
                'tag_category_id' => 6,
                'name'            => 'ヤモリ',
            ],
            [
                'tag_category_id' => 6,
                'name'            => '両生類',
            ],
            [
                'tag_category_id' => 6,
                'name'            => 'その他',
            ],
        ]);
    }
}
