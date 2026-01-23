@extends('layouts.common')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endpush

@section('content')

<h2 class="page-title">商品編集</h2>

{{-- エラー表示 --}}
@if ($errors->any())
    <ul class="error-list">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form
    action="{{ route('products.update', ['productId' => $product->id]) }}"
    method="POST"
    enctype="multipart/form-data"
    class="product-form"
>
    @csrf
    @method('PUT')

    {{-- 商品名 --}}
    <div class="form-group">
        <label>商品名</label>
        <input
            type="text"
            name="name"
            value="{{ old('name', $product->name) }}"
        >
    </div>

    {{-- 価格 --}}
    <div class="form-group">
        <label>値段</label>
        <input
            type="number"
            name="price"
            value="{{ old('price', $product->price) }}"
        >
    </div>

    {{-- 季節 --}}
    <div class="form-group">
        <label>季節</label>
        <div class="checkbox-group">
            @foreach ($seasons as $season)
                <label>
                    <input
                        type="checkbox"
                        name="seasons[]"
                        value="{{ $season->id }}"
                        {{ in_array(
                            $season->id,
                            old('seasons', $product->seasons->pluck('id')->toArray())
                        ) ? 'checked' : '' }}
                    >
                    {{ $season->name }}
                </label>
            @endforeach
        </div>
    </div>

    {{-- 現在の画像 --}}
    <div class="form-group">
        <label>現在の画像</label>
        <div class="current-image">
            @if ($product->image)
                <img
                    src="{{ asset('storage/products/' . $product->image) }}"
                    alt="{{ $product->name }}"
                >
            @else
                <span class="no-image">画像なし</span>
            @endif
        </div>
    </div>

    {{-- 新しい画像 --}}
    <div class="form-group">
        <label>商品画像（変更する場合のみ）</label>
        <input type="file" name="image" accept=".png,.jpeg,.jpg">
    </div>

    {{-- 商品説明 --}}
    <div class="form-group">
        <label>商品説明</label>
        <textarea name="description">{{ old('description', $product->description) }}</textarea>
    </div>

    {{-- ボタン --}}
    <div class="form-actions">
    <button type="submit" class="btn-submit">
        変更を保存
    </button>

    <a
        href="{{ route('products.show', ['productId' => $product->id]) }}"
        class="btn-back"
    >
        戻る
    </a>
    </div>


</form>

@endsection
