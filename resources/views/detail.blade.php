@extends('layouts.app')

@section('content')
<div class="container">
<h2>商品情報詳細画面</h2>
<table>
        <tr>
            <td>ID</td><td>{{ $product->id }}</td>
</tr>
<tr>
            <td>商品画像</td><td>{{ $product->img_path }}</td>
</tr>
<tr>
            <td>商品名</td><td>{{ $product->product_name }}</td>
</tr>
<tr>
            <td>メーカー名</td><td>{{ $product->company_name }}</td>
</tr>
<tr>
            <td>価格</td><td>￥{{ $product->price }}</td>
</tr>
<tr>
            <td>在庫数</td><td>{{ $product->stock }}</td>
</tr>
<tr>
            <td>コメント</td><td>{{ $product->comment }}</td>
</tr>
<tr>
<td><button type="button" onclick="location.href='{{ route('showList.edit', ['id'=>$product->id]) }}'">{{ __('編集') }}</button><button type="button" onclick="location.href='{{ route('product.index') }}'">戻る</button>
</tr>
</table>
</div>
@endsection
