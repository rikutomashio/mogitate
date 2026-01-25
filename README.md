# mogitate

フルーツ商品を管理・表示するための **Laravel製Webアプリケーション**です。  
商品一覧表示・検索・登録・編集・削除などの基本的なCRUD機能を実装しています。

---

## 🌱 アプリケーション名

**mogitate**

「新鮮なフルーツを扱うアプリケーション」をイメージして命名しました。

---

## 🚀 環境構築手順

### 1. リポジトリをクローン
```bash
git clone https://github.com/ユーザー名/mogitate.git
cd mogitate

docker-compose build
docker-compose up -d

docker-compose exec php composer install

docker-compose exec php cp .env.example .env
docker-compose exec php php artisan key:generate

docker-compose exec php php artisan migrate --seed

docker-compose exec php php artisan storage:link

http://localhost/products

🛠 使用技術
バックエンド

PHP 8.4

Laravel 12

フロントエンド

Blade

CSS / Bootstrap

データベース

MySQL

💻 開発環境

Docker

Docker Compose

📊 ER図

🔗 URL（ローカル環境）

http://localhost/products

http://localhost:8080

