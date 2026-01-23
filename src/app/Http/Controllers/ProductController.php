<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Season;

class ProductController extends Controller
{
    // 商品一覧
    public function index(Request $request)
    {
        $query = Product::with('seasons');

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(6)->withQueryString();

        return view('products.index', compact('products'));
    }

    // 商品登録画面
    public function create()
    {
        $seasons = Season::all();
        return view('products.create', compact('seasons'));
    }

    // 商品登録処理
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->storeAs('products', $filename, 'public');
            $validated['image'] = $filename;
        }

        $product = Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'image' => $validated['image'] ?? null,
            'description' => $validated['description'],
        ]);

        $product->seasons()->sync($validated['seasons'] ?? []);

        return redirect()->route('products.index');
    }

    // 商品詳細
    public function show($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        return view('products.show', compact('product'));
    }

    // 商品編集画面
    public function edit($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $seasons = Season::all();
        return view('products.edit', compact('product', 'seasons'));
    }

    // 商品更新処理
    public function update(UpdateProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists('products/' . $product->image)) {
                Storage::disk('public')->delete('products/' . $product->image);
            }

            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->storeAs('products', $filename, 'public');
            $validated['image'] = $filename;
        } else {
            $validated['image'] = $product->image;
        }

        $product->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'image' => $validated['image'],
            'description' => $validated['description'],
        ]);

        $product->seasons()->sync($validated['seasons'] ?? []);

        return redirect()->route('products.show', ['productId' => $product->id]);
    }

    // 商品削除
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->image && Storage::disk('public')->exists('products/' . $product->image)) {
            Storage::disk('public')->delete('products/' . $product->image);
        }

        $product->delete();

        return redirect()->route('products.index');
    }

    // 商品検索（新規追加）
    public function search(Request $request)
    {
        $query = Product::with('seasons');

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(6)->withQueryString();

        return view('products.index', compact('products'));
    }
}
