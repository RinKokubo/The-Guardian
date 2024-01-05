## 飯尾ゼミ個人情報保護ゲーム研究チーム制作　「The Guardian」

### ゲーム概要
本ゲームは、「個人情報悪用側」と「個人情報提供側」という二つの主要な役割に分かれて1対1で対戦するカードゲームです。
個人情報悪用側は攻撃的な立場をとり、悪用カード（例: 空き巣・スパムメール・結婚詐欺）の内容に基づいて相手の個人情報の悪用を試みます。
一方で、個人情報提供側は守備的な立場をとり、所持する個人情報カード（例: 位置情報・電話番号・交友関係）の中で相手に知られても問題ないと考えるカードを選択して、悪用側からの攻撃を防ぎます。

### 遊び方

### システム構成

### 起動方法
```
npm run dev
```

## ディレクトリ構成
<pre>
.
├── README.md
├── app
│   ├── Console
│       └── Kernel.php
│   ├── Events
│       ├── AttackerCardSelected.php
│       ├── DefenderCardSelected.php
│       ├── DefenderTrans.php
│       ├── DefenderTransit.php
│       └── MessageSent.php
│   ├── Exceptions ..
│   └── Http
│       ├── Controllers
│           ├── AttackerCardInfoController.php
│           ├── AuthController.php
│           ├── CardSelectController.php
│           ├── Controller.php
│           ├── ConversationController.php
│           ├── GameInformationController.php
│           ├── MatchInfoController.php
│           ├── MessageController.php
│           ├── NoticeController.php
│           ├── ScoreController.php
│           ├── UserController.php
│           └── UserScoreController.php
│       ├── Middleware
│           ├── Authenticate.php
│           └── ...
│       └── Kernel.php
│   ├── Models
│       ├── AttackerCard.php
│       ├── AttackerCardInfo.php
│       ├── CardInformation.php
│       ├── DefenderCard.php
│       ├── GameInformation.php
│       ├── GameResult.php
│       ├── MatchInfo.php
│       ├── Message.php
│       ├── Notice.php
│       ├── User.php
│       └── UserScore.php
│   ├── Providers ..
│   └── config ..
├── bootstrap ..
├── database
│   ├── factories ..
│   ├── migrations
│       ├── 0000_00_00_000000_create_websockets_statistics_entries_table.php
│       ├── 0000_00_00_000000_rename_statistics_counters.php
│       ├── 2014_10_12_000000_create_users_table.php
│       ├── 2023_05_14_091914_create_attacker_cards_table.php
│       ├── 2023_05_14_092655_create_defender_cards_table.php
│       ├── 2023_05_15_100438_create_game_information_table.php
│       ├── 2023_05_16_093947_create_card_information_table.php
│       ├── 2023_05_16_103823_create_game_results_table.php
│       ├── 2023_06_29_161252_create_messages_table.php
│       ├── 2023_06_30_002718_add_updated_at_to_messages_table.php
│       ├── 2023_07_01_020658_create_user_scores_table.php
│       ├── 2023_07_02_070106_create_notices_table.php
│       ├── 2023_10_26_204834_create_match_info_table.php
│       └── 2023_11_07_192727_create_attacker_cards_info_table.php
│   ├── seeders
│       ├── AttackerCardSeeder.php
│       ├── AttackerCardsInfoTableSeeder.php
│       ├── CardInformationSeeder.php
│       ├── DatabaseSeeder.php
│       ├── DefenderCardSeeder.php
│       ├── GameInformationSeeder.php
│       ├── MatchInfoSeeder.php
│       ├── NoticeSeeder.php
│       └── UserSeeder.php
│   └── .gitignore
├── public ..
├── resources
│   ├── css
│       └── app.css
│   ├── js
│       ├── components
│           ├── AttackerChatComponent.vue
│           ├── AttackerSelectComponent.vue
│           ├── AttackerStandbyComponent.vue
│           ├── DefenderChatComponent.vue
│           ├── DefenderSelectComponent.vue
│           ├── DefenderStandbyComponent.vue
│           ├── FinalResultComponent.vue
│           ├── HelloComponent.vue
│           ├── IntroComponent.vue
│           ├── MakeGameComponent.vue
│           ├── MenuComponent.vue
│           ├── ResultComponent.vue
│           ├── SelectAccountComponent.vue
│           ├── TalkComponent.vue
│           └── UserScoreComponent.vue
│       ├── App.vue
│       ├── app.js
│       └── bootstrap.js
│   ├── lang/en
│   ├── sass
│   └── views
│       ├── layouts ..
│       ├── hello.blade.php
│       ├── intro.blade.php
│       ├── selectAcount.blade.php
│       └── welcome.blade.php
├── routes
│   ├── api.php
│   ├── channels.php
│   ├── console.php
│   └── web.php
├── storage ..
├── tests ..
├── .editorconfig
├── .env.example
├── .gitattributes
├── .gitignore
├── .styleci.yml
├── Procfile
├── artisan
├── composer.json
├── composer.lock
├── laravel-echo-server 2.lock
├── laravel-echo-server.json
├── package-lock.json
├── package.json
├── phpunit.xml
├── server.php
├── tailwind.config.js
└── webpack.mix.js
</pre>
