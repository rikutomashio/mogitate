@extends('layouts.common')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endpush

{{-- ヘッダー右側ボタン --}}
@section('header-actions')
    <a href="{{ route('products.create') }}">＋ 新規商品登録</a>
@endsection

@section('content')

<h2 class="page-title">商品一覧</h2>

{{-- 検索・並び替え --}}
<form action="{{ route('products.search') }}" method="GET" class="search-form">
    <input
        type="text"
        name="keyword"
        placeholder="商品名で検索"
        value="{{ request('keyword') }}"
    >

    <select name="sort">
        <option value="">価格で並び替え</option>
        <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>
            高い順
        </option>
        <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>
            安い順
        </option>
    </select>

    <button type="submit">検索</button>
</form>

<hr>

{{-- 商品一覧 --}}
<div class="products-container">
    @foreach ($products as $product)
        <div class="product-card">

            {{-- 商品画像 --}}
            <div class="product-image">
                @if ($product->image)
                    <img
                        src="{{ asset('storage/products/' . $product->image) }}"
                        alt="{{ $product->name }}"
                    >
                @else
                    <span class="no-image">画像なし</span>
                @endif
            </div>

            {{-- 商品情報 --}}
            <div class="product-info">
                <h3>
                    <a href="{{ route('products.show', ['productId' => $product->id]) }}">
                        {{ $product->name }}
                    </a>
                </h3>

                <p class="price">¥{{ number_format($product->price) }}</p>
            </div>

        </div>
    @endforeach
</div>

{{-- ページネーション --}}
<div class="pagination">
    {{ $products->links() }}
</div>

@endsection
