<!DOCTYPE HTML>  
<html lang="ja">  
<head>
<link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
<div class="main__container">
<h1>商品情報詳細画面</h1>
<table class="main__container__table">
        <tr>
            <th>ID</th><td>{{ $product->id }}</td>
</tr>
<tr>
            <th>商品画像</th><td>{{ $product->img_path }}</td>
</tr>
<tr>
            <th>商品名</th><td>{{ $product->product_name }}</td>
</tr>
<tr>
            <th>メーカー名</th><td>{{ $product->company_name }}</td>
</tr>
<tr>
            <th>価格</th><td>￥{{ $product->price }}</td>
</tr>
<tr>
            <th>在庫数</th><td>{{ $product->stock }}</td>
</tr>
<tr>
            <th>コメント</th><td>{{ $product->comment }}</td>
</tr>
<tr>
<td></td><td class="main__container__td__btn"><button class="main__container__btn" type="button" onclick="location.href='{{ route('showList.edit', ['id'=>$product->id]) }}'">{{ __('編集') }}</button><button class="main__container__btn" type="button" onclick="location.href='{{ route('product.index') }}'">戻る</button></td>
</tr>
</table>
</div>
</body>
</html>

