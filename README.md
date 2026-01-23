# mogitate

フルーツ商品を管理・表示するための **Laravel製Webアプリケーション**です。  
商品一覧表示・検索・登録・編集・削除などの基本的なCRUD機能を実装しています。

---

## 🌱 アプリケーション名

**mogitate**

「新鮮なフルーツを扱うアプリケーション」をイメージして命名しました。

---

## 🚀 環境構築

### 1. リポジトリをクローン
git clone https://github.com/ユーザー名/mogitate.git
cd mogitate

### 2.Dockerコンテナを起動
docker-compose up -d

### 3 依存関係をインストール
docker-compose exec app composer install

### 4 環境変数を設定
cp .env.example .env
docker-compose exec app php artisan key:generate

### 5 マイグレーション & シーディング
docker-compose exec app php artisan migrate --seed

### 6 ブラウザでアクセス
http://localhost

## 使用技術
バックエンド
PHP 8.x
Laravel 10.x

フロントエンド
Blade
CSS / Bootstrap

データベース
MySQL

### 　開発環境
Docker
Docker Compose

###   ER図

![ER図](https://raw.githubusercontent.com/ユーザー名/mogitate/main/docs/mogitate.drawio.png)



###  URL
ローカル環境

http://localhost/products
http://localhost:8080

