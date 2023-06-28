<?php

namespace Database\Seeders;

use App\Models\DefenderCard;
use Illuminate\Database\Seeder;

class DefenderCardSeeder extends Seeder
{
    public function run()
    {
        $cardNames = [
            '家族構成',
            '電話番号',
            'メールアドレス',
            '住所',
            'サイト閲覧履歴',
            '交友関係',
            '性別',
            '位置情報',
            '年収',
            '顔写真',
            '思想',
            '名前',
            '口座情報',
            '生年月日',
            '職業',
            '趣味',
        ];

        foreach ($cardNames as $name) {
            DefenderCard::create([
                'defender_card_name' => $name,
            ]);
        }
    }
}
