@extends('layouts.common')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endpush

@section('content')

<h2 class="page-title">商品詳細</h2>

<div class="product-detail">

    {{-- 商品画像 --}}
    <div class="detail-image">
        @if ($product->image)
            <img
                src="{{ asset('storage/products/' . $product->image) }}"
                alt="{{ $product->name }}"
            >
        @else
            <div class="no-image">画像なし</div>
        @endif
    </div>

    {{-- 商品情報 --}}
    <div class="detail-info">
        <p><span>商品名</span>{{ $product->name }}</p>
        <p><span>値段</span>¥{{ number_format($product->price) }}</p>
        <p>
            <span>季節</span>
            @foreach ($product->seasons as $season)
                {{ $season->name }}{{ !$loop->last ? '、' : '' }}
            @endforeach
        </p>
        <p class="description">
            <span>商品説明</span>
            {{ $product->description }}
        </p>
    </div>

</div>

{{-- 操作ボタン --}}
<div class="detail-actions">
    <button
        type="button"
        class="btn-back"
        onclick="location.href='{{ route('products.index') }}'">
        一覧へ戻る
    </button>

    <a
        href="{{ route('products.edit', ['productId' => $product->id]) }}"
        class="btn-edit">
        編集
    </a>

    <form
        action="{{ route('products.destroy', ['productId' => $product->id]) }}"
        method="POST"
        class="delete-form"
    >
        @csrf
        @method('DELETE')
        <button
            type="submit"
            class="btn-delete"
            onclick="return confirm('本当に削除しますか？')">
            削除
        </button>
    </form>
</div>

@endsection
