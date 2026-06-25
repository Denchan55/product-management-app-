# COACHTECH 商品管理アプリケーション　もぎたて

## 作成者

江草英樹

## 使用技術

Backend
PHP 8.2
Laravel 10.x
Laravel Fortify（認証）
MySQL 8.0

Frontend
Vite
Tailwind CSS 3.4
Alpine.js（必要に応じて）

Infrastructure
Docker / Docker Compose / Laravel Sail

Nginx

phpMyAdmin

## ER図

【products テーブル】

- id (PK)
- name
- price
- image_path
- description

【seasons テーブル】

- id (PK)
- name

【product_season テーブル】※中間テーブル

- id (PK)
- product_id (FK → products.id)
- season_id (FK → seasons.id)

【リレーション】

- products 1 --- \* product_season
- seasons 1 --- \* product_season

## 画面遷移図（Flowchart）

PG01 商品一覧 (/products)
├─ 商品クリック → PG02 商品詳細 (/products/{id})
├─ 新規登録 → PG04 商品登録 (/products/register)
└─ 検索 → PG05 検索 (/products/search)

PG02 商品詳細 (/products/{id})
├─ 編集 → PG03 商品更新 (/products/{id})
├─ 削除 → PG06 商品削除 (/products/{id})
└─ 一覧へ戻る → PG01 商品一覧

PG03 商品更新 → 更新完了後 PG02 商品詳細  
PG04 商品登録 → 登録完了後 PG01 商品一覧  
PG05 検索 → 商品クリックで PG02 商品詳細

## 開発環境URL

アプリケーション：
http://localhost/products

phpMyAdmin：
http://localhost:8080

## 動作環境

Docker
Docker Compose
（Windows の場合）WSL2 推奨

## 環境構築手順

1. **リポジトリをクローン**

    ```bash
    git clone https://github.com/Denchan55/product-management-app

    ```

2. **.envファイルの準備**

    `.env.example` をコピーして `.env` を作成します。

    ```bash
    cp .env.example .env
    ```

    `.env` ファイル内の以下のDB接続情報を確認・設定します。`.env.example` のデフォルト値はSail向けではないため、以下のように変更してください。

    ```ini
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=sail
    DB_PASSWORD=password
    ```

3. **Composer依存パッケージのインストール**

    プロジェクトの初回セットアップ時は、`vendor` ディレクトリが存在しないため `sail` コマンドを使用できません。
    以下のDockerコマンドを実行して、コンテナ内で `composer install` を実行します。

    ```bash
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php82-composer:latest \
        composer install --ignore-platform-reqs
    ```

4. **Laravel Sailの起動**

    以下のコマンドでDockerコンテナを起動します。

    ```bash
    ./vendor/bin/sail up -d
    ```

    > **エイリアスの設定（推奨）**
    >
    > 毎回 `./vendor/bin/sail` と入力するのは手間なので、エイリアスを設定すると便利です。
    >
    > ```bash
    > alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
    > ```

5. **アプリケーションキーの生成**

    ```bash
    sail artisan key:generate
    ```

6. **データベースのマイグレーションと初期データ投入**

    以下のコマンドでテーブルを作成し、ダミーデータを投入します。

    ```bash
    sail artisan migrate:fresh --seed
    ```

    このコマンドの入力後、エラーが表示されることがあります。
    その場合は、以下のコマンドを順に実行して各コンテナを再起動して下さい。

    ```Bash
    sail down -v
    sail up -d　//コマンド実行後にSQLコンテナが立ち上がるまで時間がかかります。30秒ほどお待ちください。
    sail artisan migrate:fresh --seed
    ```

7. **フロントエンドのビルド**

    ```bash
    sail npm install
    sail npm run dev
    ```

    `npm run dev` は開発中は起動したままにしてください。

8. **アプリケーションへのアクセス**

    ブラウザで [http://localhost/products/]にアクセスします。

## テスト実行

```bash
sail artisan test
```

カバレッジ付きで実行する場合:

```bash
sail artisan test --coverage
```

## 機能一覧

商品一覧表示

商品詳細表示

商品登録

商品更新

商品削除

商品検索

季節タグ（多対多）

バリデーション（仕様書準拠）

画像アップロード（png / jpeg）
