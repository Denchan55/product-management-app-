## ER図

```mermaid
erDiagram

  products {
    int id PK
    string name
    string price_path
    string image
    string description

  }

  seasons {
    int id PK
    string name
  }

  product_season {
    int id PK
    int product_id FK
    int season_id FK
  }

  products ||--o{ product_season : "1対多"
  seasons ||--o{ product_season : "1対多"
```

flowchart TD

    A[PG01 商品一覧<br>/products] -->|商品をクリック| B[PG02 商品詳細<br>/products/detail/{id}]
    A -->|新規登録ボタン| D[PG04 商品登録<br>/products/register]
    A -->|検索フォーム| E[PG05 検索<br>/products/search]

    B -->|編集ボタン| C[PG03 商品更新<br>/products/{id}/update]
    B -->|削除ボタン| F[PG06 削除<br>/products/{id}/delete]
    B -->|一覧へ戻る| A

    C -->|更新完了後| B
    D -->|登録完了後| A
    E -->|検索結果から商品クリック| B
