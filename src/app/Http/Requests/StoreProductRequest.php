<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'price' => ['required', 'numeric', 'between:0,10000'],
            'image' => ['required', 'image', 'mimes:png,jpeg,jpg'],
            'seasons' => ['required', 'array'],
            'seasons.*' => ['exists:seasons,id'],
            'description' => ['required', 'max:120'],
        ];
    }

    public function messages(): array
    {
        return [
            // 商品名
            'name.required' => '商品名を入力してください',

            // 値段
            'price.required' => '値段を入力してください',
            'price.numeric' => '数値で入力してください',
            'price.between' => '0∼10000円以内で入力してください',

            // 画像
            'image.required' => '画像を登録してください',
            'image.image' => '画像ファイルをアップロードしてください',
            'image.mimes' => '「.png」「.jpeg」「.jpg」形式でアップロードしてください',

            // 季節
            'seasons.required' => '季節を選択してください',
            'seasons.array' => '季節を正しく選択してください',
            'seasons.*.exists' => '選択された季節が正しくありません',

            // 商品説明
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
        ];
    }
}
