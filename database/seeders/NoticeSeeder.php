<?php

namespace Database\Seeders;

use App\Models\Notice;
use Illuminate\Database\Seeder;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notice_content = [
            'SNSの場合、写真などの投稿により、友人のプライバシー情報を公開することになる点にも留意が必要です。どの情報を他人に公開しても良いと考えるかの基準は、人により異なります。友人に関する情報を掲載する場合には、事前に許可を取ることを原則とするべきでしょう。',
            '公開しているメールアドレスには、大量の迷惑メールが送られる事例が多く発生しています。Webサイト上で公開されているメールアドレスを自動的に検索・収集するプログラムが存在し、悪用されているためです。
            これへの対策としては、まずは、公開用のメールアドレスには、普段利用しているメールアドレスとは別の専用のアドレスを用意しましょう。そして、上記のプログラムに検知される確率を少なくするため、「@」を「_atmark_」などと表記する、メールアドレスを画像ファイルとして表示するなどの対策が有効です。',
            'SNSのアプリケーションの中には、インストールの際に、連絡先情報へアクセスする許可を求めてくるものがあります。このようなアプリケーションの中には、個人の連絡先情報を収集して、収集したメールアドレスに迷惑メールなどを送りつけることなどを目的としているものもあります。
            連絡先情報へアクセスするアプリケーションで、作成者の身元やその利用目的がよくわからないものは、使用を避けるようにした方が良いでしょう。',
            '住所氏名などの情報は収集されなくても、サイトアクセスなどの情報が収集されることはよくあります。多くは利用統計の把握や広告のために行われますが、収集された情報と他の情報を突き合わせることで、住所氏名などの個人の特定が可能となるケースがあります。
            多くの企業ではプライバシーポリシーを定めて適切に運用されていますが、不安を感じる場合は、ブラウザに保存されている「cookie」を削除することで、情報を収集されなくすることは可能です。ただし、削除すると利用者の特定ができなくなることから、ログイン操作が再び必要になるなどの影響もあります。',
            '最近のGPS機能のついたスマートフォンやデジタルカメラで撮影した写真には、設定によっては、目に見えない形で、撮影日時、撮影した場所の位置情報（GPS情報）、カメラの機種名など、さまざまな情報が含まれている場合があります。SNSに、こうした位置情報付きの写真をよく確認せずに掲載してしまうと、自分の自宅や居場所が他人に特定されてしまう危険性があり、迷惑行為やストーカー被害などの犯罪の被害に遭う可能性もあるため、十分注意が必要です。
            写真にどのような情報が含まれているか調べる方法はいくつかありますが、これらを表示するための専用のアプリケーションを利用すると、事前に確認ができます。写真に含まれている情報を編集・削除できるアプリケーションもあります。位置情報もプライバシー情報であるということを十分理解して、むやみに位置情報をつけて写真を投稿しないように心がけましょう。
            写真に写り込む情報にも注意しましょう。特に、バーコードやQRコードには個人を特定する情報が含まれていることが多々あります。特に、郵便物の宛名に付記されているバーコードには番地までの住所情報が含まれ、簡単に読み取れます。住所の部分をマスクしても、バーコードはそのまま掲載されている例が多く、注意が必要です。',
            'パスワード管理ツールを提供するパナマのセキュリティ企業『Nord Security』によると、2021年に日本で最も使われたパスワードは、「password」が1位で最も多く、次点で「123456」「123456789」「12345678」が続き、キーボード左のキーを縦に順番に打った「1qaz2wsx」が5位に入りました。
            世界50カ国には入らず、日本でのみランクインしたものには「sakura」が15位、「takahiro」が21位、「nekoneko」が35位などがあります。',
            '別々のサービスにおいては、同じパスワードを使い回さずに、それぞれに別のパスワードを設定しましょう。しかし、安全なパスワードをサービス毎に一つ一つ作成しようとすると、やはり覚えられなくなってしまいます。”安全なパスワード”とは、「他人に推測されにくい」「自分だけは覚えやすい、思い出しやすい」を満たしたパスワードです。
            そこで、使用しているサービスごとに、そのサービスの名前などを、パスワードに組み込んでみましょう。
            元のパスワード「vVtyu_3402」を使用する例: Instagram でのパスワード→「InstvVtyu_3402」、Amazon でのパスワード→「AmavVtyu_3402」',
            '「誕生日や名前でパスワード推測」インスタ乗っ取った男、みだらな画像を要求…ほかに「５０人ほど成功した」
            他人のインスタグラムのアカウントを乗っ取り、女子学生にみだらな画像を送るよう求めたとして、鹿児島県警は７日、名古屋市昭和区、理学療法士の男（３０）を不正アクセス禁止法違反と鹿児島県青少年保護育成条例違反の疑いで逮捕した。
            発表では、男は昨年５月、スマートフォンを使い、面識のない県内の女子学生のアカウントを不正に乗っ取ったうえ、他の女子学生が未成年と知りながら、ダイレクトメッセージで児童ポルノ画像を送るよう求めた疑い。男は容疑を認め、「誕生日や名前などを組み合わせてパスワードを推測した」という趣旨の供述をしているという。また、「他にも５０人ほど（乗っ取りに）成功した」と話しているといい、県警は余罪についても調べている。',
            '2022年7月6日、福岡県警は不正アクセス禁止法違反等の容疑で福岡県小竹町に勤める女性職員を逮捕したと発表しました。県警は、女が、翌年に繰り越される有給休暇を増やす目的で不正にアクセスしていたとみて捜査しています。
            小竹町は初期パスワードを生成するにあたって職員の誕生日を使用しており、女はパスワードを初期のものから変更していない職員のアカウントを不正に使用していました。町によれば従前から初期パスワードからの変更を職員に勧めていたと説明しています。',
        ];

        foreach ($notice_content as $index => $notice_content) {
            Notice::create([
                'id' => $index + 1,
                'notice_content' => $notice_content,
            ]);
        }
    }
}