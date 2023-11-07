<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AttackerCardInfo;

use function Ramsey\Uuid\v1;

class AttackerCardsInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AttackerCardInfo::create([
            'attacker_card_id' => 1,
            'attacker_card_info' => '息子や孫を装った電話で、お金をだまし取る手口。上司や同僚などを名乗り、複数名を代わる代わる電話口に出す場合も。あらかじめ「電話番号が変わった」などと電話し、番号を登録させて周到に準備しておく巧妙な手口もある。'
        ]);

        AttackerCardInfo::create([
            'attacker_card_id' => 2,
            'attacker_card_info' => '代引き請求で、頼んだ覚えのない商品を突然届けたり、相手が電話勧誘を断ったのに申し込んでない商品を家に届ける手口。家にいない家族宛てや、ネットショッピングをよく利用する人など、受け取るべきかすぐに判断できない人を狙う。'
        ]);

        AttackerCardInfo::create([
            'attacker_card_id' => 3,
            'attacker_card_info' => '迷惑な広告や宣伝のメールを無差別にたくさん送ること。今では、アダルト系サイトへの誘導を図るものや、ウイルスに感染させることを狙った犯罪目的のメールも増えている。'
        ]);


        AttackerCardInfo::create([
            'attacker_card_id' => 4,
            'attacker_card_info' => 'Webサイトやメールアカウントに不正アクセスし、管理権を握ること。一般的なパスワードや辞書の用語などを使ってパスワードを推測する。パスワードの使いまわしが多いことを鑑み、あえてメインの標的サイト以外の、セキュリティが手薄なサイトから乗っ取りを始める場合もある。'
        ]);

        AttackerCardInfo::create([
            'attacker_card_id' => 5,
            'attacker_card_info' => '他の人につきまとったり、待ち伏せしたりすること。最近では、姿が身辺になくても、GPSを使って行動パターンを探る手口も。引っ越し後も、GPS機器を忍ばせた郵便物を旧住所に送り、転送サービスで転居先を割り出すという場合もある。SNSで趣味やプライベートを探るネットストーカーも存在する。'
        ]);

        AttackerCardInfo::create([
            'attacker_card_id' => 6,
            'attacker_card_info' => '家に侵入して金品を盗むこと。10時～20時の間に行うことが多く、なかでも10時から12時までが最も多い。犯行に及ぶ前には下見をしていることが多く、人通りが少ないか、入りやすく逃げやすいか、留守（共働き）の家が多いか、お金がありそうかなどをチェックする。'
        ]);

        AttackerCardInfo::create([
            'attacker_card_id' => 7,
            'attacker_card_info' => '宗教（なかでも危険な団体）の信仰を広めようと他の人に声をかけること。サークルの勧誘やアンケート調査などと言い、一人でいる時に声をかけて親しくなり、電話番号などの個人情報を聞き出す。最初はボランティアやコンサートに誘い、次はセミナーに参加させる。そこでは所謂マインド・コントロールを行う。'
        ]);

        AttackerCardInfo::create([
            'attacker_card_id' => 8,
            'attacker_card_info' => '年金加入者を標的とし、お金を盗む手口。存在しない融資に年金を送金するよう指示したり、無料の年金審査、高額な収益を生み出す年金投資など、うまい話を持ちかける。年金を送金させようと、企業または行政機構になりすます場合もある。'
        ]);

        AttackerCardInfo::create([
            'attacker_card_id' => 9,
            'attacker_card_info' => '外国人相手に偽の恋愛関係を築き、お金をだまし取る手口。マッチングアプリなどで知り合い、SNSでやり取りすることがほとんど。これまでは実際に会うための渡航費や、プレゼントを送る際の関税といった名目で女性を騙すのが特徴的だったが、最近は投資や暗号資産に男性を誘う手口が増えている。'
        ]);

        AttackerCardInfo::create([
            'attacker_card_id' => 10,
            'attacker_card_info' => '特定の人物のSNSとそっくりなアカウントを作る迷惑行為。名前、顔写真、出身校、職業や年齢などの情報をプロフィールに記載し、あたかもその人物であるようになりすます。意図的な文章や画像を投稿したり、DMを送信したりする。他人への誹謗中傷や詐欺などを目的にする場合もある。'
        ]);

        AttackerCardInfo::create([
            'attacker_card_id' => 11,
            'attacker_card_info' => '代引き請求で、頼んだ覚えのない商品を突然届けたり、相手が電話勧誘を断ったのに申し込んでない商品を家に届ける手口。家にいない家族宛てや、ネットショッピングをよく利用する人など、受け取るべきかすぐに判断できない人を狙う。'
        ]);

        AttackerCardInfo::create([
            'attacker_card_id' => 12,
            'attacker_card_info' => '送信者名を偽ったメールを送って、偽のホームページに誘導し、クレジットカード番号やアカウント情報を盗み出す手口。カード会社や銀行からのお知らせと称したメールなどで、本物そっくりのサイトに誘導する。メールだけでなく、SMSやSNS、偽の警告表示などからサイトへ誘導するケースもある。'
        ]);

        AttackerCardInfo::create([
            'attacker_card_id' => 13,
            'attacker_card_info' => '無駄な電話や嫌がらせの電話をかけること。いわゆる「ワン切り」をして、着信履歴に記録された番号にかけ直させ、出会い系やアダルト系番組につなげることもある。また、電話口では何も言わず黙り、在宅状況や、電話に応答する声や内容から相手を知ろうとするケースもある。'
        ]);

        AttackerCardInfo::create([
            'attacker_card_id' => 14,
            'attacker_card_info' => 'ショッピングアカウントに不正アクセスし、管理権を握ること。一般的なパスワードや辞書の用語、誕生日などを使ってパスワードを推測する。パスワードの使いまわしが多いことを鑑み、あえてメインの標的サイト以外の、セキュリティが手薄なサイトから乗っ取りを始める場合もある。'
        ]);

        AttackerCardInfo::create([
            'attacker_card_id' => 15,
            'attacker_card_info' => '電話をかけたり、自宅を訪れたりして、カードや通帳をだまし取る手口。「医療費（保険料）の払戻しがある」「コロナ関係で給付金が支給される」「あなたのキャッシュカードが不正に使われた」などと伝え、カードの変更を誘導する。'
        ]);

        AttackerCardInfo::create([
            'attacker_card_id' => 16,
            'attacker_card_info' => '架空の事実を口実とし、お金をだまし取る手口。未納料金が発生しているなどの名目で、SMSを送ったり、裁判所などの名称で自宅にはがきを送付する。受け取った被害者が記載された番号に電話すると、「今日払えば大半が返金される」などと伝え、催促する。'
        ]);

        AttackerCardInfo::create([
            'attacker_card_id' => 17,
            'attacker_card_info' => '偽の結婚の約束をしてお金をだまし取る手口。結婚する意志を見せた上で、結婚前に借金を清算したいなどと言って金銭を要求する。自分は高学歴・高収入であり、理想的な結婚相手であることを強調したり、第三者の介入を許さず、借金に関する証明書を書くことを嫌ったりする。'
        ]);

        AttackerCardInfo::create([
            'attacker_card_id' => 18,
            'attacker_card_info' => '不正な手段で他人の金銭を奪うこと。詐欺・窃盗・強盗・恐喝などが包括的に含まれる。金銭的な不正取引を行うには、他人名義の口座情報（口座番号・支店名・名前）のほかに追加の認証が必要なため、情報を聞き出す必要がある。'
        ]);

        AttackerCardInfo::create([
            'attacker_card_id' => 19,
            'attacker_card_info' => '電話で商品やサービスを売り込む営業電話。強引な勧誘をし、断り切れずに高い商品を買ってしまう心理を狙う。また、「コロナウイルスの影響で商品が売れない」「営業成績ノルマがあり、職を失う」などと言って、購入を頼み、消費者の同情心につけ込むやり方もある。'
        ]);
    }
}
