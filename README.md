## QUELCINEMAS

### ABOUT
   オンライン映画予約サービスのデモサイトです。
   会員登録→上映映画選択→支払い情報登録（クレジットカード）→映画予約まで一連の操作が可能となっております。

### 使用技術
- HTML /CSS
- Javascript / jQuery / Ajax
- PHP7.3
- CakePHP3.8
- AWS(EC2,VPC,RDS,ElasticBeanstalk,Route53)
- Docker / Docker-compose(ローカル開発環境用)
- Nginx
- MySQL8.0
- Git/GitHub

## 🌐 App URL

### http://quelcinemas.tk

## ⛏HOW TO USE
※ゲストログイン機能を近日中に実装する予定です。
1.ヘッダーの「ログイン」でログインページに遷移し、「会員登録」画面で会員情報を入力します。

2.ヘッダーの「ログイン」でログインページに遷移し、先ほど入力した情報でログインします。

３.ヘッダーの「上映スケジュール」ページから予約したい映画を選択します（この時、予約済みの映画を選択するとリダイレクトされます。マイページよりキャンセルを行なってからの再度予約が必要です）

４.座席選択→支払い情報入力→確認画面の流れで予約が完了します。確認したい場合は「マイページ」を参照してください。

## 🛠feature
- 仮予約機能：座席を予約し、かつ決済情報が未入力の状態が15分経過した場合は、その予約は削除される機能を実装しております。
- 座席選択後のキャンセル機能：座席選択後の確認画面で「キャンセル」ボタンを押した場合は、仮予約はされずに座席選択画面で先ほど選択した座席を選択済み状態遷移するよう実装しています。
- 可用性を実現するために負荷が増えた際にはEC2インスタンスが自動的に増設されるように実装しております。(AutoScalling）

## 🌐Network
![network](network.png)

## Other
本開発は3人でのチーム開発で行いました。チーム開発ではレビューの精度を高めるために話し合いを行なっておりました。
いくつか私がプルリクを提出したものと、レビューしたもののリンクを添付します。
- プルリク

https://github.com/labotinc/quelcode-team4-2/pull/25

https://github.com/labotinc/quelcode-team4-2/pull/36
- レビュー

https://github.com/labotinc/quelcode-team4-2/pull/46

https://github.com/labotinc/quelcode-team4-2/pull/52
