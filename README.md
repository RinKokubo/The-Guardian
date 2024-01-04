## 飯尾ゼミ個人情報保護ゲーム研究チーム制作　「The Guardian」

### ゲーム概要
本ゲームは、「個人情報悪用側」と「個人情報提供側」という二つの主要な役割に分かれて1対1で対戦するカードゲームです。
個人情報悪用側は攻撃的な立場をとり、悪用カード（例: 空き巣・スパムメール・結婚詐欺）の内容に基づいて相手の個人情報の悪用を試みます。
一方で、個人情報提供側は守備的な立場をとり、所持する個人情報カード（例: 位置情報・電話番号・交友関係）の中で相手に知られても問題ないと考えるカードを選択して、悪用側からの攻撃を防ぎます。

### 遊び方

### システム構成

### 起動方法

## ディレクトリ構成
<pre>
.
├── README.md
├── app
│   └── Console
│       └── Kernel.php
│   └── Events
│       ├── AttackerCardSelected.php
│       ├── DefenderCardSelected.php
│       ├── DefenderTrans.php
│       ├── DefenderTransit.php
│       └── MessageSent.php
│   └── Exceptions ..
│   └── Http
│       └── Controllers
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
│       └── Middleware
│           ├── Authenticate.php
│           └── ...
│       └── Kernel.php
│   └── Models
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
│   └── Providers ..
├── gradle
│   └── wrapper
│       ├── gradle-wrapper.jar
│       └── gradle-wrapper.properties
├── gradlew
├── gradlew.bat
├── gradlew.properties
├── docker-compose.yml
├── mysql.Dockerfile
├── settings.gradle
├── .gitignore
├── .gitignore.swp
└── src
    └── main
        ├── java
        └── webapp
</pre>
