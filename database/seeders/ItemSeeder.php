<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
 {
    $item = Item::create([
        'user_id' => 1,
        'name' => '腕時計',
        'brand' => 'Rolax',
        'condition' => '良好',
        'price' => 15000,
        'description' => 'スタイリッシュなメンズ腕時計',
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
     ]);

    $item->categories()->attach([1, 5]); 

    $item = Item::create([
        'user_id' => 1,
        'name' => 'HDD',
        'brand' => '西芝',
        'condition' => '目立った傷や汚れなし',
        'price' => 5000,
        'description' => '高速で信頼性の高いハードディスク',
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
    ]);

    $item->categories()->attach([2]);

    $item = Item::create([
        'user_id' => 1,
        'name' => '玉ねぎ3束',
        'brand' => 'なし',
        'condition' => 'やや傷や汚れあり',
        'price' => 300,
        'description' => '新鮮な玉ねぎ3束のセット',
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
    ]);

    $item->categories()->attach([10]);

    $item = Item::create([
        'user_id' => 1,
        'name' => '革靴',
        'brand' => null,
        'condition' => '状態が悪い',
        'price' => 4000,
        'description' => 'クラシックなデザインの革靴',
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
    ]);

    $item->categories()->attach([1, 5]);

    $item = Item::create([
        'user_id' => 1,
        'name' => 'ノートPC',
        'brand' => null,
        'condition' => '良好',
        'price' => 45000,
        'description' => '高性能なノートパソコン',
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
    ]);
    
    $item->categories()->attach([2]);
    
    $item = Item::create([
        'user_id' => 1,
        'name' => 'マイク',
        'brand' => 'なし',
        'condition' => '目立った傷や汚れなし',
        'price' => 8000,
        'description' => '高音質のレコーディング用マイク',
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
    ]);

    $item->categories()->attach([2]);

    $item = Item::create([
        'user_id' => 1,
        'name' => 'ショルダーバッグ',
        'brand' => null,
        'condition' => 'やや傷や汚れあり',
        'price' => 3500,
        'description' => 'おしゃれなショルダーバッグ',
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
    ]);

    $item->categories()->attach([1, 4]);

    $item = Item::create([
        'user_id' => 1,
        'name' => 'タンブラー',
        'brand' => 'なし',
        'condition' => '状態が悪い',
        'price' => 500,
        'description' => '使いやすいタンブラー',
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
    ]);

    $item->categories()->attach([10]);

    $item = Item::create([
        'user_id' => 1,
        'name' => 'コーヒーミル',
        'brand' => 'Starbacks',
        'condition' => '良好',
        'price' => 4000,
        'description' => '手動のコーヒーミル',
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
    ]);

    $item->categories()->attach([10]);

    $item = Item::create([
        'user_id' => 1,
        'name' => 'メイクセット',
        'brand' => null,
        'condition' => '目立った傷や汚れなし',
        'price' => 2500,
        'description' => '便利なメイクアップセット',
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
    ]);

    $item->categories()->attach([4, 6]);

 }
}

    


