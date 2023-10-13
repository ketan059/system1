@extends('layouts.app')

@section('content')
<div class="container">
<h2>商品情報編集画面</h2>
<table>
<form method="post" action="{{ route('product.update', ['id'=>$product->id]) }}">
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
        <th><div><label>メーカー名</label></th> <td><select type="text" name="company_name" id="company_name" size="1" value="">
        <option value="{{ $product->company_name }}" selected hidden>{{ $product->company_name }}</option>
        @foreach ($company_lists as $company_list)
                <option>{{ $company_list->company_name }} </option>
                @endforeach
            </select>
            @if($errors->has('company_name'))
                        <p>{{ $errors->first('company_name') }}</p>
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
        <th><div><label>商品画像</label></th> <td><input type="file" name="img_path" value="{{ $product->img_path }}"></div></td>
</tr>
<tr>
        <td><button type="submit">更新</button><button type="button" onclick="location.href='{{ route('showList.detail', ['id'=>$product->id]) }}'">戻る</button></td>
</tr>
    </form>
</div>
@endsection
