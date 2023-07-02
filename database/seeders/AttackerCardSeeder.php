<?php

namespace Database\Seeders;

use App\Models\AttackerCard;
use Illuminate\Database\Seeder;

class AttackerCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cardNames = [
            'オレオレ詐欺',
            '代引き詐欺',
            'スパムメール',
            'アカウント乗っ取り',
            'ストーカー',
            '空き巣',
            '宗教勧誘',
            '年金詐欺',
            '国際ロマンス詐欺',
            'SNSなりすまし',
            '代引き詐欺',
            'フィッシング詐欺',
            'いたずら電話',
            'ECサイトアカウント乗っ取り',
            '預貯金詐欺',
            '架空請求',
            '結婚詐欺',
            '金銭的略取',
            '勧誘電話',
        ];

        foreach ($cardNames as $index => $name) {
            AttackerCard::create([
                'id' => $index + 1,
                'attacker_card_name' => $name,
            ]);
        }
    }
}
