<!DOCTYPE HTML>  
<html lang="ja">  
<head>
<link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
<div class="main__container">
<h1>商品情報編集画面</h1>
<table class="main__container__table">
<form method="post" action="{{ route('product.update', ['id'=>$product->id]) }}" enctype="multipart/form-data">
@csrf
    <tr>
        <th>ID.</th><td>{{ $product->id }}</td>
</tr>
<tr>
        <th><div><label>商品名</label></th> <td><input type="text" name="product_name" id="product_name" value="{{ $product->product_name }}">
        @if($errors->has('product_name'))
                        <p>{{ $errors->first('product_name') }}</p>
                    @endif</div></td>
</tr>
<tr>
        <th><div><label>メーカー名</label></th> <td><select type="text" name="company_id" size="1">
        <option value="{{ $product->company_id }}" id="company_id" selected hidden>{{ $product->company_name }}</option>
        @foreach ($company_lists as $company_list)
        <option value="{{ $company_list->id }}" id="company_id">{{ $company_list->company_name }} </option>
                @endforeach
            </select>
            @if($errors->has('company_id'))
                        <p>{{ $errors->first('company_id') }}</p>
                    @endif
        </div></td>
</tr>
<tr>
        <th><div><label>価格</label></th> <td><input type="text" name="price" id="price" value="{{ $product->price }}">
        @if($errors->has('price'))
                        <p>{{ $errors->first('price') }}</p>
                    @endif</div></td>
</tr>
<tr>
        <th><div><label>在庫数</label></th> <td><input type="text" name="stock" id="stock" value="{{ $product->stock }}">
        @if($errors->has('stock'))
                        <p>{{ $errors->first('stock') }}</p>
                    @endif</div></td>
</tr>
<tr>
        <th><div><label>コメント</label></th> <td><textarea name="comment" id="comment" value="{{ $product->comment }}">{{ $product->comment }}</textarea></div></td>
</tr>
<tr>
        <th><div><label>商品画像</label></th> <td><input type="file" name="img_path" value="{{ $product->img_path }}"><img src="{{ asset($product->img_path) }}" class="index__main__table__img"></div></td>
</tr>
<tr>
        <td></td><td class="main__container__td__btn"><button class="main__container__btn" type="submit">更新</button><button class="main__container__btn" type="button" onclick="location.href='{{ route('showList.detail', ['id'=>$product->id]) }}'">戻る</button></td>
</tr>
    </form>
</table>
</div>

