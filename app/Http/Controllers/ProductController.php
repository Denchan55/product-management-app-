<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // 商品一覧
public function index()
{
    $products = Product::all(); // DBから全件取得
    return view('products.index', compact('products'));
}

    // 商品詳細
    public function detail($productId)
    {
        return view('products.detail');
    }

    // 商品登録フォーム
    public function showRegister()
    {
        return view('products.register');
    }

    // 商品登録処理
    public function register(Request $request)
    {
        // 後で実装
    }

    // 商品更新フォーム
    public function showUpdate($productId)
    {
        return view('products.update');
    }

    // 商品更新処理
    public function update(Request $request, $productId)
    {
        // 後で実装
    }

    // 商品検索
    public function search(Request $request)
    {
        return view('products.search');
    }

    // 商品削除
    public function delete($productId)
    {
        // 後で実装
    }
}
