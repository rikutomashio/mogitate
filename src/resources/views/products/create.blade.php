@extends('layouts.common')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endpush

@section('content')

<h2 class="page-title">商品登録</h2>

<form
    action="{{ route('products.store') }}"
    method="POST"
    enctype="multipart/form-data"
    class="product-form"
>
    @csrf

    {{-- 商品名 --}}
    <div class="form-group">
        <label>商品名（必須）</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    {{-- 価格 --}}
    <div class="form-group">
        <label>価格（必須）</label>
        <input type="text" name="price" value="{{ old('price') }}">
        @error('price')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    {{-- 季節 --}}
    <div class="form-group">
        <label>季節（必須）</label>
        <div class="checkbox-group">
            @foreach ($seasons as $season)
                <label>
                    <input
                        type="checkbox"
                        name="seasons[]"
                        value="{{ $season->id }}"
                        {{ in_array($season->id, old('seasons', [])) ? 'checked' : '' }}
                    >
                    {{ $season->name }}
                </label>
            @endforeach
        </div>
        @error('seasons')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    {{-- 画像 --}}
    <div class="form-group">
        <label>商品画像（必須）</label>
        <input type="file" name="image" accept=".png,.jpeg,.jpg">
        @error('image')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    {{-- 商品説明 --}}
    <div class="form-group">
        <label>商品説明（必須）</label>
        <textarea name="description">{{ old('description') }}</textarea>
        @error('description')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    {{-- ボタン --}}
    <div class="form-buttons">
        <button type="button" class="btn-back"
                onclick="location.href='{{ route('products.index') }}'">
            戻る
        </button>

        <button type="submit" class="btn-submit">
            登録
        </button>
    </div>

</form>

@endsection
