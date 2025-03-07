<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{

    public function index(Request $request)
    {
    $products = Product::query();


    // 並び替え機能
    if ($request->filled('sort')) {
        $products->orderBy('price', $request->sort);
    }

    $products = Product::with('seasons')->paginate(6);

    return view('index', compact('products'));
    }

    //検索機能
    public function search(Request $request)
    {
        $query = Product::query();

    // 検索キーワードを取得
    $search = $request->input('search');

    // 商品名の部分一致検索
    if (!empty($search)) {
        $query->where('name', 'LIKE', "%{$search}%");
    }

    // 検索結果を取得（ページネーション付き）
    $products = $query->paginate(6);

    // 検索ワードをビューに渡す
    return view('index', compact('products', 'search'));
    }

    public function show($productId)
    {
       // 商品IDに基づいて商品情報を取得
    $product = Product::with('seasons')->findOrFail($productId);

    // 季節データを取得
    $seasons = Season::all();

    // 商品詳細ビューにデータを渡す
    return view('show', compact('product', 'seasons'));
    }

    // 商品情報を更新
    public function update(ProductRequest $request, $productId)
    {
        // バリデーションが通った後、商品情報の更新処理を行う
        $validated = $request->validated();
        $product = Product::findOrFail($productId);

        // 画像処理: 新しい画像がアップロードされた場合のみ更新
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('products', 'public');
        $validated['image'] = $path;
    } else {
        // 画像が選択されていない場合、既存の画像を保持
        $validated['image'] = $request->existing_image;
    }

        // 商品更新処理
        $product->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image' => $validated['image'],
        ]);

        // 季節情報を更新（多対多リレーション）
        $product->seasons()->sync($request->seasons);

        // 商品一覧にリダイレクト
        return redirect()->route('products.index');
    }
    // 商品削除
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();

        return redirect()->route('products.index');
    }


    public function create()
    {
        $seasons = Season::all();  // 季節のデータを取得
        return view('register', compact('seasons'));
    }

    public function store(ProductRequest $request)
    {
        // バリデーション済みのデータを取得
        $validated = $request->validated();

        // 商品画像を保存
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        // 商品登録
        $product = Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image' => $validated['image'],
        ]);

        // 中間テーブルに季節情報を保存
        if (!empty($validated['seasons'])) {
        $product->seasons()->attach($validated['seasons']);
}

        return redirect()->route('products.index');
    }

}
