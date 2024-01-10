##アプリケーション名

COACHTECHフリマアプリ

##作成した目的

模擬案件を通して実開発に近い経験を積む

##環境

Windows10Pro
Ubuntu 20.04.3
PHP 8.2.7
Laravel 8.83.27
MySQL 8.0.26

##開発環境導入方法

・Githubから任意のディレクトリに　git@github.com:naoneko1974/simulation3.git　をクローン。

・simulation3ディレクトリでdocker-compose up -d --build 実行しdockerコンテナを作成。

・PHPコンテナ内で composer install 実行。

・（Windows環境でエラーの場合）simulation3ディレクトリで sudo chmod -R 777 src/* を実行。

・PHPコンテナ内で php artisan migrate および php artisan db:seed 実行。

・ユーザー認証：fortifyを使用

・メール送信：Mailtrapを使用（開発環境）

・PHPUnitテスト環境構築

##アプリケーションURL

http://localhost

