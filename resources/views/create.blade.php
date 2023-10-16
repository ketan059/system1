<!DOCTYPE HTML>  
<html lang="ja">  
<head>
<link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
<div class="main__container">
<h1>商品新規登録画面</h1>
<table class="main__container__table">
<form method="post" action="{{ route('product.store') }}">
@csrf
<tr>
        <th><label>商品名</label></th> <td><input type="text" name="product_name" id="product_name" value="{{ old('product_name') }}">
        @if($errors->has('product_name'))
                        <p>{{ $errors->first('product_name') }}</p>
                    @endif</td>
</tr>
<tr>
        <th><label>メーカー名</label></th> <td><select type="text" name="company_name" id="company_name" size="1" value="{{ old('company_name') }}">
        <option value="" selected disabled>メーカー名</option>
        @foreach ($company_lists as $company_list)
                <option>{{ $company_list->company_name }} </option>
                @endforeach
            </select>
            @if($errors->has('company_name'))
                        <p>{{ $errors->first('company_name') }}</p>
                    @endif</td>
</tr>
<tr>
        <th><label>価格</label></th> <td><input type="text" name="price" id="price" value="{{ old('price') }}">
        @if($errors->has('price'))
                        <p>{{ $errors->first('price') }}</p>
                    @endif</td>
</tr>
<tr>
        <th><label>在庫数</label></th> <td><input type="text" name="stock" id="stock" value="{{ old('stock') }}">
        @if($errors->has('stock'))
                        <p>{{ $errors->first('stock') }}</p>
                    @endif</td>
</tr>
<tr>
        <th><label>コメント</label></th> <td><textarea name="comment" id="comment" value="{{ old('comment') }}"></textarea></td>
</tr>
<tr>
        <th><label>商品画像</label></th> <td><input type="file" name="img_path"></td>
</tr>
<tr>
        <td></td><td class="main__container__td__btn"><button class="main__container__btn" type="submit">新規登録</button><button class="main__container__btn" type="button" onclick="location.href='{{ route('product.index') }}'">戻る</button></td>
    </form>
</table>
</div>
